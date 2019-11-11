<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Master\Produk;
use App\Model\Setup\Settingweb;
use DataTables;
use Session;
use File;

class ProdukController extends Controller
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
        $produk = Produk::all();
        return Datatables::of($produk)
         ->addColumn('action', function ($produk) {
             $status=$produk->status;
             if($status==1){
                $status='<center><b style="color:blue;">Aktif</b></center>';
             }else{
                $status='<center><b style="color:red;">Tidak Aktif</b></center>';
             }
                return 
                '<span>'.$status.'</span>';
            }
        )
        ->addIndexColumn()
        ->make(true);
    }
     public function index(){
        $produk = Produk::all();
        $settingweb = Settingweb::find('001');
    	return view('master.produk.produk',['produk' => $produk,'settingweb' => $settingweb]);
    }
    public function tambah(){
        $produk = Produk::all();
        $settingweb = Settingweb::find('001');
    	return view('master.produk.tambah_produk',['produk' => $produk,'settingweb' => $settingweb]);
  }
  public function insert(Request $request) {
               
    	$this->validate($request,[
            'nama' =>'required',
            'ket' =>'required',
            'foto' =>'required|file|image|mimes:jpeg,png,jpg|max:2048',
            'status' => 'required',
            'link' => 'required',
         ]);

         // menyimpan data file yang diupload ke variabel $file
        $file = $request->file('foto');
        $path       = 'data_file/foto_produk/';
		$nama_file = $path.$file->getClientOriginalName();
        // isi dengan nama folder tempat kemana file diupload
		$tujuan_upload =  $path;
        $file->move($tujuan_upload,$nama_file);
                
        Produk::create([
            'nama' => $request->nama,
            'ket' => $request->ket,
            'foto' => $nama_file,
            'status' => $request->status,
            'link' => $request->link,
        ]);
        
         Session::flash('sukses','Produk Telah Ditambahkan');
        return redirect('/admin/produk');
    }

     public function edit($id){
      $produk = Produk::find($id);
      $settingweb = Settingweb::find('001');
       return view('master.produk.edit_produk', ['produk' => $produk,'settingweb' => $settingweb]);
    }

     public function update($id, Request $request){
    $this->validate($request,[
	    'nama' =>'required',
        'ket' =>'required',
        'foto' =>'file|image|mimes:jpeg,png,jpg|max:2048',
        'link' => 'required',
        'status' => 'required',
    ]);

    $produk = Produk::find($id);

    if($request->file('foto') == "")
        {
            $produk->foto = $produk->foto;
        } 
        else
        {
            File::delete($produk->foto);
            $file       = $request->file('foto');
            $path       = 'data_file/foto_produk/';
            $fileName   =  $path.$file->getClientOriginalName();
            $request->file('foto')->move($path, $fileName);
            $produk->foto = $fileName;
        }
   
    
	$produk->nama = $request->nama;
	$produk->ket = $request->ket;
    $produk->link = $request->link;
    $produk->status = $request->status;
    $produk->save();
    Session::flash('sukses21','Produk Telah Diupdate');
    return redirect('/admin/produk');
}

    public function delete($id) {
        $produk = Produk::find($id);

        File::delete($produk->foto);
         $produk->delete();

        $callback = [
            "message" => "Data has been Deleted",
            "code"   => 200
        ];

        return json_encode($callback, TRUE);
    }
}
