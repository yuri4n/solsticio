<?php

namespace Solsticio\Http\Controllers;

use Solsticio\Classified;
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required',
            'category_id' => 'required',
            'title' => 'required',
            'slug' => 'required',
            'excerpt' => 'required',
            'body' => 'required',
            'file' => 'nullable',
        ]);

        if($request->file != '') {
            $exploded = explode(',', $request->file);
            $decoded = base64_decode($exploded[1]);

            if(str_contains($exploded[0], 'jpeg')) {
                $extension = 'jpg';
            } else {
                $extension = 'png';
            }

            $fileName = str_random().'.'.$extension;

            $path = public_path().'/files'.'/'.$fileName;

            file_put_contents($path, $decoded);

            Classified::create($request->except('file') + [
                'file' => 'files/'.$fileName,
            ]);
        } else {
            Classified::create($request->except('file'));
        }

        return;
    }

    /**
     * Display the specified resource.
     *
     * @param  \Solsticio\Classified  $classified
     * @return \Illuminate\Http\Response
     */
    public function show($classified)
    {
        $response = Classified::where('slug', $classified)->firstOrFail();
        return $response;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Solsticio\Classified  $classified
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
     * @param  \Solsticio\Classified  $classified
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
     * @param  \Solsticio\Classified  $classified
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
