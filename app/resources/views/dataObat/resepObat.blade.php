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
                    <h3 class="card-title">Resep Obat</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ route('form.submit.resep') }}", method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-group" data-select2-id="29">
                            <label>Obat</label>
                            <div class="select2-blue">
                                <select class="select2" name="obat[]" multiple="multiple" data-placeholder="Pilih Obat"
                                    data-dropdown-css-class="select2-blue" style="width: 100%;" required>
                                    @foreach ($meds as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama_obat }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group" data-select2-id="29">
                            <label>Pasien</label>
                            <select name="pasien" class="form-control select" style="width: 100%;" data-select2-id="1"
                                tabindex="-1" aria-hidden="true">
                                @foreach ($patients as $item)
                                    <option value="{{ $item->id }}">{{ $item->pasien->nama_pasien }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">Keterangan</label>
                            <textarea name="keterangan" class="form-control" rows="3" placeholder="Deskripsi..."></textarea>
                        </div>

                        <!-- /.card-body -->
                        <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </section>

    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">

    <!-- Select2 -->
    <script src="{{ asset('AdminLTE/plugins/select2/js/select2.full.min.js') }}"></script>

    <script>
        $(function() {
            $('.select2').select2()
        })
    </script>

@endsection
