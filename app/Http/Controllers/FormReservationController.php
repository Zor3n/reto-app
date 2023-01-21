<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FormReservationController extends Controller
{
    public function GetIndex()
    {
        return view('pages.form-res');
    }

    public function SendForm(Request $request)
    {
        try {
            toastr('Oops! Something went wrong!', 'info');
            return redirect('reservation');
        } catch (\Throwable $th) {
            //throw $th;
            toastr()->error('Oops! Something went wrong!');
            return redirect('reservation');
        }
    }
}
