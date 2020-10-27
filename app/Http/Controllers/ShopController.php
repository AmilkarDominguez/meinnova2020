<?php

namespace App\Http\Controllers;


use App\Catalogue;
use App\Product;
use App\Client;
use App\Provider;
use App\User;
use App\Batch;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use Validator;

class ShopController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:batch')->only('batch'); 
    }

    public function index()
    {
        return datatables()->of(Batch::all()->where('stock','>',0)->where('state','ACTIVO'))
        ->addColumn('product_name', function ($item) {
            $product = Product::find($item->product_id);
            return  $product->name;
        })
        ->addColumn('Detalle', function ($item) {
            return '<a class="btn btn-xs btn-info text-white" onclick="Detail('.$item->id.')"><i class="icon-list-bullet"></i></a>';
        })
        ->addColumn('Shop', function ($item) {
            $product = Product::find($item->product_id);
            return '<a class="btn btn-xs btn-success text-white" onclick="AddBasket('.$item->id.',\''.$product->name.'\',\''.$item->wholesaler_price.'\',\''.$item->stock.'\')"><i class="icon-cart-plus"></i></a>';
        })
        ->rawColumns(['Detalle','Shop'])              
        ->toJson();
    }
    public function dt_clients()
    {
        return datatables()->of(Client::all()->where('state','ACTIVO'))
        ->addColumn('zoneclient', function ($item) {
            $catalog_zone_id = Catalogue::find($item->catalog_zone_id);
            return  $catalog_zone_id->name;
        })
        ->addColumn('SelectClient', function ($item) {
            return '<a class="btn btn-xs btn-success text-white" onclick="SelectClient('.$item->id.',\''.$item->name.'\')"><i class="icon-ok-circled"></i></a>';
        })
        ->rawColumns(['SelectClient'])              
        ->toJson();
    }

    public function detail(Request $request)
    {    
        $Batch = Batch::find($request->id)->with('product','user','provider','line','storage','industry','payment_status','payment_type')->first();
        return $Batch;
        //$Batch = Batch::find($request->id);
        //return $Batch->hasMany('Batch');
        //return $Batch::with('product','user','provider','line','storage','industry','payment_status','payment_type')->get();
        //ESTE PARA VENTAS 
        //Este funciona!
        //return Batch::with('product','user','provider','line','storage','industry','payment_status','payment_type')->get()->where('id',$request->id);
    }
    
    public function shop()
    {
        return view('shop.shop');
    }
}
