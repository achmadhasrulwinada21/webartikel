<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Settingweb;
use Illuminate\Support\Facades\DB;
use Session;

class SettingwebController extends Controller
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
        $settingweb = Settingweb::all();
        return Datatables::of($settingweb)
         ->addColumn('action', function ($settingweb) {
                $btn = '<center><a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$settingweb->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editProduct"><i class="fa fa-edit"></i>&nbspEdit</a>';
                           $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$settingweb->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct"><i class="fa fa-trash"></i>&nbspDelete</a></center>';
                      return $btn;
            }
        )
        ->addIndexColumn()
        ->make(true);
    }

    public function index(){
        $settingweb = Settingweb::all();
         return view('settingweb',['settingweb' => $settingweb]);
    }

     public function show(){
		$settingweb = Settingweb::all();
        return view('layouts.index',['settingweb' => $settingweb]);
    }

     public function update(Request $request)
    {
          $this->validate($request,[
                'title' => 'required',
                'nm_web' =>'required',
                'link_web' => 'required',
                'logo_web' =>'file|image|mimes:jpeg,png,jpg|max:2048',
               ]);

        $settingweb = Settingweb::find($request->id);

     if($request->file('logo_web') == "")
        {
            $settingweb->logo_web = $settingweb->logo_web;
        } 
        else
        {
            $file       = $request->file('logo_web');
            $path       = 'assets/logo_web/';
            $fileName   =  $path.$file->getClientOriginalName();
            $request->file('logo_web')->move($path, $fileName);
            $settingweb->logo_web = $fileName;
        }
          $settingweb->id = $request->id;
          $settingweb->title = $request->title;
          $settingweb->nm_web = $request->nm_web;
          $settingweb->link_web = $request->link_web; 
          $settingweb->save();
         Session::flash('sukses','Artikel Telah Diupdate');
        return redirect('/admin/settingweb');

    }
}
