<?php

namespace Solsticio\Http\Controllers;

use Solsticio\Parking;
use Illuminate\Http\Request;

class ParkingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $parkings = Parking::orderBy('id', 'DESC')->where('status', 'PENDING')->paginate(25);
        return $parkings;
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
            'fecha'=> 'required',
            'deudas'=> 'required',
            'discapacidad'=> 'required',
            'asignado'=> 'required',
            'tipo'=> 'required',
            'numero'=> 'nullable',

            'nombre_propietario'=> 'required',
            'telefono_propietario'=> 'required',
            'direccion_propietario'=> 'required',
            'email_propietario'=> 'required',

            'nombre_residente'=> 'required',
            'telefono_residente'=> 'required',
            'direccion_residente'=> 'required',
            'email_residente'=> 'required',
            'torre'=> 'required',
            'apartamento'=> 'required',

            'cedula'=> 'required',
            'tarjeta_propiedad'=> 'required',
            'soat'=> 'required',
            'autorizacion'=> 'nullable',

            'placa1'=> 'required',
            'color1'=> 'required',
            'clase1'=> 'required',
            'marca1'=> 'required',
            'modelo1'=> 'required',

            'placa2'=> 'nullable',
            'color2'=> 'nullable',
            'clase2'=> 'nullable',
            'marca2'=> 'nullable',
            'modelo2'=> 'nullable',

            'placa3'=> 'nullable',
            'color3'=> 'nullable',
            'clase3'=> 'nullable',
            'marca3'=> 'nullable',
            'modelo3'=> 'nullable',

            'diligenciador'=> 'required',
            'documento'=> 'required'
        ]);

        //Cedula
        $exploded_cedula = explode(',', $request->cedula);
        $decoded_cedula = base64_decode($exploded_cedula[1]);

        if(str_contains($exploded_cedula[0], 'pdf')) {
            $extension_cedula = 'pdf';
        } else {
            $extension_cedula = 'png';
        }

        $fileName_cedula = str_random().'.'.$extension_cedula;

        $path_cedula = public_path().'/files'.'/'.$fileName_cedula;

        file_put_contents($path_cedula, $decoded_cedula);

        //tarjeta_propiedad
        $exploded_tarjeta = explode(',', $request->tarjeta_propiedad);
        $decoded_tarjeta = base64_decode($exploded_tarjeta[1]);

        if(str_contains($exploded_tarjeta[0], 'pdf')) {
            $extension_tarjeta = 'pdf';
        } else {
            $extension_tarjeta = 'png';
        }

        $fileName_tarjeta = str_random().'.'.$extension_tarjeta;

        $path_tarjeta = public_path().'/files'.'/'.$fileName_tarjeta;

        file_put_contents($path_tarjeta, $decoded_tarjeta);

        //soat
        $exploded_soat = explode(',', $request->soat);
        $decoded_soat = base64_decode($exploded_soat[1]);

        if(str_contains($exploded_soat[0], 'pdf')) {
            $extension_soat = 'pdf';
        } else {
            $extension_soat = 'png';
        }

        $fileName_soat = str_random().'.'.$extension_soat;

        $path_soat = public_path().'/files'.'/'.$fileName_soat;

        file_put_contents($path_soat, $decoded_soat);

        if($request->autorizacion != '') {
            $exploded_autorizacion = explode(',', $request->autorizacion);
            $decoded_autorizacion = base64_decode($exploded_autorizacion[1]);

            if(str_contains($exploded_autorizacion[0], 'pdf')) {
                $extension_autorizacion = 'pdf';
            } else {
                $extension_autorizacion = 'png';
            }

            $fileName_autorizacion = str_random().'.'.$extension_autorizacion;

            $path_autorizacion = public_path().'/files'.'/'.$fileName_autorizacion;

            file_put_contents($path_autorizacion, $decoded_autorizacion);
            
            Parking::create($request->except(['cedula','tarjeta_propiedad','soat', 'autorizacion']) + [
                'cedula' => 'files/'.$fileName_cedula,
                'tarjeta_propiedad' => 'files/'.$fileName_tarjeta,
                'soat' => 'files/'.$fileName_soat,
                'autorizacion' => 'files/'.$fileName_autorizacion,
            ]);
        } else {
            Parking::create($request->except(['cedula','tarjeta_propiedad','soat']) + [
                'cedula' => 'files/'.$fileName_cedula,
                'tarjeta_propiedad' => 'files/'.$fileName_tarjeta,
                'soat' => 'files/'.$fileName_soat,
            ]);
        }


        return;
    }

    /**
     * Display the specified resource.
     *
     * @param  \Solsticio\Parking  $parking
     * @return \Illuminate\Http\Response
     */
    public function show(Parking $parking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Solsticio\Parking  $parking
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Parking $parking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Solsticio\Parking  $parking
     * @return \Illuminate\Http\Response
     */
    public function destroy(Parking $parking)
    {
        //
    }
}
