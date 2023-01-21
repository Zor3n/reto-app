<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FormReservationController extends Controller
{
    public function GetIndex()
    {
        return view('pages.form-res');
    }
}
