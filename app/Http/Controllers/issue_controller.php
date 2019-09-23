<?php

// This file contains functions for controlling issue events

namespace App\Http\Controllers;

use App\company;
use App\microlocation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\inventory_issue;
use Auth;
use Illuminate\Validation\Rule;

class issue_controller extends Controller {
    public function __construct() {
        $this->middleware('auth');
    }


    public function index(company $company, microlocation $microlocation) {
        return view('pages.company.issues')->with(['company' => $company, 'microlocation' => $microlocation]);
    }


    public function create(company $company) {
        return view('pages.company.manage.issues_create')->with('company', $company);
    }


    public function store(Request $request, company $company) {
        $request->validate([
            'user' => ['integer', Rule::requiredIf(Auth::user()->user_type_id > 3)],
            'datetime' => 'required|date_format:d-m-Y|after:-12 months|before:12 months',
            'type' => 'required',
            'from_microlocation' => 'required|integer',
            'to_microlocation' => 'required_if:type,1|integer',
            'to_company' => 'required_if:type,2|integer',
            'material' => ['required',
                function ($attribute, $value, $fail) {
                    foreach ($value as $v) {
                        if (!is_numeric($v)) {
                            $fail('Materiaali ei kelpaa.');
                        }
                    }
                },
            ],
            'ewc_code' => ['required',
                function ($attribute, $value, $fail) {
                    foreach ($value as $v) {
                        if (!is_numeric($v)) {
                            $fail('EWC koodi ei kelpaa.');
                        }
                    }
                },
            ],
            'weight' => ['required',
                function ($attribute, $value, $fail) {
                    foreach ($value as $v) {
                        if (!is_numeric($v) || $v < 0 || $v > 1000000) {
                            $fail('Paino ei kelpaa.');
                        }
                    }
                },
            ],
        ], [], [
            'user' => 'Käyttäjä',
            'datetime' => 'Aika',
            'type' => 'Lähetyksen tyyppi',
            'from_microlocation' => 'Toimipisteestä',
            'to_microlocation' => 'Toimipisteeseen',
            'to_company' => 'Organisaatioon',
            'material' => 'Materiaali',
            'ewc_code' => 'EWC Koodi',
            'weight' => 'Paino',
        ]);

        $microlocation = $request->get('from_microlocation');
        $type = $request->get('type');

        $issue = new inventory_issue([
            'issue_user_id' => $request->get('user') ?: Auth::user()->user_id,
            'issue_date' => date("Y-m-d", strtotime($request->get('datetime'))),
            'issue_type_id' => $type,
            'issue_from_microlocation_id' => $microlocation,
            'issue_to_microlocation_id' => ($type == 1 ? $request->get('to_microlocation') : NULL),
            'issue_to_company_id' => ($type == 2 ? $request->get('to_company') : NULL),
        ]);
        $issue->save();

        for ($i = 0; $i <= count($request->weight) - 1; $i++) {
            $material = $request->material[$i];
            $weight = $request->weight[$i];
            DB::table('inventory_issue_details')->insert([
                'detail_issue_id' => $issue->issue_id,
                'detail_material_id' => isset($request->material[$i]) ? $request->material[$i] : NULL,
                'detail_ewc_code' => isset($request->ewc_code[$i]) ? $request->ewc_code[$i] : NULL,
                'detail_weight' => $request->weight[$i],
            ]);
            if ($request->get('type') != 2) {
                app('App\Http\Controllers\microlocation_controller')->add_inventory($microlocation, $material, -$weight);
            }
        }

        return redirect()->action('issue_controller@index', ['company' => $company])->withErrors(['Lähetys-kirjaus luotu onnistuneesti']);
    }


    public function show(company $company, inventory_issue $issue) {

    }


    public function edit(company $company, inventory_issue $issue) {
        return view('pages.company.manage.issues_edit')->with(['company' => $company, 'issue' => $issue]);
    }


