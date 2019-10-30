<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Manajemenuser;
use App\Model\Settingweb;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use DataTables;
use Session;

class ManajemenuserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    //  public function index()
    // {
    //      $manajemenuser = Manajemenuser::all();
    // 	 return view('manajemenuser',['manajemenuser' => $manajemenuser]);
    // }
    public function json(){
        $manajemenuser = Manajemenuser::all();
        return Datatables::of($manajemenuser)
         ->addColumn('action', function ($manajemenuser) {
            $btn1 = '<center><a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$manajemenuser->id.'" data-original-title="password" title="Ganti Password"  class="btn btn-warning btn-sm editpwd"><i class="fa fa-key"></i></a> ';
            $btn = ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$manajemenuser->id.'" data-original-title="Edit"  title="Update" class="edit btn btn-primary btn-sm editProduct"><i class="fa fa-edit"></i></a>';
            $btn = $btn1.$btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$manajemenuser->id.'" data-original-title="Delete"  title="Delete" class="btn btn-danger btn-sm deleteProduct"><i class="fa fa-trash"></i></a></center>';
            return $btn;
            }
        )
        ->addIndexColumn()
        ->make(true);
    }

    public function index(){
       $manajemenuser = Manajemenuser::all();
        $settingweb = Settingweb::all();
    	return view('manajemenuser',['manajemenuser' => $manajemenuser,'settingweb' => $settingweb]);
    }

    public function insert(Request $request)
    {
    	$this->validate($request,[
		    'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'jabatan' => ['required', 'in:admin,member'],
    	]);
 
        Manajemenuser::create([
			'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'jabatan' => $request['jabatan'],
    	]);
 
     return response()->json(['success'=>'saved successfully.']);
    }

     public function show($id)
    {
        $manajemenuser = Manajemenuser::find($id);
        return response()->json($manajemenuser);
    }

    
    public function edit($id)
    {
        $manajemenuser = Manajemenuser::find($id);
        return response()->json($manajemenuser);
    }

     public function update(Request $request){
    $this->validate($request,[
	   'name' => 'required',
	   'email' =>'required',
	   'jabatan' => 'required'
    ]);

    Manajemenuser::updateOrCreate(['id' => $request->id],

                [
                    'name' => $request->name,
                    'email' => $request->email,
                    'jabatan' => $request->jabatan,
                ]
                );        
    return response()->json(['success'=>'saved successfully.']);
}

public function update2(Request $request){
    $this->validate($request,[
	   'password' => ['required', 'string', 'min:8', 'confirmed'],
    ]);

    Manajemenuser::updateOrCreate(['id' => $request->id],

                [
                   'password' => Hash::make($request->password),
                                    ]
                );        
    return response()->json(['success'=>'saved successfully.']);
}

 public function destroy($id)
    {
        Manajemenuser::find($id)->delete();
       $callback = [
            "message" => "Data has been Deleted",
            "code"   => 200
        ];

        return json_encode($callback, TRUE);
    }

}
