<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Support\Facades\Validator;
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
            $request->validate([
                'userDNI' => 'required|max:10',
                'userName' => 'required|max:30',
                'userLastName' => 'required|max:30',
                'userCelNumber' => 'required|max:10',
                'userPetName' => 'required|max:30',
                'reservationDate' => 'required|date_format:Y-m-d\TH:i',
            ]);

            $query = new Reservation();
            $query->user_dni = $request->userDNI;
            $query->name = $request->userName;
            $query->last_name = $request->userLastName;
            $query->tel_user = $request->userCelNumber;
            $query->pet_name = $request->userPetName;

            $selected_user_time = strtotime($request->reservationDate);
            $minimum_margin_time = strtotime(date('Y-m-d H:i', strtotime('+1 day')));

            if ($selected_user_time < $minimum_margin_time) {
                toastr('¡Por favor, ponga una fecha valida!', 'warning');
                return redirect('reservation');
            }

            if ($this->checkAppointmentDate($request->reservationDate) == false) {
                toastr('¡Fecha ingresada no disponible!', 'warning');
                return redirect('reservation');
            }

            $query->res_date = $request->reservationDate;
            $query->status = 0;

            $query->save();

            toastr('¡Cita reservada correctamente!');
            return redirect('reservation');
        } catch (\Throwable $th) {
            //throw $th;
            toastr()->error('Oops! Something went wrong!');
            return redirect('reservation');
        }
    }

    private static function checkAppointmentDate($date)
    {
        try {
            $format_date = date('Y-m-d H:i', strtotime($date));
            $consulta = Reservation::where('res_date', '=', $format_date);

            if ($consulta->count() > 0) {
                return false;
            }
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }
}
