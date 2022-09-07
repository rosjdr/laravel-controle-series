<?php

namespace App\Http\Controllers;

use App\Models\Serie;
use Illuminate\Http\Request;

class SeriesController extends Controller
{
    public function index(){
        // $series = Serie::all();
        $series = Serie::query()->orderBy('nome')->get();

        return view('series.index')->with('series',$series);
    }

    public function create(){
        return view('series.create');
    }

    public function store(Request $request){
        Serie::create($request->all());

        // return redirect(route('series.index'));
        // return redirect()->route('series.index');
        return to_route('series.index'); //funciona desde o laravel 9
    }

    public function destroy(Request $request){
        Serie::destroy($request->id);
        return redirect()->route('series.index');
    }

    public function edit(Serie $series){
        return view('series.edit')->with('serie', $series);
    }

    public function update(Serie $series, Request $request){
        $series->fill($request->all());
        $series->save();

        return to_route('series.index')->with('mensagem', "Série '{$series->nome}' atualizada!");
    }
}
