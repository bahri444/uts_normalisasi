@extends('layout.template')
@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Administrasi</h3>
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
                                <th class="text-center">Jenis kebutuhan</th>
                                <th class="text-center">Urgenci</th>
                                <th class="text-center">Kategori</th>
                                <th class="text-center">Progres</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            @foreach($data as $val)
                            @foreach($val->JoinToKebutuhan as $row)
                            <tr class="text-center">
                                <td><?= $i++ ?></td>
                                <td>{{$row->jenis_kebutuhan}}</td>
                                <td>{{$val->urgenci}}</td>
                                <td>{{$val->kategori}}</td>
                                <td>{{$val->progres}}</td>
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <div class="col-md-6 col-lg-4 col-sm-6">
                                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#ModalEdit{{$val->administrasi_id}}">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        </div>
                                        <div class="col-md-6 col-lg-4 col-sm-6">
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#ModalHapus{{$val->administrasi_id}}">
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
            <form action="/addadministrasi" method="post">
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col-12 mt-1">
                            <h6>Jenis kebutuhan</h6>
                            <fieldset class="form-group">
                                <select name="kebutuhan_id" id="basicSelect" class="form-select">
                                    <option selected>pilih jenis kebutuhan</option>
                                    @foreach($kebutuhan as $row)
                                    <option value="{{$row->kebutuhan_id}}">{{$row->jenis_kebutuhan}}</option>
                                    @endforeach
                                </select>
                            </fieldset>
                        </div>
                        <div class="col-12 mt-1">
                            <h6>Urgenci</h6>
                            <fieldset class="form-group">
                                <select name="urgenci" id="basicSelect" class="form-select">
                                    <option selected>pilih urgenci</option>
                                    <option value="urgent">Urgent</option>
                                    <option value="medium">Medium</option>
                                    <option value="low">Low</option>
                                </select>
                            </fieldset>
                        </div>
                        <div class="col-12 mt-1">
                            <h6>Kategori</h6>
                            <input class="form-control" type="text" name="kategori" placeholder="kategori" aria-label="default input example">
                        </div>
                        <div class="col-12 mt-1">
                            <h6>Progres</h6>
                            <fieldset class="form-group">
                                <select name="progres" id="basicSelect" class="form-select">
                                    <option selected>pilih progres</option>
                                    <option value="dipelajari">Dipelajari</option>
                                    <option value="dikerjakan">Dikerjakan</option>
                                    <option value="selesai">Selesai</option>
                                    <option value="dicanangkan">Dicanangkan</option>
                                </select>
                            </fieldset>
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
<div class="modal fade" id="ModalEdit{{$val->administrasi_id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Update data</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/updateadministrasi" method="post">
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <input type="hidden" name="administrasi_id" value="{{$val->administrasi_id}}" class="form-control">
                        <div class="col-12 mt-1">
                            <h6>Jenis kebutuhan</h6>
                            <fieldset class="form-group">
                                <select name="kebutuhan_id" id="basicSelect" class="form-select">
                                    @foreach($val->JoinToKebutuhan as $new)
                                    <option value="{{$val->kebutuhan_id}}" selected>{{$new->jenis_kebutuhan}}</option>
                                    @endforeach
                                    @foreach($kebutuhan as $row)
                                    <option value="{{$row->kebutuhan_id}}">{{$row->jenis_kebutuhan}}</option>
                                    @endforeach
                                </select>
                            </fieldset>
                        </div>
                        <div class="col-12 mt-1">
                            <h6>Urgenci</h6>
                            <fieldset class="form-group">
                                <select name="urgenci" id="basicSelect" class="form-select">
                                    <option value="{{$val->urgenci}}" selected>{{$val->urgenci}}</option>
                                    <option value="urgent">Urgent</option>
                                    <option value="medium">Medium</option>
                                    <option value="low">Low</option>
                                </select>
                            </fieldset>
                        </div>
                        <div class="col-12 mt-1">
                            <h6>Kategori</h6>
                            <input class="form-control" type="text" name="kategori" value="{{$val->kategori}}" placeholder="kategori" aria-label="default input example">
                        </div>
                        <div class="col-12 mt-1">
                            <h6>Progres</h6>
                            <fieldset class="form-group">
                                <select name="progres" id="basicSelect" class="form-select">
                                    <option value="{{$val->progres}}" selected>{{$val->progres}}</option>
                                    <option value="dipelajari">Dipelajari</option>
                                    <option value="dikerjakan">Dikerjakan</option>
                                    <option value="selesai">Selesai</option>
                                    <option value="dicanangkan">Dicanangkan</option>
                                </select>
                            </fieldset>
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

<!-- modal hapus -->
<div class="modal fade" id="ModalHapus{{$val->administrasi_id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                <a href="/deleteadministrasi/{{$val->administrasi_id}}" class="btn btn-danger">Delete</a>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection