<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// importados
use App\TypeCatalogue;
use App\Catalogue;
use App\User;
use Yajra\DataTables\DataTables;
use App\Http\Requests\CatalogueRequest;
use Validator;

use Caffeinated\Shinobi\Middleware\UserHasRole;

class CatalogueController extends Controller
{
    public function __construct()
    {

        $this->middleware('permission:industry')->only('industry');
        $this->middleware('permission:line')->only('line');
        $this->middleware('permission:deposit')->only('deposit');
        $this->middleware('permission:zone')->only('zone');   
        
    }
    public function index(Request $request)
    {
        //Evaluar los permisos para la visibilidad
        $isUser = auth()->user()->can(['catalogs.edit', 'catalogs.destroy']);
        //Variable para la visiblidad
        $visibility = "";
        if (!$isUser) {$visibility="disabled";}

        return datatables()->of(Catalogue::all()->where('type_catalog_id', $request->type_catalog_id)->where('state','!=','ELIMINADO'))
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
        $rule = new CatalogueRequest();        
        $validator = Validator::make($request->all(), $rule->rules());
        if ($validator->fails())
        {
            return response()->json(['success'=>false,'msg'=>$validator->errors()->all()]);
        } 
        else{
            Catalogue::create($request->all());
            return response()->json(['success'=>true,'msg'=>'Registro existoso.']);
        }
    }
    public function show($id)
    {
        $Catalogue = Catalogue::find($id);
        return $Catalogue->toJson();
    }
    public function edit(Request $request)
    {
       $Catalogue = Catalogue::find($request->id);
        return $Catalogue->toJson();
    }
    public function update(Request $request)
    {
        $rule = new CatalogueRequest();        
        $validator = Validator::make($request->all(), $rule->rules());
        if ($validator->fails())
        {
            return response()->json(['success'=>false,'msg'=>$validator->errors()->all()]);
        } 
        else{
            $Catalogue = Catalogue::find($request->id);
            $Catalogue->update($request->all());
            return response()->json(['success'=>true,'msg'=>'Registro actualizado existosamente.']);
        }
    }

    public function destroy(Request $request)
    {
        $Catalogue = Catalogue::find($request->id);
        $Catalogue->state = "ELIMINADO";
        $Catalogue->update();
        return response()->json(['success'=>true,'msg'=>'Registro borrado.']);
    }

    // Return Views
    public function line() // linea
    {
        return view('catalogs.line');
    }
    public function deposit() // almacen
    {
        return view('catalogs.deposit');
    }
    public function zone() // departamento
    {
        return view('catalogs.zone');
    }
    public function industry() // industrias
    {
        return view('catalogs.industry');
    }
    // lista los catalogos depende del id que pase
    public function list(Request $request)
    {
        switch ($request->by)
        {
            case 'type_catalog_id':
                $list=Catalogue::All()
                ->where('type_catalog_id',$request->type_catalog_id)
                ->where('state','ACTIVO');
                return $list;
            break;
            case 'all':
                $list=Catalogue::All()->where('state','ACTIVO');
                return $list;
            break;         
            default:
            break;
        }
    }

}
