<?php

namespace App\Http\Controllers;

use App\company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\microlocation;

class microlocation_controller extends Controller {
	public function __construct()
    {
        $this->middleware('auth');
    }
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(company $company) {
		return view('pages.company.manage.microlocations')->with('company', $company);
	}


	public function create(company $company) {
		return view('pages.company.manage.microlocation_create')->with('company', $company);
	}


	public function store(Request $request, company $company) {
		# ADD MORE AUTHENTICATION HERE
		
		$request->validate([
			#'company' => 'required|integer',
			'type' => 'required|integer',
			'name' => 'max:191',
			'address'=>'required|max:191',
			'postal_code'=> 'required|min:5|max:5|digits_between:0,9',
			'city'=> 'required|max:50',
		]);
		
		
		$ml = new microlocation([
			'microlocation_company_id' => $company->company_id,
			'microlocation_type_id' => $request->get('type'),
			'microlocation_name' => $request->get('name'),
			'microlocation_street_address' => $request->get('address'),
			'microlocation_postal_code' => $request->get('postal_code'),
			'microlocation_city' => $request->get('city'),
		]);
		$ml->save();
		return redirect()->action('microlocation_controller@index', ['company' => $company])->withErrors(['Microlocation successfully created.']);
	}
	
	/**
	 * Display the specified resource.
	 *
	 * @param int $id
	 * @return \Illuminate\Http\Response
	 */
	public function show(company $company, microlocation $microlocation) {  /* ,user $user) {
		return redirect()->action('microlocation_controller@index', ['company' => $company]); */
		return view('pages.company.manage.microlocation_home')->with('company', $company)->with('microlocation', $microlocation);

	}

	
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param int $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit(company $company, microlocation $microlocation) {
		return view('pages.company.manage.microlocation_edit')->with(['company' => $company, 'microlocation' => $microlocation]);
	}


	public function update(Request $request, company $company, microlocation $microlocation) {
		# ADD MORE AUTHENTICATION HERE
		
		$request->validate([
			#'company' => 'required|integer',
			'type' => 'required|integer',
			'name' => 'max:191',
			'address'=>'required|max:191',
			'postal_code'=> 'required|min:5|max:5|digits_between:0,9',
			'city'=> 'required|max:50',
		]);
		
		
		$microlocationNew = microlocation::find($microlocation->microlocation_id);
		
		$microlocationNew->microlocation_company_id = $company->company_id;
		$microlocationNew->microlocation_type_id = $request->get('type');
		$microlocationNew->microlocation_name = $request->get('name');
		$microlocationNew->microlocation_street_address = $request->get('address');
		$microlocationNew->microlocation_postal_code = $request->get('postal_code');
		$microlocationNew->microlocation_city = $request->get('city');
		$microlocationNew->save();
		
		return redirect()->action('microlocation_controller@index',['company' => $company])->withErrors(['Microlocation successfully updated.']);
	}


    public function destroy($id) {
        //
    }

    public function add_inventory($microlocation, $material, $weight) {
        DB::table('inventory')
            ->updateOrInsert(
                [
                    'inventory_microlocation_id' => $microlocation,
                    'inventory_material_id' => $material,
                ],[
                    'inventory_weight' => \DB::raw('inventory_weight + '.$weight),
                ]
            );
    }

	public function warehouse_index(company $company, microlocation $microlocation) {
		return view('pages.company.warehouse')->with(['company' => $company, 'microlocation' => $microlocation]);
	}

}
