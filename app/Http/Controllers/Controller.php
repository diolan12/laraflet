<?php

namespace App\Http\Controllers;

use App\Models\Connection;
use App\Models\ConnectionBreakpoint;
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
use cbschuld\UuidBase58;

// use App\Models\User;

class Controller extends BaseView
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index()
    {
        $this->data['locations'] = Location::with(['froms', 'tos'])->orderBy('name')->get();
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
        $conn->uuid = UuidBase58::id();
        $conn->save();
        $locFrom = Location::find($request->from);
        $locTo = Location::find($request->to);
        Hop::create([
            'connection_id' => $conn->id,
            'qrcode' => 'RJ04' . $conn->id,
            'line' => new LineString([
                new Point($locFrom->point->latitude, $locFrom->point->longitude, 4326),
                new Point($locTo->point->latitude, $locTo->point->longitude, 4326)
            ], 4326)
        ]);
        return Connection::with(['from', 'to'])->findOrFail($conn->id);
    }

    public function conn(Request $request, $connID)
    {
        $conn = Connection::with(['from', 'to', 'break_points', 'hops'])->where('uuid', $connID)->first();
        if ($conn == null) {
            return abort(404);
        }
        $this->data['connection'] = $conn;
        return $this->render('cable');
    }
    public function newBreakPoint(Request $request, $connID)
    {
        $conn = Connection::with(['from', 'to', 'break_points', 'hops'])->where('uuid', $connID)->first();
        if ($conn == null) {
            return abort(404);
        }
        return ConnectionBreakpoint::create([
            'connection_id' => $conn->id,
            'point' => new Point($request->lat, $request->lng, 4326)
        ]);
    }
    public function updateHopLine(Request $request, $hopID)
    {
        if (!$request->has('latlngs')) {
            abort(400);
        }
        $latlngs = json_decode($request->latlngs);
        $hop = Hop::with(['connection.from', 'connection.to'])->find($hopID);
        if ($hop == null) {
            abort(404);
        }
        $coordPoints = [];
        foreach ($latlngs as $latlng) {
            $coordPoints[] = new Point($latlng->lat, $latlng->lng, 4326);
        }
        $hop->line = new LineString($coordPoints, 4326);
        $hop->save();
        return $hop;
    }

}