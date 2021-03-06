<?php

// This file contains functions for controlling receipt events

namespace App\Http\Controllers;

use App\company;
use App\microlocation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\inventory_receipt;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Auth;

class receipt_controller extends Controller {
    public function index(company $company, microlocation $microlocation) {
        return view('pages.company.receipts')->with(['company' => $company, 'microlocation' => $microlocation]);
    }


    public function create(company $company) {
        return view('pages.company.manage.receipt_create')->with('company', $company);
    }


    public function store(Request $request, company $company) {
        $request->validate([
            'user' => ['integer', Rule::requiredIf(Auth::user()->user_type_id > 3)],
            'datetime' => 'required|date_format:d-m-Y|after:-12 months|before:12 months',
            'material' => 'required|integer',
            'source' => 'required',
            'from_community' => 'integer|required_without_all:from_supplier,from_microlocation',
            'from_supplier' => 'required_without_all:from_community,from_microlocation|max:191',
            'from_microlocation' => 'integer|required_without_all:from_supplier,from_community',
            'to_microlocation' => 'required|integer',
            'distance' => 'required|integer',
            'weight' => 'required|integer|min:0|max:1000000',
            'ewc' => 'required|max:6|digits_between:0,9',
        ], [], [
            'user' => 'Käyttäjä',
            'datetime' => 'Aika',
            'material' => 'Materiaali',
            'source' => 'Lähde',
            'from_community' => 'Kunnasta',
            'from_supplier' => 'Toimittajalta',
            'from_microlocation' => 'Toimipisteestä',
            'to_microlocation' => 'Toimipisteeseen',
            'distance' => 'Matka',
            'weight' => 'Paino',
            'ewc' => 'EWC Koodi',
        ]);

        $microlocation = $request->get('to_microlocation');
        $material = $request->get('material');
        $weight = $request->get('weight');
        $for_issue = $request->get('for_issue') ? 1 : 0;

        $receipt = new inventory_receipt([
            'receipt_user_id' => $request->get('user') ?: Auth::user()->user_id,
            'receipt_date' => date("Y-m-d", strtotime($request->get('datetime'))),
            'receipt_material_id' => $material,
            'from_community_id' => $request->get('from_community'),
            'from_supplier' => $request->get('from_supplier'),
            'receipt_from_microlocation_id' => $request->get('from_microlocation'),
            'receipt_to_microlocation_id' => $microlocation,
            'distance_km' => $request->get('distance'),
            'receipt_weight' => $weight,
            'receipt_ewc_code' => $request->get('ewc'),
            'is_for_issue' => $for_issue,
        ]);
        $receipt->save();

        app('App\Http\Controllers\microlocation_controller')->add_inventory($microlocation, $material, $weight);
        return redirect()->action('receipt_controller@index', ['company' => $company])->withErrors(['Saapuneet-kirjaus luotu onnistuneesti.']);
    }


    public function show(company $company) {
        return redirect()->action('receipt_controller@index', ['company' => $company]);
    }


    public function edit(company $company, inventory_receipt $receipt) {
        return view('pages.company.manage.receipt_edit')->with(['company' => $company, 'receipt' => $receipt]);
    }


