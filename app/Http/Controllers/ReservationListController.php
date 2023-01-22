<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class ReservationListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            //Return view with reservations
            return view('pages.reservation-list', [
                'reservations' => DB::table('reservations')->simplePaginate(7),
            ]);
        } catch (\Throwable $th) {
            toastr('¡Hubo algun error con la base de datos!', 'error');
            return redirect('/');
        }
    }

    public function SearchData(Request $request)
    {
        try {
            //validating the required format
            $request->validate([
                'searchDate' => 'required|date_format:Y-m-d',
            ]);
            //changing to the required format
            $date_to_search = date('Y-m-d', strtotime($request->searchDate));
            
            //returning all the dates with the parameter
            return view('pages.reservation-list', [
                'reservations' => DB::table('reservations')
                    ->where('res_date', 'like', '%' . $date_to_search . '%')->get(),
            ]);
        } catch (\Throwable $th) {
            toastr('¡Hubo un error interno al buscar!', 'error');
            return redirect('reservation-list');
        }
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            //validating if the reservation exist
            $reser_ = Reservation::findOrFail($id);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // error_log($id);
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

            //checking if there is two hours left for the date
            if ($current_time > $check_date) {
                toastr('¡No se puede actualizar los datos con menos de dos horas para la cita!', 'warning');
                return redirect('reservation-list');
            }

            //User changed reservation date?
            if ($current_date_time != $request_date_time) {
                //check if there is a reservation with that date
                if ($this->checkAppointmentDate($request->updateReservationDate) == false) {
                    toastr('¡Hora no disponible, por favor ingrese otra fecha para la cita!', 'warning');
                    return redirect('reservation-list');
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
            return redirect('reservation-list');
        } catch (\Throwable $th) {
            toastr('¡Hubo un error interno al actualizar!', 'error');
            return redirect('reservation-list');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            //searching for reservation on DB
            $query = Reservation::find($id);
            $query->delete();
            toastr('¡Cita eliminada con exito!');
            return redirect('reservation-list');
        } catch (\Throwable $th) {
            toastr('¡Hubo un error interno al eliminar!', 'error');
            return redirect('reservation-list');
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