    public function update(Request $request, company $company, inventory_issue $issue) {
        $request->validate([
            'user' => ['integer', Rule::requiredIf(Auth::user()->user_type_id > 3)],
            'datetime' => 'required|date_format:d-m-Y|after:-12 months|before:12 months',
            'type' => 'required',
            'from_microlocation' => 'required|integer',
            'to_microlocation' => 'required_if:type,1|integer',
            'to_company' => 'required_if:type,2|integer',
            'material' => ['required',
                function ($attribute, $value, $fail) {
                    foreach ($value as $v) {
                        if (!is_numeric($v)) {
                            $fail($attribute . ' is invalid.');
                        }
                    }
                },
            ],
            'ewc_code' => ['required',
                function ($attribute, $value, $fail) {
                    foreach ($value as $v) {
                        if (!is_numeric($v)) {
                            $fail($attribute . ' is invalid.');
                        }
                    }
                },
            ],
            'weight' => ['required',
                function ($attribute, $value, $fail) {
                    foreach ($value as $v) {
                        if (!is_numeric($v) || $v < 0) {
                            $fail($attribute . ' is invalid.');
                        }
                    }
                },
            ],
        ], [], [
            'user' => 'Käyttäjä',
            'datetime' => 'Aika',
            'type' => 'Lähetyksen tyyppi',
            'from_microlocation' => 'Toimipisteestä',
            'to_microlocation' => 'Toimipisteeseen',
            'to_company' => 'Organisaatioon',
            'material' => 'Materiaali',
            'ewc_code' => 'EWC Koodi',
            'weight' => 'Paino',
        ]);

        $microlocation = $request->get('from_microlocation');
        $type = $request->get('type');

        $issueNew = inventory_issue::find($issue->issue_id);
        $issueNew->issue_user_id = $request->get('user') ?: Auth::user()->user_id;
        $issueNew->issue_date = date("Y-m-d", strtotime($request->get('datetime')));
        $issueNew->issue_type_id = $request->get('type');
        $issueNew->issue_from_microlocation_id = $microlocation;
        $issueNew->issue_to_microlocation_id = ($type == 1 ? $request->get('to_microlocation') : NULL);
        $issueNew->issue_to_microlocation_id = ($type == 2 ? $request->get('to_company') : NULL);


        # Remove old data
        foreach (DB::table('inventory_issue_details')->where('detail_issue_id', '=', $issue->issue_id)->get() as $detail) {
            app('App\Http\Controllers\microlocation_controller')->add_inventory($issueNew->getOriginal('issue_from_microlocation_id'), $detail->detail_material_id, $detail->detail_weight);
        }
        DB::table('inventory_issue_details')->where('detail_issue_id', '=', $issue->issue_id)->delete();

        # Save new data
        $issueNew->save();
        for ($i = 0; $i <= count($request->ewc_code) - 1; $i++) {
            $material = $request->material[$i];
            $weight = $request->weight[$i];
            DB::table('inventory_issue_details')->insert([
                'detail_issue_id' => $issue->issue_id,
                'detail_material_id' => $material,
                'detail_ewc_code' => $request->ewc_code[$i],
                'detail_weight' => $weight,
            ]);
            app('App\Http\Controllers\microlocation_controller')->add_inventory($microlocation, $material, -$weight);
        }

        return redirect()->action('issue_controller@index', ['company' => $company])->withErrors(['Issue successfully updated.']);
    }


    public function destroy($id) {
        //
    }

