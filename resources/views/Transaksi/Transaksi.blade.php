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
                    <h3 class="card-title">Formulir Transaksi</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ route('form.submit.transaksi') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-group" data-select2-id="29">
                            <label>Pasien</label>
                            <select name="pasien" class="form-control select2 select2-hidden-accessible"
                                style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                @foreach ($patients as $patient)
                                    <option value="{{ $patient->id }}">{{ $patient->pasien->nama_pasien }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group" data-select2-id="29">
                            <label>Resep Obat</label>
                            <select name="resep" class="form-control select2 select2-hidden-accessible"
                                style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                @foreach ($resep as $item)
                                    <option value="{{ $item->id }}">
                                        @foreach ($obat as $meds)
                                            @if ($meds->id_resep_obat == $item->id)
                                                {{ $meds->obat->nama_obat }},
                                            @endif
                                        @endforeach
                                        {{ $item->pasien->pasien->nama_pasien }} | Sesi: {{ $item->pasien->tanggal_sesi }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Tanggal</label>
                            <input name="date" type="date" class="form-control" id="exampleInputPassword1"
                                placeholder="Password">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Total Harga</label>
                            <input name="total" type="number" class="form-control" id="exampleInputPassword1"
                                placeholder="Total Harga">
                        </div>
                        <!-- /.card-body -->
                        <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </section>
@endsection
