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
// use App\Models\User;

class Controller extends BaseView
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index()
    {
        $this->data['witels'] = Witel::all();
        $this->data['locations'] = Location::all();
        $this->data['connections'] = Connection::all();
        $this->data['fos'] = Fo::all();
        return $this->render('index');
    }

    public function cable()
    {
        $this->data['witels'] = Witel::all();
        $this->data['fos'] = Fo::all();
        return $this->render('cable');
    }

}