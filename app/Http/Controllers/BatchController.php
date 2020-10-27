<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Catalogue;
use App\Product;
use App\Client;
use App\Provider;
use App\User;
use App\Batch;
use Yajra\DataTables\DataTables;
use App\Http\Requests\BatchRequest;
use Validator;

class BatchController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:batch')->only('batch'); 
    }
    
    public function index()
    {
        $isUser = auth()->user()->can(['batch.edit', 'batch.destroy']);
        //Variable para la visiblidad
        $visibility = "";
        if (!$isUser) {$visibility="disabled";}
    
        return datatables()->of(Batch::all()->where('state','!=','ELIMINADO'))
        ->addColumn('product_name', function ($item) {
            $product_name = Product::find($item->product_id);
            return  $product_name->name;
        })
        ->addColumn('Detalle', function ($item) {
            return '<a class="btn btn-xs btn-info text-white" onclick="Detail('.$item->id.')"><i class="icon-list-bullet"></i></a>';
        })
        //use para usar varible externa
        ->addColumn('Editar', function ($item) use ($visibility) {
            $item->v=$visibility;
        return '<a class="btn btn-xs btn-primary text-white '.$item->v.'" onclick="Edit('.$item->id.')" ><i class="icon-pencil"></i></a>';
        })
        ->addColumn('Eliminar', function ($item) {
        return '<a class="btn btn-xs btn-danger text-white '.$item->v.'" onclick="Delete(\''.$item->id.'\')"><i class="icon-trash"></i></a>';
        })
        ->rawColumns(['Detalle','Editar','Eliminar'])            
        ->toJson();    
    }
    public function store(Request $request)
    {   
        $rule = new BatchRequest();        
        $validator = Validator::make($request->all(), $rule->rules());
        if ($validator->fails())
        {
            return response()->json(['success'=>false,'msg'=>$validator->errors()->all()]);
        } 
        else{
            Batch::create($request->all());
            return response()->json(['success'=>true,'msg'=>'Registro existoso.']);
        }
    }
    public function show(Request $request)
    {
        $Batch = Batch::where('id',$request->id)->with('product','user','provider','line','storage','industry','payment_status','payment_type')->get();
        return $Batch;
    }

    public function edit(Request $request)
    {
        $Batch = Batch::find($request->id);
        return $Batch->toJson();
    }

    public function update(BatchRequest $request)
    {
        $rule = new BatchRequest();        
        $validator = Validator::make($request->all(), $rule->rules());
        if ($validator->fails())
        {
            return response()->json(['success'=>false,'msg'=>$validator->errors()->all()]);
        } 
        else{
            $Batch = Batch::find($request->id);
            $Batch->update($request->all());
            return response()->json(['success'=>true,'msg'=>'Registro actualizado existosamente.']);
        }
    }
    public function destroy(Request $request)
    {
        $Batch = Batch::find($request->id);
        $Batch->state = "ELIMINADO";
        $Batch->update();
        return response()->json(['success'=>true,'msg'=>'Registro borrado.']);
    }
    public function batch()
    {
        return view('manage_inventory.batch');
    }
}
