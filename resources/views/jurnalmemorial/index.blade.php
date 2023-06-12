@extends('app')

@section('isi')
    <h3><b>Jurnal Umum</b></h3>
    <div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <div class="mb-3">
                    <form action="{{ route('jurnalmemorial.index') }}" method="GET">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="tanggal_awal">Tanggal Awal:</label>
                                <input type="date" name="tanggal_awal" id="tanggal_awal" class="form-control"
                                    value="{{ request('tanggal_awal') }}">
                            </div>
                            <div class="col-md-4">
                                <label for="tanggal_akhir">Tanggal Akhir:</label>
                                <input type="date" name="tanggal_akhir" id="tanggal_akhir" class="form-control"
                                    value="{{ request('tanggal_akhir') }}">
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary">Filter</button>
                                <a href="{{ route('jurnalmemorial.cetak', ['tanggal_awal' => request('tanggal_awal'), 'tanggal_akhir' => request('tanggal_akhir')]) }}"
                                    class="btn btn-primary" target="_blank">Cetak</a>
                            </div>
                        </div>
                    </form>
                </div>
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th style="width: 10px; background-color: #f2f2f2;">#</th>
                            <th style="background-color: #f2f2f2;">Tanggal</th>
                            <th style="background-color: #f2f2f2;">Kode Voucher</th>
                            <th style="background-color: #f2f2f2;">Deskripsi</th>
                            <th style="background-color: #f2f2f2;">Kode Akun</th>
                            <th style="background-color: #f2f2f2;">Nama Akun</th>
                            <th style="text-align: right;">Debet</th>
                            <th style="text-align: right;">Kredit</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $results = $results->sortBy('Tanggal');
                            $nomor = 0;
                            $prevTanggal = null;
                            $prevVoucher = null;
                            $totalDebet = 0;
                            $totalKredit = 0;
                        @endphp
                        @foreach ($results as $index => $result)
                            @php
                                $nomor++;
                                $totalDebet += $result->Debet;
                                $totalKredit += $result->Kredit;
                            @endphp
                            <tr>
                                <td>{{ $nomor }}</td>
                                <td>{{ $result->Tanggal !== $prevTanggal ? $result->Tanggal : '-' }}</td>
                                <td>{{ $result->Kode_Voucher !== $prevVoucher ? $result->Kode_Voucher : '-' }}
                                </td>
                                <td>{{ $result->Deskripsi }}</td>
                                <td>{{ $result->Kode_Akun }}</td>
                                <td>{{ $result->Nama_Akun }}</td>
                                <td style="text-align: right;">{{ number_format($result->Debet, 0, ',', '.') }}
                                </td>
                                <td style="text-align: right;">
                                    {{ number_format($result->Kredit, 0, ',', '.') }}
                                </td>
                            </tr>
                            @php
                                $prevTanggal = $result->Tanggal;
                                $prevVoucher = $result->Kode_Voucher;
                            @endphp
                        @endforeach
                        <tr>
                            <td colspan="6" style="text-align: right;"><strong>Total</strong></td>
                            <td style="text-align: right;">
                                <strong>{{ number_format($totalDebet, 0, ',', '.') }}</strong>
                            </td>
                            <td style="text-align: right;">
                                <strong>{{ number_format($totalKredit, 0, ',', '.') }}</strong>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>
    </div>
@endsection
