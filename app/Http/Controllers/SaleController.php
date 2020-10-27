<?php

namespace App\Http\Controllers;


use App\User;
use App\Batch;
use App\Client;
use App\Seller;
use App\DetailSaleProduct;


use App\Catalogue;
use App\Sale;

use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use App\Http\Requests\SaleRequest;
use Validator;

class SaleController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:sale')->only('sale'); 
    }
    public function index()
    {
        $isUser = auth()->user()->can(['sale.destroy']);
        //Variable para la visiblidad
        $visibility = "";
        if (!$isUser) {$visibility="disabled";}
        
        return datatables()->of(Sale::all()->where('state','!=','ELIMINADO'))
        ->addColumn('user_name', function ($item) {
            $user_name = User::find($item->user_id);
            return  $user_name->name;
        })
        ->addColumn('client_name', function ($item) {
            $client_name = Client::find($item->client_id);
            return  $client_name->name;
        })
        ->addColumn('seller_name', function ($item) {
            $seller_name = Seller::find($item->seller_id);
            return  $seller_name->name;
        })
        ->addColumn('payment_status', function ($item) {
            $payment_status = Catalogue::find($item->payment_status_id);
            return  $payment_status->name;
        })
        ->addColumn('Detalles', function ($item) {
            return '<a class="btn btn-xs btn-info text-white" onclick="Detail('.$item->id.')"><i class="icon-list-bullet"></i></a>';
        })
        ->addColumn('NotaVenta', function ($item) {
            return '<a class="btn btn-xs btn-info text-white" onclick="SaleNote(\''.$item->id.'\')"><i class="icon-doc-text"></i></a>';
        })
        ->addColumn('Eliminar', function ($item)  use ($visibility){
            $item->v=$visibility;
            return '<a class="btn btn-xs btn-danger text-white '.$item->v.'" onclick="Delete('.$item->id.')"><i class="icon-trash"></i></a>';
        })
        ->rawColumns(['Detalles','NotaVenta','Eliminar'])            
        ->toJson();

        
    }
    public function store(Request $request)
    {
        $rule = new SaleRequest();        
        $validator = Validator::make($request->all(), $rule->rules());
        if ($validator->fails())
        {
            return response()->json(['success'=>false,'msg'=>$validator->errors()->all()]);
        } 
        else{
            $Sale = Sale::create($request->all());
            return response()->json(['success'=>true,'msg'=>'Registro existoso.','sale_id'=>$Sale->id]);
        }
    }
    public function show(Request $request)
    {
        //return $Details = DetailSaleProduct::where('sale_id',5)->get();

        $Sale = Sale::where('id',$request->id)->with('client','payment_status','seller','details')->get();
        return $Sale;
        //$Details = DetailSaleProduct::where('sale_id',$Sale[0]->id)->with('batch')->get();
        //return $Sale->details=$Details;
        ///return $Sale;
        /*
        $Detail = DetailSaleProduct::where('id',$request->id)->get();

        $Sale = Sale::where('id',$Detail->sale_id)->with('client','payment_status','seller')->get();
        $Detail->Sale = $Sale;

        $Batch = Batch::where('id',$Detail->batch_id)->with('product','user','provider','line','storage','industry','payment_status','payment_type')->get();
        $Detail->Batch = $Batch;*/

    }
    public function update(Request $request)
    {
        $rule = new SaleRequest();        
        $validator = Validator::make($request->all(), $rule->rules());
        if ($validator->fails())
        {
            return response()->json(['success'=>false,'msg'=>$validator->errors()->all()]);
        } 
        else{
            $Sale = Sale::find($request->id);
            $Sale->update($request->all());
            return response()->json(['success'=>true,'msg'=>'Se actualizo existosamente.']);
        }
    }
    public function destroy(Request $request)
    {
        $Sale = Sale::find($request->id);
        $DetailsOfSale = DetailSaleProduct::all()->where('sale_id',$request->id);
        foreach ($DetailsOfSale as $Detail) {
            $Detail->state = "ELIMINADO";
            $Detail->update();
            $Batch = Batch::find($Detail->batch_id);
            $Batch->stock = $Batch->stock + $Detail->amount;
            $Batch->update();
        }
        $Sale->state = "ELIMINADO";
        $Sale->update();
        return response()->json(['success'=>true,'msg'=>'Registro borrado.']);
    }
    public function sale()
    {
        return view('manage_sales.sale');
    }
}
