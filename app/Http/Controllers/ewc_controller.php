<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\ewc_codes;

class ewc_controller extends Controller {
    public function index(){
		return view('pages.ewc');
    }


    public function create(){
        return view('pages.company.manage.ewc_create');
    }


    public function store(Request $request){
        $request->validate([
            'ewc_code' => 'required|max:6|min:6|unique:ewc_codes|digits_between:0,9',
            'description' => 'required|max:191',
        ]);

        $ewc_code = new ewc_codes([
            'ewc_code' => $request->get('ewc_code'),
            'description' => $request->get('description'),
        ]);
        $ewc_code->save();

        return redirect()->action('ewc_controller@index')->withErrors(['EWC Code successfully created.']);
    }


    public function show($id){
        return redirect()->action('ewc_controller@index');
    }


    public function edit(ewc_codes $ewc_code){
        return view('pages.company.manage.ewc_edit')->with(['ewc_code' => $ewc_code]);
    }


    public function update(Request $request, ewc_codes $ewc_code) {
        $request->validate([
            #'ewc_code' => 'required|max:6|digits_between:0,9', // Miksi kommentoituna?
            'description' => 'required|max:191',
        ]);

        $ewcNew = ewc_codes::find($ewc_code->ewc_code);

        #$ewcNew->ewc_code = $request->get('ewc_code');
        $ewcNew->description = $request->get('description');
        $ewcNew->save();

        return redirect()->action('ewc_controller@index')->withErrors(['EWC Code successfully updated.']);
    }


    public function destroy(ewc_codes $ewc_code) {
        $ewc = ewc_codes::find($ewc_code->ewc_code);
        $ewc->delete();

        return redirect()->action('ewc_controller@index')->withErrors(['EWC Code successfully deleted.']);
    }


	public function search(Request $request){
		if($request->ajax()){
			$output="";
			$result = DB::table('ewc_codes')
                ->where('ewc_code','LIKE','%'.$request->search."%")
                ->orWhere('description','LIKE','%'.$request->search."%")
                ->get();
			if($result){

				foreach ($result as $key => $value){
					$output.='<tr>'.
						'<td><a href="'.url('/ewc/'.$value->ewc_code.'/edit').'">'.$value->ewc_code.'</a></td>'.
						'<td>'.$value->description.'</td>'.
						'</tr>';
				}
				return Response($output);
			}
		}
	}
}
