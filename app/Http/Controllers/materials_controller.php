<?php

namespace App\Http\Controllers;

use App\company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\material;

class materials_controller extends Controller {


	public function index() {
		return view('pages.company.manage.materials');
	}


	public function create(material $material) {
		return view('pages.company.manage.materials_create');
	}


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


	public function show(material $material) {
		return redirect()->action('materials_controller@index');
	}


	public function edit(material $material) {
		return view('pages.company.manage.materials_edit')->with('material',$material);
	}


	public function update(Request $request, material $material) {
		# ADD MORE AUTHENTICATION HERE
		
		$request->validate([
			'name' => 'required|max:50',
		]);
		
		$materialNew = material::find($material->material_id);
		
		$materialNew->material_name = $request->get('name');
		$materialNew->retired = ($request->get('retired') == 'on' ? 1 : 0);
		$materialNew->save();
		
		return redirect()->action('materials_controller@index')->withErrors(['Material successfully updated.']);
	}


	public function destroy(material $material) {
		$mat = material::find($material->material_id);
		$mat->delete();
		
		return redirect()->action('materials_controller@index')->withErrors(['Material successfully deleted.']);
	}
}
