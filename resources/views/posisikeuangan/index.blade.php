@extends('app')

@section('isi')
    <div class="container">
        <h1>Laporan Posisi Keuangan</h1>
        <div class="card-body p-4">
            <div class="table-responsive">
                <table class="table table-hover table-striped table-md">
                    <thead>
                        <tr>
                            <th>AKTIVA</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Aktiva Lancar -->
                        @php
                            $aktiva_lancar = 0;
                            $nama_akun2 = '';
                            $nama_akun3 = '';
                        @endphp

                        @foreach ($groupedData as $kodeAkun => $rows)
                            @foreach ($rows as $row)
                                @if (
                                    $row->nama_akun2 == 'Aset' ||
                                        $row->nama_akun2 == 'Piutang dan Pajak' ||
                                        $row->nama_akun2 == 'Persediaan' ||
                                        $row->nama_akun2 == 'Pengeluaran Dibayar Dimuka' ||
                                        $row->nama_akun2 == 'Aset Tetap' ||
                                        $row->nama_akun2 == 'Penyusutan' ||
                                        $row->nama_akun2 == 'Aset Lain-lain' ||
                                        $row->nama_akun2 == 'Liabilitas' ||
                                        $row->nama_akun2 == 'Pajak' ||
                                        $row->nama_akun2 == 'Pendapatan Diterima Dimuka' ||
                                        $row->nama_akun2 == 'Liabilitas Jangka Panjang' ||
                                        $row->nama_akun2 == 'Modal Akhir' ||
                                        $row->nama_akun2 == 'Ikhtisar Laba Rugi' ||
                                        $row->nama_akun3 == 'Kas')
                                    @php
                                        $aktiva_lancar += $row->kredit;
                                        $nama_akun2 = $row->nama_akun2;
                                        $nama_akun3 = $row->nama_akun3;
                                    @endphp

                                    <tr>
                                        <td class="text-left" style="padding-left: 3em;">{{ $nama_akun2 }}</td>
                                        <td></td>
                                        <td class="text-right">{{ $aktiva_lancar }}</td>
                                    </tr>
                                @endif
                            @endforeach

                            @php
                                $aktiva_lancar = 0; // Mengatur kembali nilai $aktiva_lancar menjadi 0 setelah satu kelompok akun selesai
                            @endphp
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
