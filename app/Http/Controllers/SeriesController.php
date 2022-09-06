<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SeriesController extends Controller
{
    public function index(){
        $series = ['Lost', 'Friends', 'The Ressurection'];

        return view('series.index')->with('series',$series);
    }
}
