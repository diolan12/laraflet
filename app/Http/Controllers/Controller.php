<?php

namespace App\Http\Controllers;

use App\Models\Connection;
use App\Models\Fo;
use App\Models\Hop;
use App\Models\Location;
use App\Models\Witel;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;

use Illuminate\Http\Request;
use MatanYadaev\EloquentSpatial\Objects\Point;
use MatanYadaev\EloquentSpatial\Objects\LineString;
use Illuminate\Support\Facades\DB;

// use App\Models\User;

class Controller extends BaseView
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index()
    {
        $this->data['locations'] = Location::with(['froms', 'tos'])->get();
        $this->data['connections'] = Connection::with(['from', 'to', 'break_points', 'hops'])->get();
        return $this->render('index');
    }

    public function saveLocation(Request $request)
    {

        $data = $request->all();
        $data['name'] = ucfirst($data['name']);
        $data['type'] = 'sto';
        $data['point'] = new Point($data['lat'], $data['lng'], 4326);
        return Location::create($data);
    }
    public function saveConnection(Request $request)
    {
        $conn = Connection::create($request->all());
        return Connection::with(['from', 'to'])->findOrFail($conn->id);
    }

    public function cable(Request $request, $connID)
    {
        $conn = Connection::with(['from', 'to', 'break_points', 'hops'])->find($connID);
        if ($conn == null) {
            return abort(404);
        }
        $this->data['connection'] = $conn;
        return $this->render('cable');
    }

    public function updateHopLine(Request $request, $hopID){
        if (!$request->has('latlngs')){
            abort(400);
        }
        $latlngs = json_decode($request->latlngs);
        $hop = Hop::find($hopID);
        if ($hop == null) {
            abort(404);
        }
        $coordPoints = [];
        foreach($latlngs as $latlng){
            $coordPoints[] = new Point($latlng->lat, $latlng->lng, 4326);
        }
        $hop->line =  new LineString($coordPoints, 4326);
        $hop->save();
        return $hop;
    }

}