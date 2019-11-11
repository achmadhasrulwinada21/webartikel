<?php

namespace App\Http\Controllers\Artikel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Artikel\Kategori;
use App\Model\Setup\Settingweb;
use DataTables;

class KategoriController extends Controller
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
        $kategori = Kategori::all();
        return Datatables::of($kategori)
         ->addColumn('action', function ($kategori) {
                $btn = '<center><a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$kategori->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editProduct"><i class="fa fa-edit"></i>&nbspEdit</a>';
                           $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$kategori->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct"><i class="fa fa-trash"></i>&nbspDelete</a></center>';
                      return $btn;
            }
        )
        ->addIndexColumn()
        ->make(true);
    }

     public function index(){
        $kategori = Kategori::all();
         $settingweb = Settingweb::find('001');
    	return view('artikel.kategori',['kategori' => $kategori,'settingweb' => $settingweb]);
    }

     public function store(Request $request)

     {
        Kategori::updateOrCreate(['id' => $request->id],

                [
                    'kategori' => $request->kategori
                ]
                );        
        
        return response()->json(['success'=>'saved successfully.']);

    }

 public function edit($id)
    {
        $kategori = Kategori::find($id);
        return response()->json($kategori);
    }

     public function destroy($id)
    {
        Kategori::find($id)->delete();
       $callback = [
            "message" => "Data has been Deleted",
            "code"   => 200
        ];

        return json_encode($callback, TRUE);
    }
}
