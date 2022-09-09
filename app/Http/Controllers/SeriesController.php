<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeriesFormRequest;
use App\Models\Series;
use App\Repositories\SeriesRepository;
use Illuminate\Http\Request;

class SeriesController extends Controller
{
    public function __construct(private SeriesRepository $repository)
    {
        
    }

    public function index(){
        // $series = Serie::all();
        $series = Series::query()->orderBy('name')->get();

        return view('series.index')->with('series',$series);
    }

    public function create(){
        return view('series.create');
    }

    public function store(SeriesFormRequest $request){
        $serie = $this->repository->add($request);

        // return redirect(route('series.index'));
        // return redirect()->route('series.index');
        return to_route('series.index')->with('mensagem', "Série cadastrada com sucesso!"); //funciona desde o laravel 9
    }

    public function destroy(Request $request){
        Series::destroy($request->id);
        return redirect()->route('series.index');
    }

    public function edit(Series $series){
        return view('series.edit')->with('serie', $series);
    }

    public function update(Series $series, SeriesFormRequest $request){
        $series->fill($request->all());
        $series->save();

        return to_route('series.index')->with('mensagem', "Série '{$series->nome}' atualizada!");
    }
}
