<?php

namespace App\Http\Controllers\Artikel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Artikel\Artikel;
use App\Model\Artikel\V_artikel;
use App\Model\Artikel\Kategori;
use App\Model\Setup\Settingweb;
use DataTables;
use Session;
use File;
use App\Mail\AchmadEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

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
        $v_artikel = DB::table('artikel') 
                    ->select(DB::raw('artikel.id,artikel.judul,artikel.isi_artikel,artikel.foto,artikel.id_kategori,kategori.kategori,artikel.file_artikel,artikel.keyword'))
                    ->Join('kategori','artikel.id_kategori', '=', 'kategori.id')
                     ->get();
        return Datatables::of($v_artikel)
        ->addIndexColumn()
        ->make(true);
    }

     public function index(){
        $artikel = Artikel::all();
         $settingweb = Settingweb::all();
        return view('artikel.artikel',['artikel' => $artikel,'settingweb' => $settingweb]);
    }

     public function tambah(){
        $kategori = Kategori::all();
        $settingweb = Settingweb::all();
    	return view('artikel.tambah_artikel',['kategori' => $kategori,'settingweb' => $settingweb]);
  }

  public function insert(Request $request) {
               
    	$this->validate($request,[
            'judul' =>'required',
            'isi_artikel' =>'required',
            'foto' =>'required|file|image|mimes:jpeg,png,jpg|max:2048',
            'file_artikel'=>'file|mimes:pdf|max:2048',
            'id_kategori' => 'required',
            'keyword' => 'required',
         ]);

//join tb_kategori n tb_artikel

 $kategori = DB::table('kategori')
             ->where('id', '=', $request->id_kategori)
             ->get(); 
          
          foreach($kategori as $k){
              $id_kat = $k->id;
           }
 $menuutama = DB::table('artikel')
             ->leftJoin('kategori','artikel.id_kategori', '=', 'kategori.id')
             ->where('artikel.id_kategori', '=',  $id_kat)
             ->get(); 

             foreach ($menuutama as $item){
                   $request->kat = $item->kategori;
              }
  //end join tb_kategori n tb_artikel 

         // menyimpan data file yang diupload ke variabel $file
        $file = $request->file('foto');
        $path       = 'data_file/foto_artikel/';
		$nama_file = $path.$file->getClientOriginalName();
        $request->foto=$nama_file;
      	// isi dengan nama folder tempat kemana file diupload
		$tujuan_upload = 'data_file/foto_artikel';
        $file->move($tujuan_upload,$nama_file);
        
        if($request->file('file_artikel') == "")
        {
            $nama_file2 =' ';
        }else{
          // menyimpan data file yang diupload ke variabel $file
        $file2 = $request->file('file_artikel');
        $path2       = 'data_file/file_artikel/';
		$nama_file2 = $path2.$file2->getClientOriginalName();
 
      	// isi dengan nama folder tempat kemana file diupload
		$tujuan_upload2 = 'data_file/file_artikel';
		$file2->move($tujuan_upload2,$nama_file2);
        }
        
        Artikel::create([
            'judul' => $request->judul,
            'isi_artikel' => $request->isi_artikel,
            'foto' => $nama_file,
            'file_artikel' => $nama_file2,
            'id_kategori' => $request->id_kategori,
            'keyword' => $request->keyword,
		]);
          Session::flash('sukses','Artikel Telah Ditambahkan');

          Mail::to("testing@mail.com")->send(new AchmadEmail($request));

    	return redirect('/admin/artikel');
    }

      public function edit($id){
      $artikel = Artikel::find($id);
      $settingweb = Settingweb::all();
      $kategori = Kategori::all();
     return view('artikel.edit_artikel', ['artikel' => $artikel,'kategori' => $kategori,'settingweb' => $settingweb]);
    }
    
      public function update($id, Request $request){
    $this->validate($request,[
	    'judul' =>'required',
        'isi_artikel' =>'required',
        'foto' =>'file|image|mimes:jpeg,png,jpg|max:2048',
        'file_artikel'=>'file|mimes:pdf|max:2048',
        'id_kategori' => 'required',
        'keyword' => 'required',
    ]);

    $artikel = Artikel::find($id);

    if($request->file('foto') == "")
        {
            $artikel->foto = $artikel->foto;
        } 
        else
        {
            File::delete($artikel->foto);
            $file       = $request->file('foto');
            $path       = 'data_file/foto_artikel/';
            $fileName   =  $path.$file->getClientOriginalName();
            $request->file('foto')->move($path, $fileName);
            $artikel->foto = $fileName;
        }

     if($request->file('file_artikel') == "")
        {
            $artikel->file_artikel = $artikel->file_artikel;
        } 
        else
        {
            File::delete($artikel->file_artikel);
            $file2       = $request->file('file_artikel');
            $path2       = 'data_file/file_artikel/';
            $fileName2   =  $path2.$file2->getClientOriginalName();
            $request->file('file_artikel')->move($path2, $fileName2);
            $artikel->file_artikel = $fileName2;
        }
    
    
	$artikel->judul = $request->judul;
	$artikel->isi_artikel = $request->isi_artikel;
    $artikel->id_kategori = $request->id_kategori;
    $artikel->keyword = $request->keyword;
    $artikel->save();
    Session::flash('sukses21','Artikel Telah Diupdate');
    return redirect('/admin/artikel');
}

     public function delete($id) {
        $artikel = Artikel::find($id);

        File::delete($artikel->foto);
        File::delete($artikel->file_artikel);
        $artikel->delete();

        $callback = [
            "message" => "Data has been Deleted",
            "code"   => 200
        ];

        return json_encode($callback, TRUE);
    }

}
