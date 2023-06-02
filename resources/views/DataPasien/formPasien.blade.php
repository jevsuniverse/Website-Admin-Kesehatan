@extends('layouts.Sidebar')

@section('content')
    <section class="content" style="padding-top: 20px">
        <div class="container-fluid">
            @if (session('success_message'))
                <div class="alert alert-success">
                    {{ session('success_message') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Formulir pasien</h3>
                </div>
                <!-- /.card-header -->

                <!-- form start -->
                <form action="{{ route('form.submit') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-group" data-select2-id="29">
                            <label>Type</label>
                            <select name="type" class="form-control select2 select2-hidden-accessible"
                                style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                <option selected="selected" data-select2-id="3">Dokter</option>
                                <option data-select2-id="34">Pasien</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama</label>
                            <input name="name" type="text" class="form-control" id="exampleInputEmail1"
                                placeholder="Masukan Nama" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Email</label>
                            <input name="email" type="email" class="form-control" id="exampleInputPassword1"
                                placeholder="Masukan Email" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Nomor Telepon</label>
                            <input name="nohp" type="number" class="form-control" id="exampleInputPassword1"
                                placeholder="Masukan Nomer Hp" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Alamat</label>
                            <textarea name="alamat" class="form-control" rows="3" placeholder="Masukan Alamat" required></textarea>
                        </div>
                        <!-- /.card-body -->
                        <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </section>
@endsection
