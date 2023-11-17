@extends('layout.template')
@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Pegawai</h3>
            </div>
        </div>
    </div>
    <section class="section">
        <div>
            @if(session('success'))
            <p class="alert alert-success">{{ session('success') }}</p>
            @endif
            @if($errors->any())
            @foreach($errors->all() as $err)
            <p class="alert alert-danger">{{ $err }}</p>
            @endforeach
            @endif
        </div>
        <div class="card">
            <div class="card-body">
                <!-- Button trigger modal -->
                <div class="mb-2">
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalAdd">
                        <div class="fas fa-plus"></div>
                        Tambah data
                    </button>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Nama bagian</th>
                                <th class="text-center">Nama pegawai</th>
                                <th class="text-center">Kontak WA</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            @foreach($data as $val)
                            <tr class="text-center">
                                <td><?= $i++ ?></td>
                                <td>{{$val->JoinToBagian->bagian}}</td>
                                <td>{{$val->nama}}</td>
                                <td>{{$val->kontak_wa}}</td>
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <div class="col-md-6 col-lg-4 col-sm-6">
                                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#ModalEdit{{$val->pegawai_id}}">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        </div>
                                        <div class="col-md-6 col-lg-4 col-sm-6">
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#ModalHapus{{$val->pegawai_id}}">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Modal add-->
<div class="modal fade" id="modalAdd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah data</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/addpegawai" method="post">
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col-12 mt-1">
                            <h6>Nama bagian</h6>
                            <fieldset class="form-group">
                                <select name="bagian_id" id="basicSelect" class="form-select">
                                    <option selected>pilih nama bagian</option>
                                    @foreach($bagian as $row)
                                    <option value="{{$row->bagian_id}}">{{$row->bagian}}</option>
                                    @endforeach
                                </select>
                            </fieldset>
                        </div>
                        <div class="col-12 mt-1">
                            <h6>Nama pegawai</h6>
                            <input class="form-control" type="text" name="nama" placeholder="nama pegawai" aria-label="default input example">
                        </div>
                        <div class="col-12 mt-1">
                            <h6>Kontak WA</h6>
                            <input class="form-control" type="text" name="kontak_wa" placeholder="kontak wa" aria-label="default input example">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

@foreach($data as $val)
<!-- Modal update-->
<div class="modal fade" id="ModalEdit{{$val->pegawai_id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Update data</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/updatepegawai" method="post">
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <input type="hidden" name="pegawai_id" value="{{$val->pegawai_id}}" class="form-control">
                        <div class="col-12 mt-1">
                            <h6>Nama bagian</h6>
                            <fieldset class="form-group">
                                <select name="bagian_id" id="basicSelect" class="form-select">
                                    <option value="{{$val->bagian_id}}" selected>{{$val->JoinToBagian->bagian}}</option>

                                    @foreach($bagian as $row)
                                    <option value="{{$row->bagian_id}}">{{$row->bagian}}</option>
                                    @endforeach
                                </select>
                            </fieldset>
                        </div>
                        <div class="col-12 mt-1">
                            <h6>Nama pegawai</h6>
                            <input class="form-control" type="text" name="nama" value="{{$val->nama}}" aria-label="default input example">
                        </div>
                        <div class="col-12 mt-1">
                            <h6>Kontak WA</h6>
                            <input class="form-control" type="text" name="kontak_wa" value="{{$val->kontak_wa}}" aria-label="default input example">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- modal hapus -->
<div class="modal fade" id="ModalHapus{{$val->pegawai_id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus data</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Yakin ingin menghapus data ini..?</p>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Close</button>
                <a href="/deletepegawai/{{$val->pegawai_id}}" class="btn btn-danger">Delete</a>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection