<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeriesFormRequest;
use App\Models\Episode;
use App\Models\Season;
use App\Models\Series;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;

class SeriesController extends Controller
{
    public function index(){
        // $series = Serie::all();
        $series = Series::query()->orderBy('name')->get();

        return view('series.index')->with('series',$series);
    }

    public function create(){
        return view('series.create');
    }

    public function store(SeriesFormRequest $request){
        DB::beginTransaction();
        try {
            $serie = Series::create($request->all());
            $seasons = [];
            for($i = 1; $i <= $request->season; $i++){
                $seasons[] = [
                    'series_id' => $serie->id,
                    'number' => $i
                ];
            }
            Season::insert($seasons);
    
            $episodes = [];
            foreach($serie->seasons as $season){
                for($i = 1; $i <= $request->episode; $i++){
                    $episodes[] = [
                        'season_id' => $season->id,
                        'number' => $i
                    ];
                }
            }
            Episode::insert($episodes);
            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();
        }

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
