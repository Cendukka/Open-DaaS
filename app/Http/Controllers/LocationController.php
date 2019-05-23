<?php

namespace App\Http\Controllers;

use App\Location;
use Illuminate\Http\Request;

class LocationController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	#public function index() {
	#	$location = Location::all();
	#	return $location;
	#}
	
	public function index() {
		$allLocations = Location::all();
		return view('pages.companies')->with('allLocations',$allLocations);
	}
	
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		//
	}
	
	/**
	 * Store a newly created resource in storage.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		if (Location::Create($request->all())) {
			return true;
		}
	}
	
	/**
	 * Display the specified resource.
	 *
	 * @param \App\Location $location
	 * @return \Illuminate\Http\Response
	 */
	public function show(Location $location) {
		return $location;
	}
	
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param \App\Location $location
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Location $location) {
		//
	}
	
	/**
	 * Update the specified resource in storage.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @param \App\Location $location
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Location $location) {
		if ($location->fill($request->all())->save()) {
			return true;
		}
	}
	
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param \App\Location $location
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Location $location) {
		if ($location->delete()) {
			return true;
		}
	}
}
