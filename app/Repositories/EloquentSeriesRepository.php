<?php

namespace App\Repositories;

use App\Http\Requests\SeriesFormRequest;
use App\Models\Episode;
use App\Models\Season;
use App\Models\Series;
use Illuminate\Support\Facades\DB;

class EloquentSeriesRepository implements SeriesRepository {

    public function add(SeriesFormRequest $request): Series{
        return DB::Transaction(function () use ($request) {
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

            return $serie;
        });
    }
}