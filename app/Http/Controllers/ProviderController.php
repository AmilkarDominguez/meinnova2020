<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// importados
use App\Provider;
use App\Catalogue;
use App\TypeCatalog;
use Yajra\DataTables\DataTables;
use App\Http\Requests\ProviderRequest;
use App\User;
use Validator;

class ProviderController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:provider')->only('provider');
    }
    public function index()
    {
        $isUser = auth()->user()->can(['provider.edit', 'provider.destroy']);
        //Variable para la visiblidad
        $visibility = "";
        if (!$isUser) {
            $visibility = "disabled";
        }

        return datatables()->of(Provider::all()->where('state', '!=', 'ELIMINADO'))
            ->addColumn('email', function ($item) {
                $user = User::find($item->user_id);
                return  $user->email;
            })
            ->addColumn('catalog_zone_name', function ($item) {
                $catalog_zone_name = Catalogue::find($item->catalog_zone_id);
                return  $catalog_zone_name->name;
            })
            //use para usar varible externa
            ->addColumn('Editar', function ($item) use ($visibility) {
                $item->v = $visibility;
                return '<a class="btn btn-xs btn-primary text-white ' . $item->v . '" onclick="Edit(' . $item->id . ')" ><i class="icon-pencil"></i></a>';
            })
            ->addColumn('Eliminar', function ($item) {
                return '<a class="btn btn-xs btn-danger text-white ' . $item->v . '" onclick="Delete(\'' . $item->id . '\')"><i class="icon-trash"></i></a>';
            })
            ->rawColumns(['Editar', 'Eliminar'])

            ->toJson();
    }
    public function store(Request $request)
    {
        $rule = new ProviderRequest();
        $validator = Validator::make($request->all(), $rule->rules());
        if ($validator->fails()) {
            return response()->json(['success' => false, 'msg' => $validator->errors()->all()]);
        } else {
            $proveedor = Provider::create($request->all());

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'state' => 'ACTIVO',
                'email_verified_at' => now(),
                'password' => bcrypt($request->password),
                'remember_token' => str_random(10)
            ]);
            $user->assignRoles('provider');

            $proveedor->user_id = $user->id;
            $proveedor->save();


            return response()->json(['success' => true, 'msg' => 'Registro existoso.']);
        }
    }
    public function show($id)
    {
        $Provider = Provider::find($id);
        $Provider->email = (User::find($Provider->user_id)->email);
        return $Provider->toJson();
    }
    public function edit(Request $request)
    {
        $Provider = Provider::find($request->id);
        $Provider->email = (User::find($Provider->user_id)->email);
        return $Provider->toJson();
    }


    public function update(Request $request)
    {
        $rule = new ProviderRequest();
        $validator = Validator::make($request->all(), $rule->rules());
        if ($validator->fails()) {
            return response()->json(['success' => false, 'msg' => $validator->errors()->all()]);
        } else {
            $Provider = Provider::find($request->id);
            $Provider->update($request->all());


            $User = User::find($Provider->user_id);

            //return response()->json(['success' => true, 'msg' => $User->id]);
            $User->email = $request->email;
            $User->state = $request->state;
            if ($request->password) {
                $User->password = bcrypt($request->password);
            }
            $User->save();
            return response()->json(['success' => true, 'msg' => 'Se actualizo existosamente.']);
        }
    }


    public function destroy(Request $request)
    {
        $Provider = Provider::find($request->id);
        $Provider->state = "ELIMINADO";
        $Provider->update();
        return response()->json(['success' => true, 'msg' => 'Registro borrado.']);
    }

    public function list(Request $request)
    {
        switch ($request->by) {
            case 'all':
                $list = Provider::All()->where('state', 'ACTIVO');
                return $list;
                break;
            default:
                break;
        }
    }

    // Return Views
    public function provider()
    {
        return view('manage_inventory.provider');
    }
}
