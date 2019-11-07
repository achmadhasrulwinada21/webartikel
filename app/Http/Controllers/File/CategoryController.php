<?php

namespace App\Http\Controllers\File;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\File\Category;
use App\Model\Setup\Settingweb;
use DataTables;

class CategoryController extends Controller
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
        $kategori = Category::all();
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
        $kategori = Category::all();
        $settingweb = Settingweb::all();
    	return view('file.category',['kategori' => $kategori,'settingweb' => $settingweb]);
    }

     public function store(Request $request)

     {
        Category::updateOrCreate(['id' => $request->id],

                [
                    'kategori' => $request->kategori
                ]
                );        
        
        return response()->json(['success'=>'saved successfully.']);

    }

 public function edit($id)
    {
        $kategori = Category::find($id);
        return response()->json($kategori);
    }

     public function destroy($id)
    {
        Category::find($id)->delete();
       $callback = [
            "message" => "Data has been Deleted",
            "code"   => 200
        ];

        return json_encode($callback, TRUE);
    }
}
