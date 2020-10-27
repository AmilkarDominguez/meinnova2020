<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Catalogue;
use App\TypeCatalog;
use App\Product;
use Yajra\DataTables\DataTables;
use App\Http\Requests\ProductRequest;
use Validator;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:product')->only('product'); 
    }
    public function index()
    {
        $isUser = auth()->user()->can(['product.edit', 'product.destroy']);
        //Variable para la visiblidad
        $visibility = "";
        if (!$isUser) {$visibility="disabled";}

            return datatables()->of(Product::all()->where('state','!=','ELIMINADO'))
            ->addColumn('catalog_product_id', function ($item) {
                $catalog_product_id = Catalogue::find($item->catalog_product_id);
                return  $catalog_product_id->name;
            })
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
        $rule = new ProductRequest();        
        $validator = Validator::make($request->all(), $rule->rules());
        if ($validator->fails())
        {
            return response()->json(['success'=>false,'msg'=>$validator->errors()->all()]);
        } 
        else{
            Product::create($request->all());
            return response()->json(['success'=>true,'msg'=>'Registro existoso.']);
        }
    }
    public function show($id)
    {
        $Product = Product::find($id);
        return $Product->toJson();
    }

    public function edit(Request $request)
    {
        $Product = Product::find($request->id);
        return $Product->toJson();
    }
    public function update(Request $request)
    {
        $rule = new ProductRequest();        
        $validator = Validator::make($request->all(), $rule->rules());
        if ($validator->fails())
        {
            return response()->json(['success'=>false,'msg'=>$validator->errors()->all()]);
        } 
        else{
            $Product = Product::find($request->id);
            $Product->update($request->all());
            return response()->json(['success'=>true,'msg'=>'Se actualizo existosamente.']);
        }
    }
    public function destroy(Request $request)
    {
        $Product = Product::find($request->id);
        $Product->state = "ELIMINADO";
        $Product->update();
        return response()->json(['success'=>true,'msg'=>'Registro borrado.']);
    }

    public function list(Request $request)
    {
        switch ($request->by)
        {
            case 'all':
                $list=Product::All()->where('state','ACTIVO');
                return $list;
            break;         
            default:
            break;
        }
    }

    // Return Views
    public function product()
    {
        return view('manage_inventory.product');
    }
}
