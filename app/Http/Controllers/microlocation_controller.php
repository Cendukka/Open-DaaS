<?php

// This file contains functions for controlling microlocations

namespace App\Http\Controllers;

use App\community;
use App\company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\microlocation;

class microlocation_controller extends Controller {
    public function __construct() {
        $this->middleware('auth');
    }


    public function index(company $company) {
        return view('pages.company.manage.microlocations')->with('company', $company);
    }


    public function create(company $company) {
        return view('pages.company.manage.microlocation_create')->with('company', $company);
    }


    public function store(Request $request, company $company) {
        $request->validate([
            #'company' => 'required|integer',
            'type' => 'required|integer',
            'name' => 'max:191',
            'address' => 'required|max:191',
            'postal_code' => 'required|min:5|max:5|digits_between:0,9',
            'city' => 'required|max:50',
        ]);

        $ml = new microlocation([
            'microlocation_company_id' => $company->company_id,
            'microlocation_type_id' => $request->get('type'),
            'microlocation_name' => $request->get('name'),
            'microlocation_street_address' => $request->get('address'),
            'microlocation_postal_code' => $request->get('postal_code'),
            'microlocation_city' => $request->get('city'),
            'is_disabled' => ($request->get('is_disabled') == 'on' ? 1 : 0),
        ]);

        $ml->save();

        if (DB::table('community')->where('community_company_id', '=', $company->company_id)->where('community_city', '=', $request->get('city'))->get()->count() == 0) {
            $communityNew = new community([
                'community_company_id' => $company->company_id,
                'community_city' => $request->get('city'),
            ]);
            $communityNew->save();
        }

        return redirect()->action('microlocation_controller@index', ['company' => $company])->withErrors(['Toimipiste luotu onnistuneesti.']);
    }


    public function show(company $company, microlocation $microlocation) {
        return view('pages.company.manage.microlocation_home')->with('company', $company)->with('microlocation', $microlocation);
    }


    public function edit(company $company, microlocation $microlocation) {
        return view('pages.company.manage.microlocation_edit')->with(['company' => $company, 'microlocation' => $microlocation]);
    }


    public function update(Request $request, company $company, microlocation $microlocation) {
        $request->validate([
            'type' => 'required|integer',
            'name' => 'max:191',
            'address' => 'required|max:191',
            'postal_code' => 'required|min:5|max:5|digits_between:0,9',
            'city' => 'required|max:50',
        ]);

        $microlocationNew = microlocation::find($microlocation->microlocation_id);

        $microlocationNew->microlocation_company_id = $company->company_id;
        $microlocationNew->microlocation_type_id = $request->get('type');
        $microlocationNew->microlocation_name = $request->get('name');
        $microlocationNew->microlocation_street_address = $request->get('address');
        $microlocationNew->microlocation_postal_code = $request->get('postal_code');
        $microlocationNew->microlocation_city = $request->get('city');
        $microlocationNew->is_disabled = ($request->get('is_disabled') == 'on' ? 1 : 0);
        $microlocationNew->save();

        return redirect()->action('microlocation_controller@index', ['company' => $company])->withErrors(['Toimipiste päivitetty onnistuneesti.']);
    }


    public function destroy($id) {
        //
    }

    # For making adding and removing weight from the inventory table
    public function add_inventory($microlocation, $material, $weight) {
        DB::table('inventory')
            ->updateOrInsert(
                [
                    'inventory_microlocation_id' => $microlocation,
                    'inventory_material_id' => $material,
                ], [
                    'inventory_weight' => \DB::raw('inventory_weight + ' . $weight),
                ]
            );
    }
}
