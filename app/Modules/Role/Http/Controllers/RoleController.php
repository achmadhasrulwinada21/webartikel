<?php

namespace App\Modules\Role\Http\Controllers;

use Str;
use DataTables;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{

    public function listAll() {
        $role = Role::all();
        
        return Datatables::of($role)
            ->addColumn('action', function ($role) {
                $html = '<a href="/'.config('app.app_prefix').'/role/'.$role->id.'/edit" class="btn btn-primary" >Edit</a> &nbsp <button id="deleteRole" data-id="'. $role->id .'" class="btn btn-danger">Delete</button>';
                return $html;
           })
        ->make(true);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('role::list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::all();

        $data['permissions'] = $permissions;

        return view('role::create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name'          => 'required|min:6',
            'description'   => 'required|min:6',
        ]);

        if($validatedData) {
            $role = new Role();
            $role->name = $request->name;
            $role->description = $request->description;
            $role->guard_name   = "web";
            $role->slug         = Str::slug($request->name, "-");
            $role->save();
    
            $role->givePermissionTo($request->permissions);
        }

        return redirect(config('app.app_prefix') . '/role');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role        = Role::with('permissions')->find($id)->toArray();
        $permissions = Permission::all()->toArray();
        
        $data['role']        = $role;
        $data['permissions'] = $permissions;
        
        return view('role::edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $role = Role::find($id);
        
        $role->name = $request->name;
        $role->description = $request->description;
        $role->save();
        
        $role->syncPermissions($request->permissions);

        return redirect(config('app.app_prefix') . '/role');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::destroy($id);

        $data = [
            "status" => 200,
            "message" => "Successfully Delete Rele"
        ];

        return json_encode($data);
    }
}
