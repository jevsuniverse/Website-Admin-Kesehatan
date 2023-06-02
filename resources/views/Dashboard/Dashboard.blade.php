@extends('layouts.Sidebar')

@section('content')
    <h1 style="font-family: system-ui; padding-left: 15px">Dashboard</h1>
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $pasien_count }}</h3>

                            <p>Total Pasien</p>
                        </div>
                        <div class="icon">
                            <i class="fa-solid fa-user-group" style="font-size: 80px"></i>
                        </div>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ $proses_count }}<sup style="font-size: 20px">%</sup></h3>

                            <p>proses penanganan</p>
                        </div>
                        <div class="icon">
                            <i class="fa-solid fa-user-doctor" style="font-size: 80px"></i>
                        </div>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $done_count }}</h3>

                            <p>Telah selesai</p>
                        </div>
                        <div class="icon">
                            <i class="fa-solid fa-user-check" style="font-size: 80px"></i>
                        </div>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{ $pending_count }}</h3>

                            <p>Menunggu penjadwalan </p>
                        </div>
                        <div class="icon">
                            <i class="fa-solid fa-user-clock" style="font-size: 80px"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header bg-info">
                            <h3 class="card-title">Sesi</h3>
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
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $item)
                                        <tr>
                                            <td>{{ $item->id }}</td>
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
                "pageLength": 5,
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });
    </script>
@endsection
