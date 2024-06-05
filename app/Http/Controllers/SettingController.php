<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::all();

        return view('settings.index')->with('settings', $settings);
    }

    public function save(Request $request)
    {
        Setting::create($request->all());

        return redirect()->route('settings.index');
    }
}
