@extends('app')

@section('isi')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2><b>Laporan Arus Kas</b></h2>
                </div>
            </div>
        </div>

        <form action="{{ route('aruskas.index') }}" method="GET">
            <table class="table">
                <tr>
                    <th>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <label>Periode</label>
                                    <input type="month" class="form-control" name="bulan_tahun"
                                        placeholder="Bulan dan Tahun" value="{{ $periode }}">
                                    <button type="submit" class="btn btn-primary">Cari</button>
                                </div>
                            </div>
                        </div>
                    </th>
                </tr>
            </table>
        </form>

        <table width="1000" height="600" border="0" style="margin-left: 35px">
            <tr>
                <td colspan="3" bgcolor="#C3C6FF">
                    <div align="center"><strong>Laporan Arus Kas</strong></div>
                </td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>
                    <div align="center"></div>
                </td>
                <td>
                    <div align="center"></div>
                </td>
            </tr>
            <tr>
                <td width="396" bgcolor="#C3C6FF"><strong>Arus kas dari aktivitas operasi</strong></td>
                <td width="140" bgcolor="#C3C6FF">
                    <div align="center"></div>
                </td>
                <td width="143" bgcolor="#C3C6FF">
                    <div align="center"></div>
                </td>
            </tr>
            <tr>
                <td>Penerimaan dari pelanggan</td>
                <td>
                    <div align="center">Rp {{ number_format($operasional, 2) }}</div>
                </td>
                <td>
                    <div align="center"></div>
                </td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>
                    <div align="center"></div>
                </td>
                <td>
                    <div align="center"></div>
                </td>
            </tr>
            <tr>
                <td bgcolor="#C3C6FF"><strong>Pembayaran kas aktivitas operasi</strong></td>
                <td bgcolor="#C3C6FF">
                    <div align="center"></div>
                </td>
                <td bgcolor="#C3C6FF">
                    <div align="center"></div>
                </td>
            </tr>
            <tr>
                <td>Pembayaran gaji</td>
                <td>
                    <div align="center">(Rp {{ number_format(abs($operasional), 2) }})</div>
                </td>
                <td>
                    <div align="center"></div>
                </td>
            </tr>
            <tr>
                <td>Pembayaran untuk beban operasi</td>
                <td>
                    <div align="center">(Rp {{ number_format(abs($operasional), 2) }})</div>
                </td>
                <td>
                    <div align="center"></div>
                </td>
            </tr>
        </table>
    </div>
@endsection
