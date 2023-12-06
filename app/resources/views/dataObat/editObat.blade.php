@extends('layouts.Sidebar')

@section('content')

    <section class="content" style="padding-top: 20px">
        <div class="container-fluid">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Edit {{ $obat->nama_obat }}</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama Obat</label>
                            <input value="{{ $obat->nama_obat }}" name="name" type="text" class="form-control" placeholder="Masukan Nama">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Harga</label>
                            <input value="{{ $obat->harga }}" name="price" type="number" class="form-control" placeholder="Masukan Harga">
                        </div>
                        <!-- /.card-body -->
                        <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </section>

@endsection
