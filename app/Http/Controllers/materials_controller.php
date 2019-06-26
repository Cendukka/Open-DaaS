<?php

namespace App\Http\Controllers;

use App\company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\material;

class materials_controller extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(material $material) {
		return view('pages.company.manage.materials');
	}
	
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create(material $material) {
		return view('pages.company.manage.materials_create');
	}
	
	/**
	 * Store a newly created resource in storage.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		# ADD MORE AUTHENTICATION HERE
		
		$request->validate([
			'name' => 'required|max:50',
		]);
		
		
		$material = new material([
			'material_name' => $request->get('name'),
		]);
		$material->save();
		return redirect()->action('materials_controller@index')->withErrors(['Material successfully created.']);
	}
	
	/**
	 * Display the specified resource.
	 *
	 * @param int $id
	 * @return \Illuminate\Http\Response
	 */
	public function show(material $material) {
		return redirect()->action('materials_controller@index');
	}
	
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param int $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit(material $material) {
		return view('pages.company.manage.materials_edit')->with('material',$material);
	}
	
	/**
	 * Update the specified resource in storage.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @param int $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, material $material) {
		# ADD MORE AUTHENTICATION HERE

        if (isset($_POST['update_button'])) {
            $request->validate([
                'name' => 'required|max:50',
            ]);

            $materialNew = material::find($material->material_id);

            $materialNew->material_name = $request->get('name');
            $materialNew->save();

            return redirect()->action('materials_controller@index')->withErrors(['Material successfully updated.']);

        } else if (isset($_POST['delete_button'])) {
            return $this->destroy($material);
        } else {
            //no button pressed
        }
		
		$request->validate([
			'name' => 'required|max:50',
		]);
		
		
		/*$materialNew = material::find($material->material_id);
		
		$materialNew->material_name = $request->get('name');
		$materialNew->save();
		
		return redirect()->action('materials_controller@index')->withErrors(['Material successfully updated.']);*/
	}
	
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param int $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(material $material) {
		$mat = material::find($material->material_id);
		$mat->delete();
		
		return redirect()->action('materials_controller@index')->withErrors(['Material successfully deleted.']);
	}
}
