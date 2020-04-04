<?php

namespace App\Http\Controllers;

use App\companies;
use Illuminate\Http\Request;


class CompaniesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = companies::all();

        return view('companies.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('companies.create');
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
             'file'=> 'max:2048', 
            'address'=>'required',
            'details'=>'required'
        ]);
        $logo ="";
        if ($request->hasFile('file')) {
            $logo = file_get_contents($request->file->getRealPath());

            if($logo !== "" ){
                $logo = "data:image/".$request->file->getClientOriginalExtension().";base64,".base64_encode($logo);
            }
        }
        
        $companies = new companies([
            'name' => $request->get('name'),
            'logo' => $logo,
            'address' => $request->get('address'),
            'details' => $request->get('details')
        ]); 
        $companies->save();
        return redirect('/companies')->with('success', ''); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\companies  $companies
     * @return \Illuminate\Http\Response
     */
    public function show(companies $companies)
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
        $companies = companies::find($id);
        return view('companies.edit', compact('companies')); 
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
            'address'=>'required',
            'details'=>'required',
            'file'=> 'max:2048', 
        ]);

        $companies = companies::find($id);
        $companies->id =  $id;
        $companies->name =  $request->get('name');
        $companies->address = $request->get('address');
        $companies->details = $request->get('details');

        if ($request->hasFile('file')) {
            $logo=file_get_contents($request->file->getRealPath());

            if($logo !== "" ){
                $logo = "data:image/".$request->file->getClientOriginalExtension().";base64,".base64_encode($logo);
                $companies->logo =  $logo;
            }
        }

        $companies->save();

        return redirect('/companies')->with('success', '');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $companies = companies::find($id);
        $companies->delete();

        return redirect('/companies')->with('success', '');
    }
}