    # The query to find events, as its own function so it can be used from multiple places
    public function query(Request $request, company $company) {
        $microlocation_ids = [];
        foreach (DB::table('microlocations')->where('microlocation_company_id', $company->company_id)->get() as $ml) {
            array_push($microlocation_ids, $ml->microlocation_id);
        }
        return DB::table('inventory_issue')
            ->whereIn('issue_from_microlocation_id', $microlocation_ids)
            ->when(($request->from && $request->to), function ($query) use ($request) {
                $query->whereBetween('issue_date', [date("Y-m-d", strtotime($request->from)), date("Y-m-d H:i:s", strtotime($request->to . ' 23:59:59'))]);
            })
            ->where(function ($query) use ($request) {
                foreach (explode(',', $request->search) as $or) {
                    $query->orWhere(function ($query) use ($or) {
                        foreach (explode(' ', $or) as $word) {
                            $query->where(function ($query) use ($word) {
                                $query
                                    ->where('from_microlocations.microlocation_name', 'LIKE', '%' . $word . "%")
                                    ->orWhere('to_microlocations.microlocation_name', 'LIKE', '%' . $word . "%")
                                    ->orWhere('username', 'LIKE', '%' . $word . "%")
                                    ->orWhere('issue_typename', 'LIKE', '%' . $word . "%");
                            });
                        }
                    });
                }
            })
            ->join('issue_types', 'inventory_issue.issue_type_id', '=', 'issue_types.issue_type_id')
            ->join('microlocations as from_microlocations', 'issue_from_microlocation_id', '=', 'from_microlocations.microlocation_id')
            ->leftJoin('microlocations as to_microlocations', 'issue_to_microlocation_id', '=', 'to_microlocations.microlocation_id')
            ->leftJoin('company', 'issue_to_company_id', '=', 'company_id')
            ->join('users', 'users.user_id', '=', 'issue_user_id')
            ->joinSub(DB::table('inventory_issue_details')
                ->select('detail_issue_id', DB::raw('SUM(detail_weight) as sumweight'))
                ->groupBy('detail_issue_id'), 'details', function ($join) {
                $join->on('detail_issue_id', '=', 'issue_id');
            })
            ->orderBy('issue_date', 'DESC');
    }


    # This outputs a  nicely formatted list of found events
    public function search(Request $request, company $company, microlocation $microlocation) {
        if ($request->ajax()) {
            $output = "";
            $result = app('App\Http\Controllers\issue_controller')
                ->query($request, $company)
                ->select('issue_date', 'from_microlocations.microlocation_name as from_microlocation', 'from_microlocations.microlocation_id as from_microlocation_id', 'issue_typename', 'to_microlocations.microlocation_name as to_microlocation', 'users.username', 'issue_id', 'sumweight', 'company_name')
                ->get();
            if ($result) {
                foreach ($result as $key => $value) {
                    $output .= '<tr class="text-left">' .
                        '<td class="text-center">' . date("d-m-Y", strtotime($value->issue_date)) . '</td>' .
                        '<td>' . title_case($value->from_microlocation) . '</td>' .
                        '<td>' . $value->issue_typename . '</td>' .
                        '<td>' . title_case(($value->to_microlocation ?: $value->company_name)) . '</td>' .
                        '<td>' . $value->username . '</td>' .
                        '<td class="text-right">' . $value->sumweight . '</td>' .
                        (Auth::user()->user_type_id < 3 || Auth::user()->user_microlocation_id == $value->from_microlocation_id ? '<td class="text-center"><a href="' . url('companies/' . $company->company_id . '/manage/issues/' . $value->issue_id . '/edit') . '"><i class="material-icons">edit</i></a></td>' : '') .
                        '</tr>';
                }
                $output .= '<tr>' .
                    '<td></td>' .
                    '<td></td>' .
                    '<td></td>' .
                    '<td></td>' .
                    '<td></td>' .
                    '<td class="text-right">' . $result->sum('sumweight') . ' Total</td>' .
                    '<td></td>' .
                    '</tr>';
                return Response($output);
            }
        }
    }

    // Used when we want to display the inventory values of a microlocation when creating or editing issues
    public function inventory(Request $request, company $company) {
        if ($request->ajax()) {
            $output = [];
            $ml = $request->get('ml_id');
            foreach (DB::table('inventory')->where('inventory_microlocation_id', $ml)->get() as $inv) {
                $output[$inv->inventory_material_id] = $inv->inventory_weight;
            }
            return Response($output);
        }
    }
}
