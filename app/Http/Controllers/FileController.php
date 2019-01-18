<?php

namespace App\Http\Controllers;

use App\File;
use Illuminate\Http\Request;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $files = File::orderBy('id', 'DESC')->paginate(15);
        return $files;
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
            'description' => 'required',
            'file' => 'required',
        ]);

        $exploded = explode(',', $request->file);
        $decoded = base64_decode($exploded[1]);

        if(str_contains($exploded[0], 'pdf')) {
            $extension = 'pdf';
        } else if(str_contains($exploded[0], 'docx')) {
            $extension = 'docx';
        } else if(str_contains($exploded[0], 'xls')) {
            $extension = 'xls';
        }

        $fileName = str_random().'.'.$extension;

        $path = public_path().'/files'.'/'.$fileName;

        file_put_contents($path, $decoded);

        File::create($request->except('file') + [
            'file' => $fileName,
        ]);

        return;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\File  $file
     * @return \Illuminate\Http\Response
     */
    public function show(File $file)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\File  $file
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'description' => 'required',
            'file' => 'nullable',
        ]);

        if($request->file != '') {
            $exploded = explode(',', $request->file);
            $decoded = base64_decode($exploded[1]);

            if(str_contains($exploded[0], 'pdf')) {
                $extension = 'pdf';
            } else if(str_contains($exploded[0], 'docx')) {
                $extension = 'docx';
            } else if(str_contains($exploded[0], 'xls')) {
                $extension = 'xls';
            }

            $fileName = str_random().'.'.$extension;

            $path = public_path().'/files'.'/'.$fileName;

            file_put_contents($path, $decoded);

            File::find($id)->update($request->except('file') + [
                'file' => $fileName,
            ]);
        } else {
            File::find($id)->update($request->except('file'));
        }

        return;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\File  $file
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $file = File::find($id);
        if ($file) {
            $file->delete();
        }
    }
}
