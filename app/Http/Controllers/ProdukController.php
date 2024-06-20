<?php

namespace App\Http\Controllers;
use App\Models\Produk;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    public function index(){
        $produk = Produk::all();
        return view('admin.produk', ['produk'=>$produk]);
    }

    public function produk(){
        $produk = Produk::all();
        return view('main', ['produk'=>$produk]);
    }

    public function detail_produk($id)
    {
        // Retrieve the product based on the provided name
        $product = Produk::where('id', $id)->first();

        // Check if the product exists
        if (!$product) {
            abort(404); // Or handle the case when the product is not found
        }

        $data['product'] = $product;

        // Pass the product data to the view
        return view('detail_produk', $data);
    }

    public function store(Request $request)
    {
        if ($request->hasFile('berkas')) {
            $extFile = $request->berkas->getClientOriginalExtension();
            $namaFile = 'Gambar'.$request->nama.'.'.$extFile;
            // $path = $request->berkas->storeAs('public', $namaFile);
            $path = Storage::putFileAs('public', $request->berkas, $namaFile);
        } else {
            $namaFile = 'user.png';
        }

        $validatedData = $request->validate([
            'nama' => 'required',
            'harga' => 'required',
            'stok' => 'required',
            'berkas' => 'image|required',
            'deskripsi' => 'required',
        ]);

        $produk = new Produk();
        $produk->nama = $validatedData['nama'];
        $produk->harga = $validatedData['harga'];
        $produk->stok = $validatedData['stok'];
        $produk->gambar = $namaFile;
        $produk->deskripsi = $validatedData['deskripsi'];
        $produk->save();

        return redirect()->route('produk');
    }


    public function edit(Request $request, $id)
{
    if ($request->hasFile('berkas')) {
        if($request->oldImage){
            Storage::delete($request->oldImage);
        }
        $extFile = $request->berkas->getClientOriginalExtension();
        $namaFile = 'Gambar'.$id.'.'.$extFile; // Pastikan nama file unik, mungkin menggunakan id produk
        $path = $request->berkas->storeAs('public', $namaFile);
    } else {
        $produk = Produk::findOrFail($id);
        $namaFile = $produk->gambar; // Gunakan nama file yang sudah ada
    }

    $validatedData = $request->validate([
        'nama' => 'required',
        'harga' => 'required',
        'stok' => 'required',
        'berkas' => 'image',
        'deskripsi' => 'required',
    ]);

    $produk = Produk::findOrFail($id);
    $produk->nama = $validatedData['nama'];
    $produk->harga = $validatedData['harga'];
    $produk->stok = $validatedData['stok'];
    $produk->gambar = $namaFile;
    $produk->deskripsi = $validatedData['deskripsi'];
    $produk->save();

    return redirect()->route('produk');
}

function destroy(Produk $produk){
        if($produk->gambar){
            Storage::delete($produk->gambar);
        }
        $produk->delete();
        return redirect()->route('produk')->with('pesan', "hapus data $produk->nama berhasil");
    }

}
