<?php

namespace App\Http\Controllers\Navbar;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 
use App\Model\Setup\Settingweb;
use App\Model\Navbar\Navbarheader;
use App\Model\Navbar\Navbarsub;
use App\Model\Navbar\Navbarsub2;
use DataTables;

class NavbarController extends Controller
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
         $navbarheader = Navbarheader::all();
        return Datatables::of($navbarheader)
          ->addColumn('action', function ($navbarheader) {
               $btn1 = '<center><a href="/navbar/show/'.$navbarheader->id.'" data-toggle="tooltip"  title="Tambah Sub" class="btn btn-xs btn-success"><i class="fa fa-plus"></i> Tambah Sub</a> ';
                $btn = '<a href="javascript:void(0)" data-toggle="tooltip" title="Update" data-id="'.$navbarheader->id.'" data-original-title="Edit" class="edit btn btn-primary btn-xs editProduct"><i class="fa fa-edit"></i>&nbspEdit</a>';
                $btn = $btn1. $btn.' <a href="javascript:void(0)" data-toggle="tooltip" title="Delete" data-id="'.$navbarheader->id.'" data-original-title="Delete" class="btn btn-danger btn-xs deleteProduct"><i class="fa fa-trash"></i>&nbspDelete</a></center>';
                      return $btn;
            }
        )
        ->addIndexColumn()
        ->make(true);
    }

     public function index(){
         $navbarheader = Navbarheader::all();
         $settingweb = Settingweb::all();
        return view('navbar.navbar_header',['navbarheader' => $navbarheader,'settingweb' => $settingweb]);
    }
public function edit($id)
    {
        $navbarheader = Navbarheader::find($id);
        return response()->json($navbarheader);
    }

    public function insert(Request $request)

     {
        Navbarheader::updateOrCreate(['id' => $request->id],

                [
                    'Judul' => $request->Judul,
                    'link' => $request->link,
                ]
                );        
        
        return response()->json(['success'=>'saved successfully.']);

    }

    public function destroy($id)
    {
        Navbarheader::find($id)->delete();
       $callback = [
            "message" => "Data has been Deleted",
            "code"   => 200
        ];

        return json_encode($callback, TRUE);
    }

    public function show($id)
    {
        $navbarheader = Navbarheader::find($id);
        $navbarsub = DB::table('navbar_header')
                     ->leftJoin('navbar_submenu', 'navbar_header.id', '=', 'navbar_submenu.id_navbar')
                     ->where('navbar_submenu.id_navbar', '=', $id)
                     ->get();
        $settingweb = Settingweb::all();
       return view('navbar.navbar_sub', ['navbarheader' => $navbarheader,'navbarsub' => $navbarsub,'settingweb' => $settingweb]);
    }

    public function insert_detail(Request $request) {
               
    	$this->validate($request,[
            'judul_sub' =>'required',
            'link_sub' =>'required',
            'id_navbar' => 'required',
            ]);
            $judul_sub=$request->judul_sub;

for($count = 0; $count<count($judul_sub); $count++)
 {
        Navbarsub::create([
            'judul_sub' => $request->judul_sub[$count],
            'link_sub' => $request->link_sub[$count],
            'id_navbar' => $request->id_navbar[$count],
         ]);
}
        return response()->json(['success'=>'saved successfully.']);
    }

    public function delete($id)
    {
        Navbarsub::find($id)->delete();
       $callback = [
            "message" => "Data has been Deleted",
            "code"   => 200
        ];

        return json_encode($callback, TRUE);
    }

    public function edit2($id)
    {
        $navbarsub = Navbarsub::find($id);
        return response()->json($navbarsub);
    }

     public function update_detail(Request $request)

     {
        Navbarsub::updateOrCreate(['id' => $request->id],

                [
                    'judul_sub' => $request->judul_sub,
                    'link_sub' => $request->link_sub,
                ]
                );        
        
        return response()->json(['success'=>'saved successfully.']);

    }

    public function show2($id)
    {
        $navbarsub = Navbarsub::find($id);
        $navbarsub2 = DB::table('navbar_submenu')
                     ->leftJoin('navbar_submenu2', 'navbar_submenu.id', '=', 'navbar_submenu2.id_sub')
                     ->where('navbar_submenu2.id_sub', '=', $id)
                     ->get();
        $settingweb = Settingweb::all();
       return view('navbar.navbar_sub2', ['navbarsub' => $navbarsub,'navbarsub2' => $navbarsub2,'settingweb' => $settingweb]);
    }

    public function insert_detailsub2(Request $request) {
               
    	$this->validate($request,[
            'judul_sub2' =>'required',
            'link_sub2' =>'required',
            'id_sub' => 'required',
            ]);
            $judul_sub2=$request->judul_sub2;

for($count = 0; $count<count($judul_sub2); $count++)
 {
        Navbarsub2::create([
            'judul_sub2' => $request->judul_sub2[$count],
            'link_sub2' => $request->link_sub2[$count],
            'id_sub' => $request->id_sub[$count],
         ]);
}
        return response()->json(['success'=>'saved successfully.']);
    }

    public function deletesub2($id)
    {
        Navbarsub2::find($id)->delete();
       $callback = [
            "message" => "Data has been Deleted",
            "code"   => 200
        ];

        return json_encode($callback, TRUE);
    }

    public function update_detailsub2(Request $request)

     {
        Navbarsub2::updateOrCreate(['id' => $request->id],

                [
                    'judul_sub2' => $request->judul_sub2,
                    'link_sub2' => $request->link_sub2,
                ]
                );        
        
        return response()->json(['success'=>'saved successfully.']);

    }
}
