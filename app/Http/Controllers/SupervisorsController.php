<?php

namespace App\Http\Controllers;

use App\supervisors;
use Illuminate\Http\Request;

class SupervisorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $supervisors = supervisors::all();

        return view('supervisors.index', compact('supervisors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('supervisors.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'identification'=>'required',
            'file'=> 'max:2048'
        ]);

        $image="";
        if ($request->hasFile('file')) {
            $image=file_get_contents($request->file->getRealPath());

            if($image !== "" ){
                $image = "data:image/".$request->file->getClientOriginalExtension().";base64,".base64_encode($image);
            }
        }

        $supervisors = new supervisors([
            'name' => $request->get('name'),
            'identification' => $request->get('identification'),
            'signature' => $image
        ]);
        $supervisors->save();
        return redirect('/supervisors')->with('success', '');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\supervisors  $supervisors
     * @return \Illuminate\Http\Response
     */
    public function show(supervisors $supervisors)
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
        $supervisors = supervisors::find($id);
        return view('supervisors.edit', compact('supervisors')); 
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
        $request->validate([
            'name'=>'required',
            'identification'=>'required',
            'file'=> 'max:2048'
            ]);

        $supervisors = supervisors::find($id);
        $supervisors->id =  $id;
        $supervisors->name =  $request->get('name');
        $supervisors->identification = $request->get('identification');

        if ($request->hasFile('file')) {
            $image=file_get_contents($request->file->getRealPath());

            if($image !== "" ){
                $image = "data:image/".$request->file->getClientOriginalExtension().";base64,".base64_encode($image);
                $supervisors->signature =  $image;
            }
        }

        $supervisors->save();

        return redirect('/supervisors')->with('success', '');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $supervisors = supervisors::find($id);
        $supervisors->delete();

        return redirect('/supervisors')->with('success', '');
    }
}
