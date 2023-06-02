@extends('layouts.Sidebar')

@section('content')
    <section class="content" style="padding-top: 20px">
        <div class="container-fluid">

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
                    <h3 class="card-title">Formulir Diagnosa</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ route('form.submit.sesi') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-group" data-select2-id="29">
                            <label>Pasien</label>
                            <select name="pasien" class="form-control select2 select2-hidden-accessible"
                                style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                @foreach ($patients as $patient)
                                    <option value="{{ $patient->id }}">{{ $patient->nama_pasien }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group" data-select2-id="29">
                            <label>Dokter</label>
                            <select name="dokter" class="form-control select2 select2-hidden-accessible"
                                style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                @foreach ($doctors as $doctor)
                                    <option value="{{ $doctor->id }}">{{ $doctor->nama_dokter }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Tanggal</label>
                            <input name="date" type="date" class="form-control" id="exampleInputPassword1"
                                placeholder="Password" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Deskripsi</label>
                            <textarea name="description" class="form-control" rows="3" placeholder="Deskripsi sesi...." required></textarea>
                        </div>

                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