    public function update(Request $request, company $company, inventory_receipt $receipt) {
        $request->validate([
            'user' => ['integer', Rule::requiredIf(Auth::user()->user_type_id > 3)],
            'datetime' => 'required|date_format:d-m-Y|after:-12 months|before:12 months',
            'material' => 'required|integer',
            'source' => 'required',
            'from_community' => 'integer|required_with:from_company',
            'from_supplier' => 'max:191',
            'from_microlocation' => 'integer',
            'to_microlocation' => 'required|integer',
            'distance' => 'required|integer',
            'weight' => 'required|integer|min:0|max:1000000',
            'ewc' => 'required|max:6|digits_between:0,9',
        ], [], [
            'user' => 'Käyttäjä',
            'datetime' => 'Aika',
            'material' => 'Materiaali',
            'source' => 'Lähde',
            'from_community' => 'Kunnasta',
            'from_supplier' => 'Toimittajalta',
            'from_microlocation' => 'Toimipisteestä',
            'to_microlocation' => 'Toimipisteeseen',
            'distance' => 'Matka',
            'weight' => 'Paino',
            'ewc' => 'EWC Koodi',
        ]);

        $microlocation = $request->get('to_microlocation');
        $material = $request->get('material');
        $weight = $request->get('weight');
        $for_issue = $request->get('for_issue') ? 1 : 0;

        $receiptNew = inventory_receipt::find($receipt->receipt_id);
        $receiptNew->receipt_user_id = $request->get('user') ?: Auth::user()->user_id;
        $receiptNew->receipt_date = date("Y-m-d", strtotime($request->get('datetime')));
        $receiptNew->receipt_material_id = $material;
        $receiptNew->from_community_id = $request->get('from_community');
        $receiptNew->from_supplier = $request->get('from_supplier');
        $receiptNew->receipt_from_microlocation_id = $request->get('from_microlocation');
        $receiptNew->receipt_to_microlocation_id = $microlocation;
        $receiptNew->distance_km = $request->get('distance');
        $receiptNew->receipt_weight = $weight;
        $receiptNew->receipt_ewc_code = $request->get('ewc');
        $receiptNew->is_for_issue = $for_issue;

        app('App\Http\Controllers\microlocation_controller')->add_inventory($receiptNew->getOriginal('receipt_to_microlocation_id'), $receiptNew->getOriginal('receipt_material_id'), -$receiptNew->getOriginal('receipt_weight'));
        $receiptNew->save();
        app('App\Http\Controllers\microlocation_controller')->add_inventory($microlocation, $material, $weight);

        return redirect()->action('receipt_controller@index', ['company' => $company])->withErrors(['Saapuneet-kirjaus päivitetty onnistuneesti.']);
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
        return DB::table('inventory_receipt')
            ->whereIn('receipt_to_microlocation_id', $microlocation_ids)
            ->when(($request->from && $request->to), function ($query) use ($request) {
                $query->whereBetween('receipt_date', [date("Y-m-d", strtotime($request->from)), date("Y-m-d H:i:s", strtotime($request->to . ' 23:59:59'))]);
            })
            ->where(function ($query) use ($request) {
                foreach (explode(',', $request->search) as $or) {
                    $query->orWhere(function ($query) use ($or) {
                        foreach (explode(' ', $or) as $word) {
                            $query->where(function ($query) use ($word) {
                                $query
                                    ->where('to_microlocations.microlocation_name', 'LIKE', '%' . $word . "%")
                                    ->orwhere('from_microlocations.microlocation_name', 'LIKE', '%' . $word . "%")
                                    ->orwhere('from_supplier', 'LIKE', '%' . $word . "%")
                                    ->orwhere('community.communitY_city', 'LIKE', '%' . $word . "%")
                                    ->orWhere('material_name', 'LIKE', '%' . $word . "%")
                                    ->orWhere('receipt_ewc_code', 'LIKE', '%' . $word . "%")
                                    ->orWhere('receipt_weight', 'LIKE', '%' . $word . "%")
                                    ->orWhere('distance_km', 'LIKE', '%' . $word . "%")
                                    ->orWhere(function ($query) use ($word) {
                                        if (Str::contains('ulkoinen', $word)) {
                                            $query->whereNotNull('from_community_id');
                                        }
                                    })
                                    ->orWhere(function ($query) use ($word) {
                                        if (Str::contains('toimittaja', $word)) {
                                            $query->whereNotNull('from_supplier');
                                        }
                                    })
                                    ->orWhere(function ($query) use ($word) {
                                        if (Str::contains('sisäinen', $word)) {
                                            $query->whereNotNull('receipt_from_microlocation_id');
                                        }
                                    });
                            });
                        }
                    });
                }
            })
            ->join('material_names', 'receipt_material_id', '=', 'material_id')
            ->leftJoin('community', 'from_community_id', '=', 'community.community_id')
            ->leftJoin('microlocations as from_microlocations', 'receipt_from_microlocation_id', '=', 'from_microlocations.microlocation_id')
            ->leftJoin('microlocations as to_microlocations', 'receipt_to_microlocation_id', '=', 'to_microlocations.microlocation_id')
            ->orderBy('receipt_date', 'DESC')
            ->orderBy('receipt_to_microlocation_id');
    }


    # This outputs a  nicely formatted list of found events
    public function search(Request $request, company $company, microlocation $microlocation) {
        if ($request->ajax()) {
            $output = "";
            $result = app('App\Http\Controllers\receipt_controller')
                ->query($request, $company)
                ->select('receipt_date', 'from_community_id', 'receipt_weight', 'distance_km', 'receipt_ewc_code', 'receipt_id', 'material_name', 'from_microlocations.microlocation_name as from_microlocation_name', 'to_microlocations.microlocation_name as to_microlocation_name', 'to_microlocations.microlocation_id as to_microlocation_id', 'from_supplier', 'community.community_city', 'is_for_issue')
                ->get();
            if ($result) {
                foreach ($result as $key => $value) {
                    $from = ($value->from_community_id ? ['Ulkoinen', DB::table('community')->join('company', 'community_company_id', 'company_id')->where('community_id', $value->from_community_id)->first()->company_name . ', (' . DB::table('community')->where('community_id', $value->from_community_id)->first()->community_city . ')'] :
                        ($value->from_supplier ? ['Toimittaja', $value->from_supplier] :
                            ['Sisäinen', $value->from_microlocation_name]));
                    $output .= '<tr class="text-left">' .
                        '<td class="text-center">' . date("d-m-Y", strtotime($value->receipt_date)) . '</td>' .
                        '<td>' . title_case($from[0]) . '</td>' .
                        '<td>' . title_case(mb_strimwidth($from[1], 0, 35, '...')) . '</td>' .
                        '<td>' . title_case($value->to_microlocation_name) . '</td>' .
                        '<td>' . $value->material_name . '</td>' .
                        '<td class="text-right">' . $value->receipt_weight . '</td>' .
                        '<td class="text-right">' . $value->distance_km . '</td>' .
                        '<td class="text-right">' . $value->receipt_ewc_code . '</td>' .
                        '<td class="text-center"><i style="color:' . ($value->is_for_issue ? 'green' : 'red') . '" class="material-icons">' . ($value->is_for_issue ? 'check_circle_outline' : 'highlight_off') . '</i></td>' .
                        (Auth::user()->user_type_id < 3 || Auth::user()->user_microlocation_id == $value->to_microlocation_id ? '<td class="text-center"><a href="' . url('companies/' . $company->company_id . '/manage/receipts/' . $value->receipt_id . '/edit') . '"><i class="material-icons">edit</i></a></td>' : '') .
                        '</tr>';
                }
                $output .= '<tr>' .
                    '<td></td>' .
                    '<td></td>' .
                    '<td></td>' .
                    '<td></td>' .
                    '<td></td>' .
                    '<td class="text-right">' . $result->sum('receipt_weight') . ' Total</td>' .
                    '<td class="text-right">' . $result->sum('distance_km') . ' Total</td>' .
                    '<td></td>' .
                    '<td></td>' .
                    '<td></td>' .
                    '</tr>';
                return Response($output);
            }
        }
    }


