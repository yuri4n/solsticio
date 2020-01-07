<?php

namespace Solsticio\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Solsticio\Reservation;
use Solsticio\User;
use Solsticio\Mail\ReservationMail;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reservations = Reservation::orderBy('id', 'DESC')->where('status', 'PENDING')->paginate(25);
        return $reservations;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function approved()
    {
        $reservations = Reservation::orderBy('id', 'DESC')->where('status', 'APPROVED')->paginate(25);
        return $reservations;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required',
            'nombre_responsable' => 'required',
            'type' => 'required',
            'fecha_solicitada' => 'required',
            'additional_info' => 'required',
        ]);

        Reservation::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \Solsticio\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function show($reservation)
    {
        $response = Reservation::where('id', $reservation)->firstOrFail();
        return $response;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Solsticio\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Solsticio\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function updateAndNotify(Request $request, $id)
    {
        $this->validate($request, [
            'status' => 'required',
            'reservation' => 'required',
        ]);

        $reservation = $request->reservation;
        $user = User::find($reservation['user_id'])->first();

        $data = array(
            'user' => $user,
            'reservation' => $reservation,
            'status' => $request->status,
        );

        Reservation::find($id)->update(['status' => $request->status]);

        Mail::to($user->email)->send(new ReservationMail($data));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Solsticio\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function rejectNotify(Request $request, $id)
    {
        $this->validate($request, [
            'reservation' => 'required'
        ]);

        $reservation = $request->reservation;
        $user = User::find($reservation['user_id'])->first();

        $data = array(
            'user' => $user,
            'reservation' => $reservation,
            'status' => 'REJECTED',
        );

        Mail::to($user->email)->send(new ReservationMail($data));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Solsticio\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $reservation = Reservation::find($id);
        if ($reservation) {
            $reservation->delete();
        }
    }
}
