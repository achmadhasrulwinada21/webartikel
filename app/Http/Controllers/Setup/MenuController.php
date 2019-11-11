<?php

namespace App\Http\Controllers\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 
use App\Model\Setup\Settingweb;
use App\Model\Setup\Menu;
use App\Model\Setup\Judul;
use DataTables;

class MenuController extends Controller
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
       $menu = DB::table('tabel_menu')
            ->select(DB::raw('tabel_menu.id,tabel_menu.link,tabel_menu.icon,tabel_menu.childjudul,tabel_menu.id_jdl,judul_menu.judul,judul_menu.id as judul_id'))
           ->leftJoin('judul_menu', 'judul_menu.id', '=', 'tabel_menu.id_jdl')
           ->get();
        return Datatables::of($menu)
          ->addColumn('action', function ($menu) {
                $btn = '<center><a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$menu->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editProduct"><i class="fa fa-edit"></i>&nbspEdit</a>';
                           $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$menu->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct"><i class="fa fa-trash"></i>&nbspDelete</a></center>';
                      return $btn;
            }
        )
        ->addIndexColumn()
        ->make(true);
    }

     public function index(){
        $menu = DB::table('tabel_menu')
           ->leftJoin('judul_menu', 'judul_menu.id', '=', 'tabel_menu.id_jdl')
           ->get();
          $judul = DB::table('judul_menu')
          ->orderBy('id', 'desc')
          ->get();
         $judul2 = DB::table('judul_menu')
           ->where('id', '<>', '9')
          ->orderBy('id', 'desc')
          ->get();
         $settingweb = Settingweb::find('001');
        return view('setup.menu',['menu' => $menu,'settingweb' => $settingweb,'judul' => $judul,'judul2' => $judul2]);
    }

     public function insert(Request $request)

     {
        Menu::updateOrCreate(['id' => $request->id],

                [
                    'link' => $request->link,
                    'icon' => $request->icon,
                    'childjudul' => $request->childjudul,
                    'id_jdl' => $request->id_jdl
                ]
                );        
        
        return response()->json(['success'=>'saved successfully.']);

    }
    public function edit($id)
    {
    //    $menu = DB::table('tabel_menu')
    //        ->leftJoin('judul_menu', 'judul_menu.id', '=', 'tabel_menu.id_jdl')
    //         ->where('tabel_menu.id','=',$id)
    //        ->get();
      $menu = Menu::find($id);
        return response()->json($menu);
    }
     public function destroy($id)
    {
        Menu::find($id)->delete();
       $callback = [
            "message" => "Data has been Deleted",
            "code"   => 200
        ];

        return json_encode($callback, TRUE);
    }
    
}
