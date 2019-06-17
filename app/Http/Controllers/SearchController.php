<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
class SearchController extends Controller {
	public function index() {
		return view('search');
	}
	public function search(Request $request){
		if($request->ajax()){
			$output="";
			$products=DB::table('users')->where('username','LIKE','%'.$request->search."%")->get();
			if($products){
				foreach ($products as $key => $product){
					$output.='<tr>'.
						'<td>'.$product->user_id.'</td>'.
						'<td>'.$product->username.'</td>'.
						'<td>'.$product->first_name.'</td>'.
						'<td>'.$product->last_name.'</td>'.
						'</tr>';
				}
				return Response($output);
			}
		}
	}
}