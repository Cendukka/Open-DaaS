<?php

namespace App\Http\Controllers;

use App\company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\inventory_receipt;
use Illuminate\Support\Str;

class receipt_controller extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(company $company) {
		return view('pages.company.manage.receipts')->with('company', $company);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create(company $company) {
		return view('pages.company.manage.receipt_create')->with('company', $company);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request, company $company) {
		# ADD MORE AUTHENTICATION HERE
        #dd($request);
		$request->validate([
			'user' => 'required|integer',
			'datetime' => 'required|date_format:Y-m-d H:i:s',
            'material' => 'required|integer',
			'source' => 'required',
			'from_community' => 'integer|required_with:from_company',
			'from_supplier' => 'integer',
            'from_microlocation' => 'integer',
			'to_microlocation' =>'required|integer',
			'distance' => 'required|integer',
			'weight' => 'required|integer',
			'ewc' => 'required|max:6|digits_between:0,9',
		]);


		$receipt = new inventory_receipt([
            'receipt_user_id' => $request->get('user'),
            'receipt_date' => $request->get('datetime'),
			'receipt_material_id' => $request->get('material'),
			'from_community_id' => $request->get('from_community'),
			'from_supplier_id' => $request->get('from_supplier'),
			'receipt_from_microlocation_id' => $request->get('from_microlocation'),
			'receipt_to_microlocation_id' => $request->get('to_microlocation'),
			'distance_km' => $request->get('distance'),
			'receipt_weight' => $request->get('weight'),
			'receipt_ewc_code' => $request->get('ewc'),
		]);
		$receipt->save();
//        return RedirectToAction("receipt_index", "MyController");
//        return view('pages.company.receipts')->with('company', $company);
		return redirect()->action('company_controller@receipts_index', ['company' => $company])->withErrors(['Receipt successfully created.']);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param int $id
	 * @return \Illuminate\Http\Response
	 */
	public function show(company $company) {
		return redirect()->action('receipt_controller@index', ['company' => $company]);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param int $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit(company $company, inventory_receipt $receipt) {
		return view('pages.company.manage.receipt_edit')->with(['company' => $company, 'receipt' => $receipt]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @param int $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, company $company, inventory_receipt $receipt) {
		# ADD MORE AUTHENTICATION HERE

		$request->validate([
			'user_type' => 'required|integer',
			'company' => 'required|integer',
			'microlocation' => 'nullable|integer',
			'first_name'=>'required|max:50',
			'last_name'=> 'required|max:50',
			'password'=> 'required',
		]);

		#####################
		$receiptNew = inventory_receipt::find($receipt->receipt_id);
		$receiptNew->user_type_id = $request->get('user_type');
		$receiptNew->user_company_id = $request->get('company');
		$receiptNew->user_microlocation_id = $request->get('microlocation');
		$receiptNew->last_name = $request->get('last_name');
		$receiptNew->first_name = $request->get('first_name');
		$receiptNew->password = $request->get('password');
		$receiptNew->save();



		return redirect()->action('receipt_controller@index',['company' => $company])->withErrors(['Receipt successfully updated.']);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param int $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id) {
		//
	}

    public function search(Request $request, company $company){
        if($request->ajax()){
            $microlocations = DB::table('microlocations')
                ->where('microlocation_company_id','=',$company->company_id)
                ->get();
            $microlocation_ids = [];
            foreach ($microlocations as $microlocation){
                array_push($microlocation_ids, $microlocation->microlocation_id);
            }
            $output="";
            $result=DB::table('inventory_receipt')
                ->whereIn('receipt_to_microlocation_id', $microlocation_ids)
                ->when(($request->from && $request->to), function($query) use ($request){
                    return $query->whereBetween('receipt_date', [date("Y-m-d",strtotime($request->from)), date("Y-m-d",strtotime($request->to))]);
                })
                ->where(function ($query) use ($request){
                    $query
                        ->where('microlocation_name','LIKE','%'.$request->search."%")
                        ->orWhere('material_name','LIKE','%'.$request->search."%")
                        ->orWhere('receipt_ewc_code','LIKE','%'.$request->search."%");
                })
                ->join('material_names','receipt_material_id','=','material_id')
                ->join('microlocations','receipt_to_microlocation_id','=','microlocation_id')
                ->orderBy('receipt_date')
                ->orderBy('receipt_to_microlocation_id')
                ->get();
            #dd($result);
            if($result){
                $sumweight = 0;
                foreach ($result as $key => $value){
                    $fromid =  ($value->from_community_id ? 'Community '.$value->from_community_id :
                        ($value->from_supplier_id ? 'Supplier '.$value->from_supplier_id :
                            'Microlocation '.$value->receipt_from_microlocation_id));
                    $output.='<tr>'.
                        '<td>'.$value->receipt_date.'</td>'.
                        '<td>'.title_case($value->microlocation_name).'</td>'.
                        '<td>'.$fromid.'</td>'.
                        '<td>'.$value->material_name.'</td>'.
                        '<td>'.$value->receipt_weight.'</td>'.
                        '<td>'.$value->distance_km.'</td>'.
                        '<td>'.$value->receipt_ewc_code.'</td>'.
                        '</tr>';
                    $sumweight += $value->receipt_weight;
                }
                $output.='<tr>'.
                    '<td></td>'.
                    '<td></td>'.
                    '<td></td>'.
                    '<td></td>'.
                    '<td>'.$sumweight.' Total</td>'.
                    '<td></td>'.
                    '</tr>';
                return Response($output);
            }
        }
    }
    public function source(Request $request, company $company){
        if($request->ajax()){
            $ml_id = $request->ml_id ? $request->ml_id : 0;
            $community_id = $request->community_id ? $request->community_id : 0;
            $company_id = $community_id ? DB::table('community')->where('community_id','=',$community_id)->first()->community_company_id : 0;
            $supplier_id = $request->supplier_id ? $request->supplier_id : 0;
            $output="";
            $source = $request->input('source');
            if($source == 'internal'){
                $result = DB::table('microlocations')->where('microlocation_company_id','=',$company->company_id)->get();
                if($result) {
                    $output .= '<div id="from_microlocation" class="form-group">';
                    $output .= '<label for="from_microlocation">Microlokaatiosta:&nbsp</label><select name="from_microlocation">';
                    $output .= '<option selected="selected" disabled hidden value=""></option>';
                    foreach ($result as $key => $value) {
                        $output .= '<option value="'.$value->microlocation_id.'">'.title_case($value->microlocation_name).'</option>';
                    }
                    $output .= '</select></div>';
                }
            }
            elseif($source == 'external'){
                $result = DB::table('company')->where('company_id','!=',$company->company_id)->get();
                if($result) {
                    $output .= '<div class="form-group">';
                    $output .= '<label for="from_company">Yhtiöstä:&nbsp</label><select id="from_company" name="from_company">';
                    $output .= '<option selected="selected" disabled hidden value=""></option>';
                    foreach ($result as $key => $value) {
                        $output .= '<option value="'.$value->company_id.'" '.($company_id == $value->company_id ? 'selected="selected"' : '').'>'.title_case($value->company_name).'</option>';
                    }
                    $output .= '</select></div>';
                    $output .= '<div id="from_community" class="form-group">';
                    $output .= '</select></div>';
                }
            }
            elseif($source == 'supplier'){
                $result = DB::table('supplier')->get();
                if($result) {
                    $output .= '<div class="form-group">';
                    $output .= '<label for="from_supplier">Toimittajalta:&nbsp</label><select id="from_supplier" name="from_supplier">';
                    $output .= '<option selected="selected" disabled hidden value=""></option>';
                    foreach ($result as $key => $value) {
                        $output .= '<option value="'.$value->supplier_id.'" '.($supplier_id == $value->supplier_id ? 'selected="selected"' : '').'>'.title_case($value->supplier_name).'</option>';
                    }
                    $output .= '</select></div>';
                }
            }
            return Response($output);
        }
    }
    public function communities(Request $request, company $company){
        if($request->ajax()){
            $output="";
            $community_id = $request->input('community_id') ?: 0;
            $from_company = $request->input('from_company') ?: DB::table('community')->where('community_id','=',$community_id)->first()->community_company_id;
            $result = DB::table('community')
                ->where('community_company_id','=',$from_company)
                ->get();
            if($result) {
                $output .= '<label for="from_community">Kunnasta:&nbsp</label><select name="from_community">';
                $output .= '<option selected="selected" disabled hidden value=""></option>';
                foreach ($result as $key => $value) {
                    $output .= '<option value="'.$value->community_id.'" '.($value->community_id == $community_id ? 'selected="selected"' : '').'>'.title_case($value->community_city).'</option>';
                }
                $output .= '</select>';
            }
            return Response($output);
        }
    }
}
