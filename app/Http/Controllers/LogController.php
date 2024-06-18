<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class LogController extends Controller {

	public function index() {

		$activities = Activity::with( 'causer' )->with( 'subject' )->paginate( 15 );

		return view( 'logs.index' )->with( 'activities', $activities );
	}
}
