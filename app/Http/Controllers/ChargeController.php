<?php

namespace App\Http\Controllers;
use App\Payment;
use App\User;
use App\Client;
use App\Seller;
use App\Collector;
use App\Catalogue;
use App\Sale;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;


class ChargeController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:charge')->only('charge'); 
    }

    public function index()
    {
        //Evaluar los permisos para la visibilidad
        $isUser = auth()->user()->can(['charge.destroy']);
        //Variable para la visiblidad
        $visibility = "";
        if (!$isUser) {$visibility="disabled";}

        return datatables()->of(Payment::all()->where('state','!=','ELIMINADO'))
        ->addColumn('collector_name', function ($item) {
            $collector_name = Collector::find($item->collector_id);
            return  $collector_name->name;
        })
        ->addColumn('sale_id', function ($item) {
            $sale_id = Sale::find($item->sale_id);
            return  $sale_id->id;
        })
        ->addColumn('Eliminar', function ($item) use ($visibility) {
            $item->v=$visibility;
            return '<a class="btn btn-xs btn-danger text-white circle '.$item->v.'" onclick="Delete('.$item->id.')" ><i class="icon-ok-circled"></i></a>';
        })
        ->rawColumns(['Eliminar'])                     
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
    public function update(Request $request, $id)
    {
        //
    }
    public function destroy(Request $request)
    {
        $Payment = Payment::find($request->id);
        $Sale = Sale::find($Payment->sale_id);
        $Sale->receive =$Sale->receive-$Payment->payment;
        $Sale->update();
        $Payment->state = "ELIMINADO";
        $Payment->update();
        return response()->json(['success'=>true,'msg'=>'Registro borrado.']);
    }
    public function charges()
    {
        return view('collections.charges');
    }
}
