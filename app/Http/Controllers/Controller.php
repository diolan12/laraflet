<?php

namespace App\Http\Controllers;

use App\Models\Cable;
use App\Models\Multi;
use App\Models\Point;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;

use Illuminate\Http\Request;
use App\Models\User;

class Controller extends BaseView
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index()
    {
        $this->data['cables'] = Cable::all();
        return $this->render('index');
    }

    public function cable(string $cableID) {
        $cable = Cable::find($cableID);
        $this->data['cable'] = $cable;
        
        $coords = json_decode($cable->line->toJson())->coordinates;
        $lat = 0;
        $lng = 0;
        foreach($coords as $latlng) {
            $lat += $latlng[0];
            $lng += $latlng[1];
        }
        $count = count($coords);
        $this->data['centerView'] = [$lat/$count, $lng/$count];

        return $this->render('cable');
    }

    public function addPoint(Request $req, $pointID) {
        $data = $req->all();
        $data['multi_id'] = $pointID;
        $point = new Point();
        $id = $point->insertGetId($data);
        return response()->json(Point::find($id), 201);
    }

    public function deletePoint($pointID) {
        $del = Point::where('multi_id', $pointID)->latest('id')->first();
        $del->forceDelete();
        return response()->json($del, 204);
    }

    public function v3() {
    }
}