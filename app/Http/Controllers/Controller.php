<?php

namespace App\Http\Controllers;

use App\Models\Connection;
use App\Models\Fo;
use App\Models\Location;
use App\Models\Witel;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;

use Illuminate\Http\Request;
use MatanYadaev\EloquentSpatial\Objects\Point;
// use App\Models\User;

class Controller extends BaseView
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index()
    {
        $this->data['witels'] = Witel::all();
        $this->data['locations'] = Location::with(['froms', 'tos'])->get();
        $this->data['connections'] = Connection::with(['from', 'to', 'break_points', 'hops'])->get();
        $this->data['fos'] = Fo::all();
        return $this->render('index');
    }

    public function saveLocation(Request $request) {

        $data = $request->all();
        $data['name'] = ucfirst($data['name']);
        $data['type'] = 'sto';
        $data['point'] = new Point($data['lat'], $data['lng'], 4326);
        return Location::create($data);
    }
    public function saveConnection(Request $request){
        $conn = Connection::create($request->all());
        return Connection::with(['from', 'to'])->findOrFail($conn->id);
    }

    public function cable()
    {
        $this->data['witels'] = Witel::all();
        $this->data['fos'] = Fo::all();
        return $this->render('cable');
    }

}