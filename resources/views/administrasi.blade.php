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
                                <td>
                                    @foreach($val->JoinToKebutuhan as $row)
                                    {{$row->jenis_kebutuhan}}
                                    @enforeach
                                </td>
                                <td>{{$val->nama}}</td>
                                <td>{{$val->kontak_wa}}</td>
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
@endsection