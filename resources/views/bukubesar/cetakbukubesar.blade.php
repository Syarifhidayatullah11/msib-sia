@extends('app')

@section('isi')
    <section class="content">
        <div class="container-fluid">
            @foreach ($groupedData as $kodeAkun => $rows)
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-sm-6">
                                <h3 class="card-title">Kode Akun: {{ $kodeAkun }}</h3>
                            </div>
                            <div class="col-sm-6 text-right">
                                <h3 class="card-title">Nama Akun: {{ $rows[0]->nama_akun3 }}</h3>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Kode Voucher</th>
                                    <th>Debit</th>
                                    <th>Kredit</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rows as $row)
                                    <tr>
                                        <td>{{ $row->tanggal }}</td>
                                        <td>{{ $row->kode_voucher }}</td>
                                        <td>{{ $row->debit }}</td>
                                        <td>{{ $row->kredit }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            @endforeach
        </div>
        <!-- /.container-fluid -->
    </section>
@endsection