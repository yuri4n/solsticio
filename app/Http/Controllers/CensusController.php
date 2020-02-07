<?php

namespace Solsticio\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Maatwebsite\Excel\Facades\Excel;
use Solsticio\Census;
use Solsticio\Exports\CensusExport;
use Solsticio\Exports\CensusPendingExport;

class CensusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $censuses = Census::orderBy('id', 'DESC')->where('status', 'PENDING')->paginate(25);
        return $censuses;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function exported()
    {
        $censuses = Census::orderBy('id', 'DESC')->where('status', 'SAVED')->paginate(25);
        return $censuses;
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
            'torre' => 'required',
            'apartamento' => 'required',
            'telefono_apto' => 'required',
            'tipo' => 'required',
            'nombre_propietario' => 'required',
            'email_propietario' => 'required',
            'telefono_propietario' => 'required',
            'nombre_residente' => 'required',
            'email_residente' => 'required',
            'time_days' => 'required',
            'time_months' => 'required',
            'time_years' => 'required',
            'carro' => 'required',
            'placa_carro' => 'nullable',
            'modelo_carro' => 'nullable',
            'parqueadero_asign_carro' => 'nullable',
            'moto' => 'required',
            'placa_moto' => 'nullable',
            'modelo_moto' => 'nullable',
            'parqueadero_asign_moto' => 'nullable',
            'bicicleta' => 'required',
            'gancho' => 'nullable',

            'residente1' => 'required',
            'discapacitado1' => 'required',
            'edad1' => 'required',
            'parentesco1' => 'required',
            'actividad1' => 'required',
            'celular1' => 'required',

            'residente2' => 'nullable',
            'discapacitado2' => 'nullable',
            'edad2' => 'nullable',
            'parentesco2' => 'nullable',
            'actividad2' => 'nullable',
            'celular2' => 'nullable',

            'residente3' => 'nullable',
            'discapacitado3' => 'nullable',
            'edad3' => 'nullable',
            'parentesco3' => 'nullable',
            'actividad3' => 'nullable',
            'celular3' => 'nullable',

            'residente4' => 'nullable',
            'discapacitado4' => 'nullable',
            'edad4' => 'nullable',
            'parentesco4' => 'nullable',
            'actividad4' => 'nullable',
            'celular4' => 'nullable',

            'residente5' => 'nullable',
            'discapacitado5' => 'nullable',
            'edad5' => 'nullable',
            'parentesco5' => 'nullable',
            'actividad5' => 'nullable',
            'celular5' => 'nullable',

            'residente6' => 'nullable',
            'discapacitado6' => 'nullable',
            'edad6' => 'nullable',
            'parentesco6' => 'nullable',
            'actividad6' => 'nullable',
            'celular6' => 'nullable',

            'residente7' => 'nullable',
            'discapacitado7' => 'nullable',
            'edad7' => 'nullable',
            'parentesco7' => 'nullable',
            'actividad7' => 'nullable',
            'celular7' => 'nullable',

            'residente8' => 'nullable',
            'discapacitado8' => 'nullable',
            'edad8' => 'nullable',
            'parentesco8' => 'nullable',
            'actividad8' => 'nullable',
            'celular8' => 'nullable',

            'residente9' => 'nullable',
            'discapacitado9' => 'nullable',
            'edad9' => 'nullable',
            'parentesco9' => 'nullable',
            'actividad9' => 'nullable',
            'celular9' => 'nullable',

            'residente10' => 'nullable',
            'discapacitado10' => 'nullable',
            'edad10' => 'nullable',
            'parentesco10' => 'nullable',
            'actividad10' => 'nullable',
            'celular10' => 'nullable',

            'internet' => 'required',
            'proveedor' => 'nullable',
            'mascota' => 'required',
            'mascota_raza' => 'nullable',
            'mascota_cantidad' => 'nullable',
            'vacunas' => 'nullable',
            'observaciones' => 'nullable',
            'elaborado' => 'required',
        ]);

        Census::create($request->all());

    }

    /**
     * Display the specified resource.
     *
     * @param Census $census
     * @return Response
     */
    public function show(Census $census)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Census $census
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'status' => 'required',
        ]);

        Census::find($id)->update($request->all());
    }

    public function export()
    {
        return Excel::download(new CensusExport, 'censos.xlsx');
    }

    public function exportPending()
    {
        return Excel::download(new CensusPendingExport('PENDING'), 'censos.xlsx');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Census $census
     * @return Response
     */
    public function destroy($id)
    {
        $census = Census::find($id);
        if ($census) {
            $census->delete();
        }
    }
}