    // Used when selecting the source that the material for this receipt originated from
    public function source(Request $request, company $company) {
        if ($request->ajax()) {
            $ml_id = $request->ml_id ? $request->ml_id : 0;
            $community_id = $request->community_id ? $request->community_id : 0;
            $company_id = $community_id ? DB::table('community')->where('community_id', '=', $community_id)->first()->community_company_id : 0;
            $supplier = $request->supplier ? $request->supplier : '';
            $output = "";
            $source = $request->input('source');
            if ($source == 'internal') {
                $result = DB::table('microlocations')->where('microlocation_company_id', '=', $company->company_id)->get();
                if ($result->count() > 0) {

                    $output .= '<label class="col-sm-2 col-form-label" for="from_microlocation">Toimipisteestä:</label>';
                    $output .= '<div class="col-sm-10">';
                    $output .= '<select class="form-control element-width-auto form-field-width" name="from_microlocation">';
                    $output .= '<option selected="selected" disabled hidden value=""></option>';
                    foreach ($result as $key => $value) {
                        $output .= '<option value="' . $value->microlocation_id . '" ' . ($ml_id == $value->microlocation_id ? 'selected="selected"' : '') . '>' . title_case($value->microlocation_name) . '</option>';
                    }
                    $output .= '</select></div>';
                } else {
                    $output .= '<option>ei sopivia kirjauksia</option>';
                }
            } elseif ($source == 'external') {
                $result = DB::table('company')->where('company_id', '!=', $company->company_id)->get();
                if ($result->count() > 0) {

                    $output .= '<label class="col-sm-2 col-form-label" for="from_company">Organisaatiosta:</label>';
                    $output .= '<div class="col-sm-10">';
                    $output .= '<select class="form-control element-width-auto form-field-width" id="from_company" name="from_company">';
                    $output .= '<option selected="selected" disabled hidden value=""></option>';
                    foreach ($result as $key => $value) {
                        $output .= '<option value="' . $value->company_id . '" ' . ($company_id == $value->company_id ? 'selected="selected"' : '') . '>' . title_case($value->company_name) . '</option>';
                    }
                    $output .= '</select></div>';
                } else {
                    $output .= '<option>ei sopivia kirjauksia</option>';
                }
            } elseif ($source == 'supplier') {
                $output .= '<label class="col-sm-2 col-form-label" for="from_supplier">Toimittajalta:</label>';
                $output .= '<div class="col-sm-10"><input type="text" class="form-control element-width-auto form-field-width" name="from_supplier" value="' . $supplier . '"/>';
                $output .= '</div>';
            }
            return Response($output);
        }
    }


    // Used when selecting the source that the material for this receipt originated from
    public function communities(Request $request, company $company) {
        if ($request->ajax()) {
            $output = "";
            $community_id = $request->input('community_id') ?: 0;
            $from_company = $request->input('from_company') ?: DB::table('community')->where('community_id', '=', $community_id)->first()->community_company_id;
            $result = DB::table('community')
                ->where('community_company_id', '=', $from_company)
                ->get();
            if ($result) {
                $output .= '<label class="col-sm-2 col-form-label" for="from_community">Kunnasta:</label><div class="col-sm-10"><select class="form-control element-width-auto form-field-width" name="from_community">';
                $output .= '<option selected="selected" disabled hidden value=""></option>';
                foreach ($result as $key => $value) {
                    $output .= '<option value="' . $value->community_id . '" ' . ($value->community_id == $community_id ? 'selected="selected"' : '') . '>' . title_case($value->community_city) . '</option>';
                }
                $output .= '</select></div>';
            }
            return Response($output);
        }
    }
}
