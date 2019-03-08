<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Role;
use App\RoleUser;
class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware(['jwt','permisoRol:admin'], ['except' => ['store']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        
        $datos=User::all();
        return  response()->json(['datos'=>$datos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return response()->json(['roles'=>Role::all()]);
    }

   /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
 

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $registro = new User();
        // $registro->name = $request->input('name');
        // $registro->email = $request->input('email');
        // $registro->password =bcrypt($request->input('password'));
        // $registro->save();
        // return redirect('user');

        /*$this->validate($request,[ 'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'string', 'min:6', 'confirmed'],
        'password' => ['required', 'string', 'confirmed']]);*/

        try {
            $user=User::create($request->all());
            $user->password=bcrypt($user->password);
            $user->save();
            $user->roles()->attach(Role::where('name',  $request->input('rol'))->first());
    
            return response()->json(['success'=>'Registro creado satisfactoriamente']);
        } catch (\Throwable $th) {
            return response()->json(['error'=>'Registro  no guardado'.$th]);
        }

      
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        $dato=User::find($id);
        $user_rol=RoleUser::where('user_id',$id)->first();
        $rol=Role::find($user_rol->role_id);

        $roles=Role::all();

        return response()->json(['dato'=>$dato,'rol'=>$rol,'roles'=>$roles]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {

        $this->validate($request,[ 'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255'],
        'password' => ['required', 'string', 'min:6', 'confirmed'],
        'password' => ['required', 'string', 'confirmed']]);

        User::find($id)->update($request->all());
        return response()->json(['success'=>'Registro actualizado satisfactoriamente']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        User::find($id)->delete();
        return response()->json(['success'=>'Registro eliminado satisfactoriamente']);
    }
}
