<?php

namespace App\Http\Controllers;

use App\companies;
use App\movements;
use App\Products;
use App\supervisors;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class MovementsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$movements = movements::all();
        $movements = movements::
              join('companies', 'movements.companies_id', '=', 'companies.id')
            ->join('supervisors', 'movements.supervisor_id', '=', 'supervisors.id')
            ->join('products', 'movements.product_id', '=', 'products.id')
            ->select('movements.*', 'supervisors.name as supervisor_name', 'companies.name as company_name', 'products.name as product_name' )
            ->get();
        //dd($movements);
        return view('movements/index', compact('movements'));
    }

    
    
    /**
     * Generate a movements.
     *
     * @return \Illuminate\Http\Response
     */
    protected function query_reports(Request $request)
    {
     
         $q= movements::
         select('movements.id',
         'movements.entry_date',
         'movements.entry_quantity',
         'movements.entry_unit',
         'movements.invoice_number',
         'movements.provider_name',
         'movements.permission_number',
         'movements.exit_date',
         'movements.exit_quantity',
         'movements.exit_unit',
         'movements.observations',
         'movements.balance',
         'supervisors.name as supervisor_name', 
         'supervisors.signature as supervisor_signature', 
         'companies.name as company_name',
         'products.name as product_name',
         'products.alias as product_alias',
         'products.brand as product_brand',
         'products.provider as product_provider' )
        ->join('companies', 'movements.companies_id', '=', 'companies.id')
        ->join('products', 'movements.product_id', '=', 'products.id')
        ->join('supervisors', 'movements.supervisor_id', '=', 'supervisors.id')
        ;//->get();
        if($request->get('companies_id')){
           $q = $q->where('movements.companies_id',$request->get('companies_id'));
           
        }
        if($request->get('supervisor_id')){
            $q = $q->where('movements.supervisor_id',$request->get('supervisor_id'));
        }
        if($request->get('product_id')){
            $q = $q->where('movements.product_id',$request->get('product_id'));
        }
        if($request->get('entrydate')){
            $range=explode("-",$request->get('entrydate'));
           
            if(count($range)==2){
                $start = date_format(date_create(trim(str_replace("/","-",trim($range[0])))),"Y-m-d");
                $end = date_format(date_create(trim(str_replace("/","-",trim($range[1])))),"Y-m-d");
                $q = $q->whereBetween('movements.entry_date',[$start, $end]);
            }
        }
        if($request->get('exitdate')){
            
            $range=explode("-",$request->get('exitdate'));
            if(count($range)==2){
                $start = date_format(date_create(trim(str_replace("/","-",trim($range[0])))),"Y-m-d");
                $end = date_format(date_create(trim(str_replace("/","-",trim($range[1])))),"Y-m-d");
                $q = $q->whereBetween('movements.exit_date',[$start, $end]);
            }
        }
        
        
        $movements = $q->get();

        return $movements;

        

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function reports(Request $request)
    {
        
        $supervisor = null;
        if($request->get('companies_id')){
            $company = companies::find($request->get('companies_id'));            
        }
        if($request->get('product_id')){
            $product = Products::find($request->get('product_id'));
        }
        if($request->get('supervisor_id')){
            $supervisor = supervisors::find($request->get('supervisor_id'));
            if($supervisor){
                $data = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $supervisor->signature));
                $destinationPath = public_path().'/images/signature'.$supervisor->id.'.png';
                $success = file_put_contents($destinationPath, $data);
                $supervisor->image_path = $destinationPath;
            }
        }
        if($request->get('companies_id')&&$request->get('product_id'))
            $movements =$this->query_reports($request);
        else
            $movements = null;

        if ($request->input('action')==="download") {
            

            //return view('movements.download', compact('movements','company','supervisor','product'));

            return Excel::download(new class($movements,$company,$supervisor,$product) implements FromView, ShouldAutoSize{
                public function __construct($movements,$company,$supervisor,$product)
                {
                    $this->movements = $movements;
                    $this->company = $company;
                    $this->supervisor = $supervisor;
                    $this->product = $product;
                }
                
                public function view() : View
                {
                    $movements = $this->movements;
                    $company = $this->company;
                    $supervisor = $this->supervisor;
                    
                    
                    $product = $this->product;
                    return view('movements.download', compact('movements','company','supervisor','product'));
                }
            },"report.xlsx"); 
        }
      
        $company = companies::pluck('name', 'id');
        $product = Products::pluck('name', 'id');
        $supervisor = supervisors::pluck('name', 'id');
        return view('movements.reports', compact('movements','company','supervisor','product'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $company = companies::pluck('name', 'id');
        $supervisor = supervisors::pluck('name', 'id');
        $product = Products::pluck('name', 'id');
        return view('movements.create',compact('company','supervisor','product'));
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
            'companies_id'=>'required',
            'product_id'=>'required',
            //'entry_date'=>'required',
            //'entry_quantity'=>'required',
            //'entry_unit'=>'required',
            //'invoice_number'=>'required',
            //'provider_name'=>'required',
            //'permission_number'=>'required',
            //'exit_date'=>'required',
            //'exit_quantity'=>'required',
            //'exit_unit'=>'required',
            'supervisor_id'=>'required'
        ]);

        $movements = new movements([
            'companies_id' => $request->get('companies_id'),
            'product_id' => $request->get('product_id'),
            'entry_date' => $request->get('entrydate'),
            'entry_quantity' => $request->get('entry_quantity'),
            'entry_unit' => $request->get('entry_unit'),
            'invoice_number' => $request->get('invoice_number'),
            'provider_name' => $request->get('provider_name'),
            'permission_number' => $request->get('permission_number'),
            'exit_date' => $request->get('exitdate'),
            'exit_quantity' => $request->get('exit_quantity'),
            'exit_unit' => $request->get('exit_unit'),
            'observations' => $request->get('observations'),
            'supervisor_id' => $request->get('supervisor_id'),
            'balance' => $request->get('balance')
        ]);

        if($movements->entry_date !=="")
            $movements->entry_date = date_format(date_create($movements->entry_date),"Y-m-d");
        if($movements->exit_date !=="")
            $movements->exit_date = date_format(date_create($movements->exit_date),"Y-m-d");
            
        //dd($movements);
        $movements->save();
        return redirect('/movements/index')->with('success', '');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\movements  $movements
     * @return \Illuminate\Http\Response
     */
    public function show(movements $movements)
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
        //$movements = movements::find($id);
        $company = companies::pluck('name', 'id');
        $supervisor = supervisors::pluck('name', 'id');
        $product = Products::pluck('name', 'id');
        $movements = movements::
          join('companies', 'movements.companies_id', '=', 'companies.id')
        ->join('supervisors', 'movements.supervisor_id', '=', 'supervisors.id')
        ->join('products', 'movements.product_id', '=', 'products.id')
        ->select('movements.*', 'supervisors.name as supervisor_name', 'companies.name as company_name' , 'products.name as product_name' )
        ->where('movements.id',$id)
        ->first();
        //dd($movements);
        return view('movements.edit', compact('movements','company','supervisor','product')); 
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
            'companies_id'=>'required',
            'product_id'=>'required',
         /*   'entrydate'=>'required',
            'entry_quantity'=>'required',
            'entry_unit'=>'required',
             'invoice_number'=>'required',
            'provider_name'=>'required',
            'permission_number'=>'required',
            'exitdate'=>'required',
            'exit_quantity'=>'required',
            'exit_unit'=>'required',
            'observations'=>'required', */
            'supervisor_id'=>'required'
        ]);

        $movements = movements::find($id);
        $movements->id =  $id;
        $movements->companies_id =  $request->get('companies_id');
        $movements->product_id =  $request->get('product_id');
        $movements->entry_date = $request->get('entrydate');
        $movements->entry_quantity = $request->get('entry_quantity');
        $movements->entry_unit = $request->get('entry_unit');
        $movements->invoice_number = $request->get('invoice_number');
        $movements->provider_name = $request->get('provider_name');
        $movements->permission_number = $request->get('permission_number');
        $movements->exit_date = $request->get('exitdate');
        $movements->exit_quantity = $request->get('exit_quantity');
        $movements->exit_unit = $request->get('exit_unit');
        $movements->observations = $request->get('observations');
        $movements->supervisor_id = $request->get('supervisor_id');
        $movements->balance = $request->get('balance');
          
        if($movements->entry_date !=="")
            $movements->entry_date = date_format(date_create($movements->entry_date),"Y-m-d");
        if($movements->exit_date !=="")
            $movements->exit_date = date_format(date_create($movements->exit_date),"Y-m-d");

        $movements->save();

        return redirect('/movements/index')->with('success', '');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $movements = movements::find($id);
        $movements->delete();

        return redirect('/movements/index')->with('success', '');
    }
}
