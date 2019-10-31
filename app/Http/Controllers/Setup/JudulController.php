<?php

namespace App\Http\Controllers\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 
use App\Model\Setup\Settingweb;
use App\Model\Setup\Judul;
use DataTables;

class JudulController extends Controller
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
     public function json(){
         $judul = Judul::all();
        return Datatables::of($judul)
          ->addColumn('action', function ($judul) {
                $btn = '<center><a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$judul->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editProduct"><i class="fa fa-edit"></i>&nbspEdit</a>';
                           $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$judul->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct"><i class="fa fa-trash"></i>&nbspDelete</a></center>';
                      return $btn;
            }
        )
        ->addIndexColumn()
        ->make(true);
    }

     public function index(){
         $judul = Judul::all();
         $settingweb = Settingweb::all();
        return view('setup.judul',['judul' => $judul,'settingweb' => $settingweb]);
    }

     public function insert(Request $request)

     {
        Judul::updateOrCreate(['id' => $request->id],

                [
                    'judul' => $request->judul,
                    'keterangan' => $request->keterangan,
                ]
                );        
        
        return response()->json(['success'=>'saved successfully.']);

    }

    public function edit($id)
    {
        $judul = Judul::find($id);
        return response()->json($judul);
    }
    public function destroy($id)
    {
        Judul::find($id)->delete();
       $callback = [
            "message" => "Data has been Deleted",
            "code"   => 200
        ];

        return json_encode($callback, TRUE);
    }
}
