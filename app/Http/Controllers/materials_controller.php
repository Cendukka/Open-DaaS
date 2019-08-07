<?php

namespace App\Http\Controllers;

use App\company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\material;

class materials_controller extends Controller {
	public function __construct()
    {
        $this->middleware('auth');
    }
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(material $material) {
		return view('pages.company.manage.materials');
	}


	public function create(material $material) {
		return view('pages.company.manage.materials_create');
	}


	public function store(Request $request) {
		# ADD MORE AUTHENTICATION HERE

		$request->validate([
			'name' => 'required|max:50',
			'type' => 'required','in:["textile","retired","raw waste","refined","presorted"]',
		]);

		$material = new material([
			'material_name' => $request->get('name'),
			'material_type' => $request->get('type'),
		]);

		$material->save();
		return redirect()->action('materials_controller@index')->withErrors(['Materiaali lisätty onnistuneesti.']);
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
            'type' => 'required','in:["textile","retired","raw waste","refined","presorted"]',
        ]);

		$materialNew = material::find($material->material_id);

		$materialNew->material_name = $request->get('name');
		$materialNew->material_type = $request->get('type');
		$materialNew->save();

		return redirect()->action('materials_controller@index')->withErrors(['Materiaali päivitetty onnistuneesti.']);
	}


	public function destroy(material $material) {
		$mat = material::find($material->material_id);
		$mat->delete();

		return redirect()->action('materials_controller@index')->withErrors(['Materiaali poistettu onnistuneesti.']);
	}
}
