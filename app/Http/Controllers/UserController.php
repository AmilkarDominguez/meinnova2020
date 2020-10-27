<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Requests\UserRequest;
use Illuminate\Validation\Rule;
use Validator;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:user')->only('user'); 
    }
    public function index()
    {
        $isUser = auth()->user()->can(['user.edit', 'user.destroy']);
        //Variable para la visiblidad
        $visibility = "";
        if (!$isUser) {$visibility="disabled";}
            return datatables()->of(User::all()->where('state','!=','ELIMINADO')->where('name','!=','bytemo'))
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
        $rule = new UserRequest();        
        $validator = Validator::make($request->all(), $rule->rules());
        if ($validator->fails())
        {
            return response()->json(['success'=>false,'msg'=>$validator->errors()->all()]);
        } 
        else{
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'state' => $request->state,
                'email_verified_at' => now(),
                'password' => bcrypt($request->password),
                'remember_token' => str_random(10) 

            ]);
            return response()->json(['success'=>true,'msg'=>'Registro existoso.']);
        }
    }
    public function edit(Request $request)
    {
        $User = User::find($request->id);
        return $User->toJson();
    }
    public function update(Request $request)
    {   
        $validator = Validator::make($request->all(), [
            'name'     => 'required|string|max:255',
            'email'  => 'string|email|max:255',
            'email' => ['required',Rule::unique('users')->ignore($request->id),],
            'state'    => 'required|string',
            'password' => 'required|string|min:5',
        ]);
        if ($validator->fails())
        {
            return response()->json(['success'=>false,'msg'=>$validator->errors()->all()]);
        } 
        else{
            $User = User::find($request->id);
            $User->update([
                'name' => $request->name,
                'email' => $request->email,
                'state' => $request->state,
                'email_verified_at' => now(),
                'password' => bcrypt($request->password),
                'remember_token' => str_random(10) 

            ]);
            return response()->json(['success'=>true,'msg'=>'Se actualizo existosamente.']);
        }
    }
    public function destroy(Request $request)
    {
        $User = User::find($request->id);
        $User->state = "ELIMINADO";
        $User->update();
        return response()->json(['success'=>true,'msg'=>'Registro borrado.']);
    }
    public function user()
    {
        return view ('configuration.user');
    }
}
