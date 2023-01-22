<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class CalendarController extends Controller
{
    public function StartCalendar()
    {
        try {
            //Getting all reservation from DB
            $data = DB::table('reservations')
                ->select(['id', 'user_dni', 'name', 'last_name', 'tel_user', 'pet_name', 'res_date', 'status'])
                ->get();

            //Empty array for changing requested data to and array for Full Calendar
            $calendar_data = [];

            foreach ($data as $value) {
                $status_value = $value->status;
                $event_color = 'blue';

                if ($status_value == 0) {
                    $event_color = 'blue';
                } else if ($status_value == 1) {
                    $event_color = 'green';
                } else {
                    $event_color = 'red';
                }


                $object = (object) [
                    'res_id' => $value->id,
                    'title' => 'Cita: #' . $value->user_dni,
                    'owner_dni' => $value->user_dni,
                    'owner_name' => $value->name,
                    'owner_last_name' => $value->last_name,
                    'owner_tel' => $value->tel_user,
                    'pet_name' => $value->pet_name,
                    'start' => date('Y-m-d H:i', strtotime($value->res_date)),
                    'status' => $value->status,
                    'date_app' => date('Y-m-d H:i', strtotime($value->res_date)),
                    'hour' => date('H:i', strtotime($value->res_date)),
                    'color' => $event_color,
                    'url_form' => url('calendar'),
                ];
                array_push($calendar_data, $object);
            }
            return view('pages.calendar')->with('data', $calendar_data);
        } catch (\Throwable $th) {
            toastr('¡Hubo algun error con la base de datos!', 'error');
            return redirect('/');
        }
    }

    public function UpdateReservationFromCalendar(Request $request, $id)
    {
        try {
            //Validates user inputs
            $request->validate([
                'updateUserDNI' => 'required|string|max:10',
                'updateUserName' => 'required|string|max:30',
                'updateUserLastName' => 'required|string|max:30',
                'updateUserCelNumber' => 'required|string|max:30',
                'updateUserPetName' => 'required|string|max:30',
                'updateReservationDate' => 'required|date_format:Y-m-d\TH:i',
                'updateReservationStatus' => ['required', Rule::in(['0', '1', '2'])],
            ]);

            //DB query
            $query = Reservation::find($id);
            $query->user_dni = $request->updateUserDNI;
            $query->name = $request->updateUserName;
            $query->last_name = $request->updateUserLastName;
            $query->tel_user = $request->updateUserCelNumber;
            $query->pet_name = $request->updateUserPetName;

            //Checking datetime
            $current_date_time = strtotime(date($query->res_date)); //get date from data base
            $request_date_time = strtotime(date($request->updateReservationDate)); //get date from request (user input)
            $check_date =  strtotime(date('Y-m-d H:i', strtotime('-2 hour', $current_date_time))); //Two hours left for date time?
            $current_time = strtotime(date('Y-m-d H:i')); //current datetime
            $minimum_margin_time = strtotime(date('Y-m-d H:i', strtotime('+1 day')));


            //checking if there is two hours left for the date
            if ($current_time > $check_date) {
                toastr('¡No se puede actualizar los datos con menos de dos horas para la cita!', 'warning');
                return redirect('calendar');
            }

            //User changed reservation date?
            if ($current_date_time != $request_date_time) {

                if ($request_date_time < $minimum_margin_time) {
                    toastr('¡Por favor, ponga una fecha valida!', 'warning');
                    return redirect('reservation');
                }

                //check if there is a reservation with that date
                if ($this->checkAppointmentDate($request->updateReservationDate) == false) {
                    toastr('¡Hora no disponible, por favor ingrese otra fecha para la cita!', 'warning');
                    return redirect('calendar');
                }
            }

            $query->res_date = $request->updateReservationDate;

            //Check status from input
            if ($request->updateReservationStatus == 0) {
                $query->status = 0;
            } else if ($request->updateReservationStatus == 1) {
                $query->status = 1;
            } else {
                $query->status = 2;
            }

            $query->update();
            toastr('¡Cita actualizada con exito!');
            return redirect('calendar');
        } catch (\Throwable $th) {
            toastr('¡Hubo un error interno al actualizar!', 'error');
            return redirect('calendar');
        }
    }

    private static function checkAppointmentDate($date)
    {
        try {
            //date with format
            $format_date = date('Y-m-d H:i', strtotime($date));
            //searching datetime in DB
            $consulta = Reservation::where('res_date', '=', $format_date);

            //Found something?
            if ($consulta->count() > 0) {
                return false;
            }
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }
}
