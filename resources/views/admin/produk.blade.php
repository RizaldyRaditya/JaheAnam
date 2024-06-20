@extends('admin.admin')
@section('title', 'Produk')

@section('content')
    <div class="container">
        <div class="button d-md-flex justify-content-md-end mt-5">
            <button type="button" rel="tooltip" class="btn btn-success btn-just-icon btn-sm edit-btn" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                Tambah
            </button>
             <!-- Modal -->
            <div class="modal fade" id="staticBackdrop"  data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Produk</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama</label>
                                <input type="text" class="form-control" name="nama" id="nama">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Harga</label>
                                <input type="number" class="form-control" name="harga" id="harga">
                            </div>
                            <div class="mb-3">
                                <label for="alamat" class="form-label">Stok</label>
                                <input type="number" class="form-control" name="stok" id="stok">
                            </div>
                            <div class="mb-3">
                                <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 2 MB</div>
                                <input type="file" class="form-control-file align-items-center" id="berkas" name="berkas">
                            </div>
                            <div class="mb-3">
                                <label for="telp" class="form-label">Deskripsi</label>
                                <textarea class="form-control" placeholder="Deskripsi" id="deskripsi" name="deskripsi" style="height: 100px"></textarea>
                            </div>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th>Nama</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Gambar</th>
                        <th class="col-3">Deskripsi</th>
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($produk as $produk)
                        <tr>
                            <td class="text-center">{{$produk->id}}</td>
                            <td>{{$produk->nama}}</td>
                            <td>{{$produk->harga}}</td>
                            <td>{{$produk->stok}}</td>
                            <td><img src="{{ asset('storage/'. $produk->gambar) }}" alt="Gambar" style="width: 100px"></td>
                            <td>{{$produk->deskripsi}}</td>
                            <td class="td-actions text-right d-flex">
                                <button type="button" rel="tooltip" class="btn btn-success btn-just-icon btn-sm edit-btn" data-bs-toggle="modal" data-bs-target="#staticBackdrop-{{$produk->id}}">
                                    <i class="fa fa-pencil-square-o"></i>
                                </button>
                                <!-- Modal -->
                                <div class="modal fade" id="staticBackdrop-{{$produk->id}}"  data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('produk.edit', ['produk' => $produk->id]) }}" method="POST" enctype="multipart/form-data">
                                            @method('PUT')
                                            @csrf
                                                <input type="hidden" name="oldImage" value="{{$produk->gambar}}">
                                                <div class="mb-3">
                                                    <label for="nama" class="form-label">Nama</label>
                                                    <input type="text" class="form-control" name="nama" id="nama" value="{{ old('nama') ?? $produk->nama}}">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="email" class="form-label">Harga</label>
                                                    <input type="number" class="form-control" name="harga" id="harga" value="{{ old('harga') ?? $produk->harga}}">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="alamat" class="form-label">Stok</label>
                                                    <input type="number" class="form-control" name="stok" id="stok" value="{{ old('stok') ?? $produk->stok}}">
                                                </div>
                                                <div class="mb-3">
                                                    <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 2 MB</div>
                                                    <input type="file" class="form-control-file align-items-center" id="berkas" name="berkas" value="{{ old('gambar') ?? $produk->gambar}}">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="telp" class="form-label">Deskripsi</label>
                                                    <input type="textarea" class="form-control" name="deskripsi" id="deskripsi" value="{{ old('deskripsi') ?? $produk->deskripsi}}">
                                                </div>
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save changes</button>
                                            </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-danger btn-just-icon btn-sm" data-bs-toggle="modal" data-bs-target="#delete-{{$produk->id}}">
                                    <i class="fa fa-trash"></i>
                                </button>
                                <!-- Modal -->
                                <div class="modal fade" id="delete-{{$produk->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>You want to delete this produk?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <form action="{{ route('produk.destroy',
                                                ['produk'=>$produk->id]) }}" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-danger btn-just-icon btn-sm" data-bs-toggle="modal" data-bs-target="#delete">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
