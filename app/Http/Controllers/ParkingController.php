<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;
use App\Mail\ParkingMail;
use App\Parking;
use App\User;

class ParkingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $parkings = Parking::orderBy('id', 'DESC')->where('status', 'PENDING')->paginate(25);
        return $parkings;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function approved()
    {
        $parkings = Parking::orderBy('id', 'DESC')->where('status', 'APPROVED')->paginate(25);
        return $parkings;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required',
            'fecha' => 'required',
            'deudas' => 'required',
            'discapacidad' => 'required',
            'asignado' => 'nullable',
            'tipo' => 'required',
            'numero' => 'nullable',

            'nombre_propietario' => 'required',
            'telefono_propietario' => 'required',
            'direccion_propietario' => 'required',
            'email_propietario' => 'required',

            'nombre_residente' => 'required',
            'telefono_residente' => 'required',
            'direccion_residente' => 'required',
            'email_residente' => 'required',
            'torre' => 'required',
            'apartamento' => 'required',

            'cedula' => 'required',
            'tarjeta_propiedad' => 'required',
            'soat' => 'required',
            'autorizacion' => 'nullable',

            'placa1' => 'required',
            'color1' => 'required',
            'clase1' => 'required',
            'marca1' => 'required',
            'modelo1' => 'required',

            'placa2' => 'nullable',
            'color2' => 'nullable',
            'clase2' => 'nullable',
            'marca2' => 'nullable',
            'modelo2' => 'nullable',

            'placa3' => 'nullable',
            'color3' => 'nullable',
            'clase3' => 'nullable',
            'marca3' => 'nullable',
            'modelo3' => 'nullable',

            'diligenciador' => 'required',
            'documento' => 'required'
        ]);

        // CEDULA
        $exploded_cedula = explode(',', $request->cedula);
        $decoded_cedula = base64_decode($exploded_cedula[1]);

        if (str_contains($exploded_cedula[0], 'pdf')) {
            $extension_cedula = 'pdf';
        } elseif (str_contains($exploded_cedula[0], 'png')) {
            $extension_cedula = 'png';
        } elseif (str_contains($exploded_cedula[0], 'jpg')) {
            $extension_cedula = 'jpg';
        }

        $fileName_cedula = str_random() . '.' . $extension_cedula;

        $path_cedula = public_path() . '/files' . '/' . $fileName_cedula;

        file_put_contents($path_cedula, $fileName_cedula);

        // TARJETA DE PROPIEDAD
        $exploded_tarjeta = explode(',', $request->tarjeta_propiedad);
        $decoded_tarjeta = base64_decode($exploded_tarjeta[1]);

        if (str_contains($exploded_tarjeta[0], 'pdf')) {
            $extension_tarjeta = 'pdf';
        } elseif (str_contains($exploded_tarjeta[0], 'png')) {
            $extension_tarjeta = 'png';
        } elseif (str_contains($exploded_tarjeta[0], 'jpg')) {
            $extension_tarjeta = 'jpg';
        }

        $fileName_tarjeta = str_random() . '.' . $extension_tarjeta;

        $path_tarjeta = public_path() . '/files' . '/' . $fileName_tarjeta;

        file_put_contents($path_tarjeta, $fileName_tarjeta);

        // SOAT
        $exploded_soat = explode(',', $request->soat);
        $decoded_soat = base64_decode($exploded_soat[1]);

        if (str_contains($exploded_soat[0], 'pdf')) {
            $extension_soat = 'pdf';
        } elseif (str_contains($exploded_soat[0], 'png')) {
            $extension_soat = 'png';
        } elseif (str_contains($exploded_soat[0], 'jpg')) {
            $extension_soat = 'jpg';
        }

        $fileName_soat = str_random() . '.' . $extension_soat;

        $path_soat = public_path() . '/files' . '/' . $fileName_soat;

        file_put_contents($path_soat, $fileName_soat);

        // AUTORIZACION
        if ($request->autorizacion != '') {
            $exploded_autorizacion = explode(',', $request->autorizacion);
            $decoded_autorizacion = base64_decode($exploded_autorizacion[1]);

            if (str_contains($exploded_autorizacion[0], 'pdf')) {
                $extension_autorizacion = 'pdf';
            } elseif (str_contains($exploded_autorizacion[0], 'png')) {
                $extension_autorizacion = 'png';
            } elseif (str_contains($exploded_autorizacion[0], 'jpg')) {
                $extension_autorizacion = 'jpg';
            }

            $fileName_autorizacion = str_random() . '.' . $extension_autorizacion;

            $path_autorizacion = public_path() . '/files' . '/' . $fileName_autorizacion;

            file_put_contents($path_autorizacion, $fileName_autorizacion);

            Parking::create($request->except(['cedula', 'tarjeta_propiedad', 'soat', 'autorizacion']) + [
                    'cedula' => $fileName_cedula,
                    'tarjeta_propiedad' => $fileName_tarjeta,
                    'soat' => $fileName_soat,
                    'autorizacion' => $fileName_autorizacion,
                ]);
        } else {
            Parking::create($request->except(['cedula', 'tarjeta_propiedad', 'soat']) + [
                    'cedula' => $fileName_cedula,
                    'tarjeta_propiedad' => $fileName_tarjeta,
                    'soat' => $fileName_soat,
                ]);
        }


        return;
    }

    /**
     * Display the specified resource.
     *
     * @param Parking $parking
     * @return Response
     */
    public function show(Parking $parking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Parking $parking
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'status' => 'required',
            'petition' => 'required',
        ]);

        $parking = $request->petition;
        $user = User::find($parking['user_id'])->first();

        $data = array(
            'user' => $user,
            'parking' => $parking,
            'status' => $request->status,
        );

        Parking::find($id)->update(['status' => $request->status]);

        Mail::to($user->email)->send(new ParkingMail($data));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Parking $parking
     * @return Response
     */
    public function destroy($id)
    {
        $parking = Parking::find($id);
        if ($parking) {
            $parking->delete();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Parking $parking
     * @return Response
     */
    public function rejectNotify(Request $request, $id)
    {
        $this->validate($request, [
            'petition' => 'required'
        ]);

        $parking = $request->petition;
        $user = User::find($parking['user_id'])->first();

        $data = array(
            'user' => $user,
            'parking' => $parking,
            'status' => 'REJECTED',
        );

        Mail::to($user->email)->send(new ParkingMail($data));
    }
}
