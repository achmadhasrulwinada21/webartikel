<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Artikel;
use App\Model\V_artikel;
use App\Model\Kategori;
use DataTables;
use Session;

class ArtikelController extends Controller
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
        $v_artikel = V_artikel::all();
        return Datatables::of($v_artikel)
          ->addColumn('action', function ($v_artikel) {
                return '<span>'.$v_artikel->isi_artikel.'</span>';
            }
        )
        ->addIndexColumn()
        ->make(true);
    }

     public function index(){
		$artikel = Artikel::all();
        return view('artikel',['artikel' => $artikel]);
    }

     public function tambah(){
	    $kategori = Kategori::all();
    	return view('tambah_artikel',['kategori' => $kategori]);
  }

  public function insert(Request $request) {
    	$this->validate($request,[
            'judul' =>'required',
            'isi_artikel' =>'required',
             'foto' =>'required|file|image|mimes:jpeg,png,jpg|max:2048',
             'id_kategori' => 'required',
         ]);
         
         // menyimpan data file yang diupload ke variabel $file
		$file = $request->file('foto');
		$nama_file = $file->getClientOriginalName();
 
      	// isi dengan nama folder tempat kemana file diupload
		$tujuan_upload = 'data_file/foto_artikel';
		$file->move($tujuan_upload,$nama_file);
 
        Artikel::create([
            'judul' => $request->judul,
            'isi_artikel' => $request->isi_artikel,
            'foto' => $nama_file,
            'id_kategori' => $request->id_kategori,
		]);
          Session::flash('sukses','Artikel Telah Ditambahkan');
    	return redirect('/admin/artikel');
    }

      public function edit($id){
     $artikel = Artikel::find($id);
     $kategori = Kategori::all();
     return view('edit_artikel', ['artikel' => $artikel,'kategori' => $kategori]);
    }
    
      public function update($id, Request $request){
    $this->validate($request,[
	    'judul' =>'required',
        'isi_artikel' =>'required',
        'foto' =>'file|image|mimes:jpeg,png,jpg|max:2048',
        'id_kategori' => 'required',
    ]);

    $artikel = Artikel::find($id);

    if($request->file('foto') == "")
        {
            $artikel->foto = $artikel->foto;
        } 
        else
        {
            $file       = $request->file('foto');
            $fileName   = $file->getClientOriginalName();
            $request->file('foto')->move("data_file/foto_artikel/", $fileName);
            $artikel->foto = $fileName;
        }
	$artikel->judul = $request->judul;
	$artikel->isi_artikel = $request->isi_artikel;
    $artikel->id_kategori = $request->id_kategori;
    $artikel->save();
    Session::flash('sukses21','Artikel Telah Diupdate');
    return redirect('/admin/artikel');
}

     public function delete($id) {
        $artikel = Artikel::find($id);
        $artikel->delete();

        $callback = [
            "message" => "Data has been Deleted",
            "code"   => 200
        ];

        return json_encode($callback, TRUE);
    }
}
