<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Catalogue;
use App\TypeCatalog;
use App\Product;
use Yajra\DataTables\DataTables;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\Storage;
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
        if (!$isUser) {
            $visibility = "disabled";
        }

        return datatables()->of(Product::all()->where('state', '!=', 'ELIMINADO'))
            ->addColumn('catalog_product_id', function ($item) {
                $catalog_product_id = Catalogue::find($item->catalog_product_id);
                return  $catalog_product_id->name;
            })
            ->addColumn('Imagen', function ($item) use ($visibility) {
                $item->v = $visibility;
                return '<img src="' . $item->photo . '" alt="image" width="125px" onclick="window.open(\'' . $item->photo . '\');"></img>';
            })

            ->addColumn('QR', function ($item) {
                return '<a class="btn btn-light text-black border" onclick="Gen_QR(\'' . $item->id . ' | ' . $item->name . '\')"><i class="icon-qrcode"></i></a>';
            })

            //use para usar varible externa

            ->addColumn('Editar', function ($item) use ($visibility) {
                $item->v = $visibility;
                return '<a class="btn btn-xs btn-primary text-white ' . $item->v . '" onclick="Edit(' . $item->id . ')" ><i class="icon-pencil"></i></a>';
            })
            ->addColumn('Eliminar', function ($item) {
                return '<a class="btn btn-xs btn-danger text-white ' . $item->v . '" onclick="Delete(\'' . $item->id . '\')"><i class="icon-trash"></i></a>';
            })
            ->rawColumns(['Imagen','QR', 'Editar', 'Eliminar'])
            ->toJson();
    }
    public function store(Request $request)
    {
        $rule = new ProductRequest();
        $validator = Validator::make($request->all(), $rule->rules());
        if ($validator->fails()) {
            return response()->json(['success' => false, 'msg' => $validator->errors()->all()]);
        } else {

            $product = Product::create($request->all());
            //IMAGE 
            if ($request->image) {
                $this->SaveFile($product, $request->image, $request->extension_image, '/images/product/');
            }
            return response()->json(['success' => true, 'msg' => 'Registro existoso.']);
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
        if ($validator->fails()) {
            return response()->json(['success' => false, 'msg' => $validator->errors()->all()]);
        } else {
            $Product = Product::find($request->id);
            $Product->update($request->all());
            
            if ($request->image && $request->extension_image) {
                //Delete File
            
                Storage::disk('public')->delete($Product->photo);
                $this->SaveFile($Product, $request->image, $request->extension_image, '/images/Business/');
            }

            return response()->json(['success' => true, 'msg' => 'Se actualizo existosamente.']);
        }
    }
    public function destroy(Request $request)
    {
        $Product = Product::find($request->id);
        $Product->state = "ELIMINADO";
        $Product->update();
        return response()->json(['success' => true, 'msg' => 'Registro borrado.']);
    }

    public function list(Request $request)
    {
        switch ($request->by) {
            case 'all':
                $list = Product::All()->where('state', 'ACTIVO');
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

    public function SaveFile($obj, $code, $extension_file, $path)
    {
        $image = $code;
        switch ($extension_file) {
            case 'png':
                $image = str_replace('data:image/png;base64,', '', $image);
                $image = str_replace(' ', '+', $image);
                $imageURL = $path . time() . '.png';
                Storage::disk('public')->put($imageURL,  base64_decode($image));
                $obj->photo = $imageURL;
                $obj->save();
                return response()->json(['success' => true, 'msg' => 'Registro existoso']);
                break;
            case 'jpeg':
                $image = str_replace('data:image/jpeg;base64,', '', $image);
                $image = str_replace(' ', '+', $image);
                $imageURL = $path . time() . '.jpeg';
                Storage::disk('public')->put($imageURL,  base64_decode($image));
                $obj->photo = $imageURL;
                $obj->save();
                return response()->json(['success' => true, 'msg' => 'Registro existoso']);
                break;
            case 'jpg':
                $image = str_replace('data:image/jpeg;base64,', '', $image);
                $image = str_replace(' ', '+', $image);
                $imageURL = $path . time() . '.jpg';
                Storage::disk('public')->put($imageURL,  base64_decode($image));
                $obj->photo = $imageURL;
                $obj->save();
                return response()->json(['success' => true, 'msg' => 'Registro existoso']);
                break;
            case 'gif':
                $image = str_replace('data:image/gif;base64,', '', $image);
                $image = str_replace(' ', '+', $image);
                $imageURL = $path . time() . '.gif';
                Storage::disk('public')->put($imageURL,  base64_decode($image));
                $obj->photo = $imageURL;
                $obj->save();
                return response()->json(['success' => true, 'msg' => 'Registro existoso']);
                break;
            default:
                return response()->json(['success' => false, 'msg' => 'Registro existoso, tipo de archivo incompatible.']);
                break;
        }
    }
}
