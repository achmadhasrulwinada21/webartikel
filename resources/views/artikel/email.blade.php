<h3>Halo, {{ $nama }} !</h3>
<p>{{ $website }}</p>

<p>Selamat datang di <a href="#">www.test.com</a></p>
<p>Tutorial Laravel : kirim email dengan laravel.</p>

<p>{{ $request->judul }}</p>
<p>{{ $request->keyword  }}</p>
<p>{!! $request->isi_artikel !!}</p>
<p>{{ $request->kat }}</p>
 
 <img src="{{ URL::to("$request->foto")}}" id="showgambar" style="max-width:200px;max-height:200px;float:left;" />