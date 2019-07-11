<?php

namespace App\Http\Controllers;

    use App\company;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\DB;
    use App\pre_sorting;

class pre_controller extends Controller {

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(company $company) {
        return view('pages.company.pre')->with('company', $company);
    }


    public function create(company $company) {
        return view('pages.company.manage.pre_create')->with('company', $company);
    }


    public function store(Request $request, company $company) {
        # ADD MORE AUTHENTICATION HERE

        $request->validate([
            'user' => 'required|integer',
            'datetime' => 'required|date_format:Y-m-d H:i:s',
            'receipt' => 'integer|integer',
            'material' => 'required|integer',
            'weight' => 'required|integer',
        ]);

        $receipt = $request->get('receipt');
        $microlocation = DB::table('inventory_receipt')->where('receipt_id',$receipt)->first()->receipt_to_microlocation_id;
        $material = $request->get('material');
        $weight = $request->get('weight');

        $pre = new pre_sorting([
            'pre_sorting_user_id' => $request->get('user'),
            'pre_sorting_date' => $request->get('datetime'),
            'pre_sorting_receipt_id' => $receipt,
            'pre_sorting_material_id' => $material,
            'pre_sorting_weight' => $weight,
        ]);
        $pre->save();

        app('App\Http\Controllers\microlocation_controller')->add_inventory($microlocation, '1', -$weight);
        if(DB::table('material_names')->where('material_type', '=', 'refined')->get()->contains('material_id', $material)){
            app('App\Http\Controllers\microlocation_controller')->add_inventory($microlocation, $material, $weight);
        }
        return redirect()->action('pre_controller@index', ['company' => $company])->withErrors(['Pre-sorting successfully created.']);
    }


    public function show(company $company, pre_sorting $pre) {

    }


    public function edit(company $company, pre_sorting $pre) {
        return view('pages.company.manage.pre_edit')->with(['company' => $company, 'pre' => $pre]);
    }


    public function update(Request $request, company $company, pre_sorting $pre) {
        # ADD MORE AUTHENTICATION HERE

        $request->validate([
            'user' => 'required|integer',
            'datetime' => 'required|date_format:Y-m-d H:i:s',
            'receipt' => 'integer|integer',
            'material' => 'required|integer',
            'weight' => 'required|integer',
        ]);

        $receipt = $request->get('receipt');
        $material = $request->get('material');
        $weight = $request->get('weight');

        $preNew = pre_sorting::find($pre->pre_sorting_id);
        $preNew->pre_sorting_user_id = $request->get('user');
        $preNew->pre_sorting_date = $request->get('datetime');
        $preNew->pre_sorting_receipt_id = $receipt;
        $preNew->pre_sorting_material_id = $material;
        $preNew->pre_sorting_weight = $weight;

        $microlocation_orig = DB::table('inventory_receipt')->where('receipt_id',$preNew->getOriginal('pre_sorting_receipt_id'))->first()->receipt_to_microlocation_id;
        $microlocation_new = DB::table('inventory_receipt')->where('receipt_id',$receipt)->first()->receipt_to_microlocation_id;

        # Remove original weights from the inventory
        app('App\Http\Controllers\microlocation_controller')->add_inventory($microlocation_orig, '1', $preNew->getOriginal('pre_sorting_weight'));
        app('App\Http\Controllers\microlocation_controller')->add_inventory($microlocation_orig, $preNew->getOriginal('pre_sorting_material_id'), -$preNew->getOriginal('pre_sorting_weight'));

        $preNew->save();

        # Add new weights to the inventory
        app('App\Http\Controllers\microlocation_controller')->add_inventory($microlocation_new, '1', -$weight);
        if(DB::table('material_names')->where('material_type', '=', 'refined')->get()->contains('material_id', $material)){
            app('App\Http\Controllers\microlocation_controller')->add_inventory($microlocation_new, $material, $weight);
        }
        return redirect()->action('pre_controller@index',['company' => $company])->withErrors(['Pre-sorting successfully updated.']);
    }


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
            $result=DB::table('pre_sorting')
                ->whereIn('receipt_to_microlocation_id', $microlocation_ids)
                ->when(($request->from && $request->to), function($query) use ($request){
                    $query->whereBetween('pre_sorting_date', [date("Y-m-d",strtotime($request->from)), date("Y-m-d H:i:s",strtotime($request->to.' 23:59:59'))]);
                })
                ->where(function ($query) use ($request){
                    $query
                        ->where('microlocation_name','LIKE','%'.$request->search."%")
                        ->orWhere('material_name','LIKE','%'.$request->search."%")
                        ->orWhere('pre_sorting_weight','LIKE','%'.$request->search."%")
                        ->orWhere('username','LIKE','%'.$request->search."%");
                })
                ->join('inventory_receipt','receipt_id','=','pre_sorting_receipt_id')
                ->join('microlocations','receipt_to_microlocation_id','=','microlocation_id')
                ->join('material_names','material_names.material_id','=','pre_sorting.pre_sorting_material_id')
                ->join('users','users.user_id','=','pre_sorting.pre_sorting_user_id')
                ->select()
                ->orderBy('pre_sorting_date', 'DESC')
                ->orderBy('receipt_to_microlocation_id')
                ->get();
            if($result){
                foreach ($result as $key => $value){
                    $output.='<tr>'.
                        '<td>'.title_case($value->microlocation_name).'</td>'.
                        '<td>'.date("Y-m-d",strtotime($value->pre_sorting_date)).'</td>'.
                        '<td>'.$value->pre_sorting_weight.'</td>'.
                        '<td>'.$value->material_name.'</td>'.
                        '<td>'.$value->username.'</td>'.
                        '<td><a href="'.url('companies/'.$company->company_id.'/manage/pre/'.$value->pre_sorting_id.'/edit').'"> <span class="glyphicon glyphicon-pencil"></span></a></td>'.
                        '</tr>';
                }
                $output.='<tr>'.
                    '<td></td>'.
                    '<td></td>'.
                    '<td>'.$result->sum('pre_sorting_weight').' Total</td>'.
                    '<td></td>'.
                    '<td></td>'.
                    '</tr>';
                return Response($output);
            }
        }
    }


    public function receipt(Request $request, company $company){
        if($request->ajax()){
            $output="";
            $ml_id = $request->input('ml_id') ?: 0;
            $receipt_id = $request->input('receipt_id') ?: 0;
            $result = DB::table('inventory_receipt')
                ->join('material_names','material_id','receipt_material_id')
                ->where('receipt_to_microlocation_id','=',$ml_id)
                ->where('material_names.material_name', 'Raw Waste')
                ->orderBy('receipt_date','DESC')
                ->get();
            if($result) {
                $output .= '<option selected="selected" disabled hidden value=""></option>';
                foreach ($result as $key => $value) {
                    $used = DB::table('pre_sorting')->where('pre_sorting_receipt_id',$value->receipt_id)->sum('pre_sorting_weight');
                    $output .= '<option value="'.$value->receipt_id.'" '.($value->receipt_id == $receipt_id ? 'selected="selected"' : '').'>'.title_case($value->material_name.', '.$value->receipt_date.', '.$value->receipt_weight.' kg (Sorted: '.$used.'kg)').'</option>';
                }
            }
            return Response($output);
        }
    }
}
