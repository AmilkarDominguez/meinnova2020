<?php

namespace App\Http\Controllers;

use App\User;
use App\Client;
use App\Seller;
use App\DetailSaleProduct;


use App\Catalogue;
use App\Sale;

use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use Validator;

class SaleCompletedController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:salecompleted')->only('salecompleted'); 
    }
    public function index()
    {
        $isUser = auth()->user()->can(['sale.update', 'sale.destroy']);
        //Variable para la visiblidad
        $visibility = "";
        if (!$isUser) {$visibility="disabled";}
        
        return datatables()->of(Sale::all()-> where('payment_status_id',5))
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

        ->addColumn('Concluir', function ($item)  use ($visibility){
            $item->v=$visibility;
            return '<a class="btn btn-xs btn-success text-white '.$item->v.'" onclick="Completed('.$item->id.')"><i class="icon-check"></i></a>';
        })
        ->rawColumns(['Concluir'])            
        ->toJson();
    }

    public function create()
    {
        //
    }
    public function store(Request $request)
    {
        //
    }
    public function show($id)
    {
        //
    }
    public function edit($id)
    {
        //
    }
    public function update(Request $request)
    {
       
    }
    public function destroy(Request $request)
    {
        $Sale = Sale::find($request->id);
        $Sale->payment_status_id = 6;
        $Sale->update();
        return response()->json(['success'=>true,'msg'=>'La venta se concluyó correctamente.']);
    }
    public function salecompleted()
    {
        return view('manage_sales.salecompleted');
    }
}
