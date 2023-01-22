<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CalendarController extends Controller
{
    public function StartCalendar()
    {
        try {
            $data = DB::table('reservations')
                ->select(['user_dni', 'name', 'last_name', 'pet_name', 'res_date', 'status'])
                ->get();
            $calendar_data = [];

            foreach ($data as $value) {
                $object = (object) [
                    'title' => 'Cita: #' . $value->user_dni,
                    'owner_name' => $value->name . ' ' . $value->last_name,
                    'pet_name' => $value->pet_name,
                    'start' => date('Y-m-d H:i', strtotime($value->res_date)),
                    'status' => $value->status,
                    'date_app' => date('Y-m-d', strtotime($value->res_date)),
                    'hour' => date('H:i', strtotime($value->res_date)),
                ];
                array_push($calendar_data, $object);
            }
            return view('pages.calendar')->with('data', $calendar_data);
        } catch (\Throwable $th) {
            toastr('¡Hubo algun error con la base de datos!', 'error');
            return redirect('/');
        }
    }
}
