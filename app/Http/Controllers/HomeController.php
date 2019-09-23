<?php

// This file contains functions for the home page

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller {
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        return view('pages.home');
    }
}
