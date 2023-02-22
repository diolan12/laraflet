<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Foundation\Validation\ValidatesRequests;

use Illuminate\Http\Request;
use MatanYadaev\EloquentSpatial\Objects\Point;

// use App\Models\User;

class DataController extends BaseRest
{
    use ValidatesRequests;

    private $scale = [
        591657527.591555,
        295828763.795777,
        147914381.897889,
        73957190.948944,
        36978595.474472,
        18489297.737236,
        9244648.868618,
        4622324.434309,
        2311162.217155,
        1155581.108577,
        577790.554289,
        288895.277144,
        144447.638572,
        72223.819286,
        36111.909643,
        18055.954822,
        9027.977411,
        4513.988705,
        2256.994353,
        1128.497176,
        564.248588,
        282.124294,
        141.062147,
        70.5310735
    ];

    public function locations(Request $request, $lat, $lng, $zoom)
    {
        $center = new Point($lat, $lng);
        $data = Location::query()
            ->selectRaw("*, ST_Distance_Sphere(`point`, ST_GeomFromText('$center')) AS distance")
            ->whereDistanceSphere('point', $center, '<', $this->scale[$zoom + 2])
            ->with(['froms', 'tos'])
            ->orderBy('distance')
            ->limit(250)->get();
        return $this->success($data);
    }

}