@extends('app')

@section('isi')
    <div class="container">
        <h2>Tambah Transaksi</h2>
        <form action="{{ route('transaksi.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="kode_voucher">Kode Voucher:</label>
                <input type="text" name="kode_voucher" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="tanggal">Tanggal:</label>
                <input type="date" name="tanggal" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="deskripsi">Deskripsi:</label>
                <textarea name="deskripsi" class="form-control" required></textarea>
            </div>
            <div class="form-group">
                <label for="ket_jurnal">Keterangan Jurnal:</label>
                <textarea name="ket_jurnal" class="form-control" required></textarea>
            </div>
            <table class="table table-bordered" id="detail-table">
                <thead>
                    <tr>
                        <th>Kode Akun</th>
                        <th>Debit</th>
                        <th>Kredit</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <select name="kode_akun3[]" class="form-control" required>
                                <option value="">Pilih Akun</option>
                                @foreach ($akuns3 as $akun3)
                                    <option value="{{ $akun3->kode_akun3 }}">{{ $akun3->kode_akun3 }} |
                                        {{ $akun3->nama_akun3 }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <input type="number" name="debit[]" class="form-control" required>
                        </td>
                        <td>
                            <input type="number" name="kredit[]" class="form-control" required>
                        </td>
                        <td>
                            <select name="status_id[]" class="form-control" required>
                                <option value="">Pilih Status</option>
                                @foreach ($statuses as $statusku)
                                    <option value="{{ $statusku->id_status }}">{{ $statusku->status }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <button type="button" class="btn btn-danger remove-row">Hapus</button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <button type="button" class="btn btn-primary add-row">Tambah Baris</button>
            <button type="submit" class="btn btn-success">Simpan</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $(".add-row").click(function() {
                var markup = `
                    <tr>
                        <td>
                            <select name="kode_akun3[]" class="form-control" required>
                                <option value="">Pilih Akun</option>
                                @foreach ($akuns3 as $akun3)
                                    <option value="{{ $akun3->kode_akun3 }}">{{ $akun3->kode_akun3 }}  |  {{ $akun3->nama_akun3 }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <input type="number" name="debit[]" class="form-control" required>
                        </td>
                        <td>
                            <input type="number" name="kredit[]" class="form-control" required>
                        </td>
                        <td>
                            <select name="status_id[]" class="form-control" required>
                                <option value="">Pilih Status</option>
                                @foreach ($statuses as $statusku)
                                <option value="{{ $statusku->id_status }}">{{ $statusku->status }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <button type="button" class="btn btn-danger remove-row">Hapus</button>
                        </td>
                    </tr>
                `;
                $("#detail-table tbody").append(markup);
            });

            $("#detail-table").on("click", ".remove-row", function() {
                $(this).closest("tr").remove();
            });
        });
    </script>
@endsection