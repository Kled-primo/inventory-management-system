<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogController extends Controller {

	public function index() {

		$activities = Activity::all();

		return view( 'logs.index' )->with( 'activities', $activities );
	}
}
