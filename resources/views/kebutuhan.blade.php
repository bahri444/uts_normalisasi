@extends('layout.template')
@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Kebutuhan</h3>
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
                                <th class="text-center">Nama pegawai</th>
                                <th class="text-center">Jenis kebutuhan</th>
                                <th class="text-center">Kebuthan tentang</th>
                                <th class="text-center">Deskripsi kebutuhan</th>
                                <th class="text-center">Foto / video</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            @foreach($data as $val)
                            @foreach($val->JoinToKebutuhan as $row)
                            <tr class="text-center">
                                <td><?= $i++ ?></td>
                                <td>{{$myname->jenis_kebbutuhan}}</td>
                                <td>{{$val->jenis_kebutuhan}}</td>
                                <td>{{$val->kebutuhan_tentang}}</td>
                                <td>{{$val->deskripsi_kebutuhan}}</td>
                                <td>
                                    <img src="{{$val->foto_video}}" alt="404" width="60" height="60">
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <div class="col-md-6 col-lg-6 col-sm-6">
                                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#ModalEdit{{$val->kebutuhan_id}}">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        </div>
                                        <div class="col-md-6 col-lg-6 col-sm-6">
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#ModalHapus{{$val->kebutuhan_id}}">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
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
            <form action="/addkebutuhan" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col-12 mt-1">
                            <h6>Nama pegawai</h6>
                            <fieldset class="form-group">
                                <select name="pegawai_id" id="basicSelect" class="form-select">
                                    <option selected>pilih nama pegawai</option>
                                    @foreach($pegawai as $row)
                                    <option value="{{$row->pegawai_id}}">{{$row->nama}}</option>
                                    @endforeach
                                </select>
                            </fieldset>
                        </div>
                        <div class="col-12 mt-1">
                            <h6>Jenis kebutuhan</h6>
                            <fieldset class="form-group">
                                <select name="jenis_kebutuhan" id="basicSelect" class="form-select">
                                    <option selected>pilih nama pegawai</option>
                                    <option value="SIMRS">SIMRS</option>
                                    <option value="NON-SIMRS">NON-SIMRS</option>
                                </select>
                            </fieldset>
                        </div>
                        <div class="col-12 mt-1">
                            <h6>Kebutuhan tentang</h6>
                            <input class="form-control" type="text" name="kebutuhan_tentang" placeholder="kebutuhan tentang" aria-label="default input example">
                        </div>
                        <div class="col-12 mt-1">
                            <h6>Deskripsi tentang</h6>
                            <input class="form-control" type="text" name="deskripsi_kebutuhan" placeholder="deskripsi" aria-label="default input example">
                        </div>
                        <div class="col-12 mt-1">
                            <h6>Foto / video</h6>
                            <input class="form-control" type="file" name="foto_video" aria-label="default input example">
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
<div class="modal fade" id="ModalEdit{{$val->kebutuhan_id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Update data</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/updatekebutuhan" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <input type="hidden" name="kebutuhan_id" value="{{$val->kebutuhan_id}}" class="form-control">
                        <div class="col-12 mt-1">
                            <h6>Nama bagian</h6>
                            <fieldset class="form-group">
                                <select name="pegawai_id" id="basicSelect" class="form-select">
                                    <option value="{{$val->pegawai_id}}" selected>
                                        @foreach($val->JoinToPegawai as $myname)
                                        {{$myname->nama}}
                                        @endforeach
                                    </option>
                                    @foreach($pegawai as $row)
                                    <option value="{{$row->pegawai_id}}">{{$row->nama}}</option>
                                    @endforeach
                                </select>
                            </fieldset>
                        </div>
                        <div class="col-12 mt-1">
                            <h6>Jenis kebutuhan</h6>
                            <fieldset class="form-group">
                                <select name="jenis_kebutuhan" id="basicSelect" class="form-select">
                                    <option value="{{$val->jenis_kebutuhan}}" selected>{{$val->jenis_kebutuhan}}</option>
                                    <option value="SIMRS">SIMRS</option>
                                    <option value="NON-SIMRS">NON-SIMRS</option>
                                </select>
                            </fieldset>
                        </div>
                        <div class="col-12 mt-1">
                            <h6>Kebutuhan tentang</h6>
                            <input class="form-control" type="text" name="kebutuhan_tentang" value="{{$val->kebutuhan_tentang}}" aria-label="default input example">
                        </div>
                        <div class="col-12 mt-1">
                            <h6>Deskripsi tentang</h6>
                            <input class="form-control" type="text" name="deskripsi_kebutuhan" value="{{$val->deskripsi_kebutuhan}}" aria-label="default input example">
                        </div>
                        <div class="col-12 mt-1">
                            <h6>Foto / video</h6>
                            <input class="form-control" type="file" name="foto_video" value="{{$val->foto_video}}" aria-label="default input example">
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
<div class="modal fade" id="ModalHapus{{$val->kebutuhan_id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                <a href="/deletekebutuhan/{{$val->kebutuhan_id}}" class="btn btn-danger">Delete</a>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection