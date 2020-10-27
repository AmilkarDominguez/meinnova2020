<?php

namespace App\Http\Controllers;

use App\Collector;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Requests\CollectorRequest;
use Validator;

class CollectorController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:collector')->only('collector'); 
    }
    public function index()
    {
        $isUser = auth()->user()->can(['collector.edit', 'collector.destroy']);
        //Variable para la visiblidad
        $visibility = "";
        if (!$isUser) {$visibility="disabled";}

        return datatables()->of(Collector::all()->where('state','!=','ELIMINADO'))
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
        $rule = new CollectorRequest();        
        $validator = Validator::make($request->all(), $rule->rules());
        if ($validator->fails())
        {
            return response()->json(['success'=>false,'msg'=>$validator->errors()->all()]);
        } 
        else{
            Collector::create($request->all());
            return response()->json(['success'=>true,'msg'=>'Registro existoso.']);
        }
    }
    public function edit(Request $request)
    {
        $Collector = Collector::find($request->id);
        return $Collector->toJson();
    }
    public function update(Request $request)
    {
        $rule = new CollectorRequest();        
        $validator = Validator::make($request->all(), $rule->rules());
        if ($validator->fails())
        {
            return response()->json(['success'=>false,'msg'=>$validator->errors()->all()]);
        } 
        else{
            $Collector = Collector::find($request->id);
            $Collector->update($request->all());
            return response()->json(['success'=>true,'msg'=>'Se actualizo existosamente.']);
        }
    }
    public function destroy($id)
    {
        $Collector = Collector::find($request->id);
        $Collector->state = "ELIMINADO";
        $Collector->update();
        return response()->json(['success'=>true,'msg'=>'Registro borrado.']);
    }


    public function collector()
    {
        return view('collections.collector');
    }
    public function list(Request $request)
    {
        switch ($request->by)
        {
            case 'all':
                $list=Collector::All()->where('state','ACTIVO');
                return $list;
            break;         
            default:
            break;
        }
    }
}
