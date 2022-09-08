<?php

namespace App\Http\Controllers;

use App\Models\Series;
use Illuminate\Http\Request;

class SeasonController extends Controller
{
    public function index(Series $series){
        //$seasons = $series->seasons; //assim ele faz o lazy loading e já popula a collection
        $seasons = $series->seasons()->with('episodes')->get(); //assim é eager loading que faz menos consultas no banco

        return view('seasons.index')->with('seasons',$seasons)->with('series',$series);
    }
}
