<?php

namespace App\Http\Controllers;

use App\Classified;
use Illuminate\Http\Request;

class ClassifiedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classifieds = Classified::orderBy('id', 'DESC')->where('status', 'PUBLISHED')->paginate(16);
        return $classifieds;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function admin()
    {
        $classifieds = Classified::orderBy('id', 'DESC')->where('status', 'PENDING')->paginate(25);
        return $classifieds;
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
     * @param  \App\Classified  $classified
     * @return \Illuminate\Http\Response
     */
    public function show(Classified $classified)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Classified  $classified
     * @return \Illuminate\Http\Response
     */
    public function edit(Classified $classified)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Classified  $classified
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Classified $classified)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Classified  $classified
     * @return \Illuminate\Http\Response
     */
    public function updateStatus(Request $request, $id)
    {
        $this->validate($request, [
            'status' => 'required',
        ]);

        Classified::find($id)->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Classified  $classified
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $classified = Classified::find($id);
        if ($classified) {
            $classified->delete();
        }
    }
}
