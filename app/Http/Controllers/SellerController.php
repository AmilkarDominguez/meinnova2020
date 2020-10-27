<?php

namespace App\Http\Controllers;

use App\Seller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Requests\SellerRequest;
use Validator;

class SellerController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:seller')->only('seller'); 
    }
    public function index()
    {
        $isUser = auth()->user()->can(['seller.edit', 'seller.destroy']);
        //Variable para la visiblidad
        $visibility = "";
        if (!$isUser) {$visibility="disabled";}

            return datatables()->of(Seller::all()->where('state','!=','ELIMINADO'))
            //use para usar varible externa
            ->addColumn('Editar', function ($item) use ($visibility) {
                $item->v=$visibility;
            return '<a class="btn btn-xs btn-primary text-white '.$item->v.'" onclick="Edit('.$item->id.')" ><i class="icon-pencil"></i></a>';
            })
            ->addColumn('Eliminar', function ($item) {
            return '<a class="btn btn-xs btn-danger text-white '.$item->v.'" onclick="Delete(\''.$item->id.'\')"><i class="icon-trash"></i></a>';
            })
            ->rawColumns(['Editar','Eliminar']) 
                  
            ->toJson();
    }
    public function store(Request $request)
    {  
        $rule = new SellerRequest();        
        $validator = Validator::make($request->all(), $rule->rules());
        if ($validator->fails())
        {
            return response()->json(['success'=>false,'msg'=>$validator->errors()->all()]);
        } 
        else{
            Seller::create($request->all());
            return response()->json(['success'=>true,'msg'=>'Registro existoso.']);
        }
    }
    public function edit(Request $request)
    {
        $Seller = Seller::find($request->id);
        return $Seller->toJson();
    }
    public function update(Request $request)
    {
        $rule = new SellerRequest();        
        $validator = Validator::make($request->all(), $rule->rules());
        if ($validator->fails())
        {
            return response()->json(['success'=>false,'msg'=>$validator->errors()->all()]);
        } 
        else{
            $Seller = Seller::find($request->id);
            $Seller->update($request->all());
            return response()->json(['success'=>true,'msg'=>'Se actualizo existosamente.']);
        }
    }
    public function destroy(Request $request)
    {
        $Seller = Seller::find($request->id);
        $Seller->state = "ELIMINADO";
        $Seller->update();
        return response()->json(['success'=>true,'msg'=>'Registro borrado.']);
    }
    public function list(Request $request)
    {
        switch ($request->by)
        {
            case 'all':
                $list=Seller::All()->where('state','ACTIVO');
                return $list;
            break;         
            default:
            break;
        }
    }
    public function seller()
    {
        return view('manage_sales.seller');
    }
}
