<?php

namespace App\Http\Controllers\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Setup\Manajemenuser;
use App\Model\Setup\Settingweb;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use DataTables;
use Session;
use Mail;
use App\Mail\AchmadEmail;

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
        $settingweb = Settingweb::find('001');
    	return view('setup.manajemenuser',['manajemenuser' => $manajemenuser,'settingweb' => $settingweb]);
    }

    public function insert(Request $request)
    {
    	$this->validate($request,[
		    'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'jabatan' => ['required', 'in:admin,member'],
        ]);
        
          $password = Str::random(8);
          $request->pwd =$password;

           Mail::to($request->email)->send(new AchmadEmail($request));

        Manajemenuser::create([
			'name' => $request['name'],
            'email' => $request['email'],
            'password' => bcrypt($password),
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
                   'password' => bcrypt($request->password),
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
