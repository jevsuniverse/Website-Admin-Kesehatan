@extends('layouts.Sidebar')

@section('content')
    <section class="content" style="padding-top: 15px">
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

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header bg-info">
                            <h3 class="card-title">List Sesi</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="datatable" class="table table-head-fixed text-nowrap table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Pasien</th>
                                        <th>Nama Dokter</th>
                                        <th>Deskripsi Diagnosa</th>
                                        <th>Tanggal Sesi</th>
                                        <th>Status</th>
                                        <td>Action</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $item)
                                        <tr>
                                            <td>{{ $item->id_sesi }}</td>
                                            <td>{{ $item->pasien->nama_pasien }}</td>
                                            <td>{{ $item->dokter->nama_dokter }}</td>
                                            <td>{{ $item->deskripsi_hasil }}</td>
                                            <td>{{ $item->tanggal_sesi }}</td>
                                            <td>
                                                @if ($item->status_sesi == 'Approved')
                                                    <small class="badge badge-success">
                                                        {{ $item->status_sesi }}
                                                    </small>
                                                @elseif($item->status_sesi == 'On Progress')
                                                    <small class="badge badge-primary">
                                                        {{ $item->status_sesi }}
                                                    </small>
                                                @else
                                                    <small class="badge badge-warning">
                                                        {{ $item->status_sesi }}
                                                    </small>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('edit.sesi', $item->id) }}" class="btn btn-info">
                                                    <i class="fa fa-pencil"></i>
                                                </a>
                                                <form action="{{ route('destroy.sesi', $item->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    <button class="btn btn-danger">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>

    <script type="text/javascript">
        $(function() {
            $("#datatable").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
            }).buttons().container().appendTo('#datatable_wrapper .col-md-6:eq(0)');
        });
    </script>
@endsection
