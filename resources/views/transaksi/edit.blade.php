@extends('app')

@section('isi')
    <div class="container">
        <h2>Edit Transaksi</h2>
        <form id="edit-form" action="{{ route('transaksi.update', $transaksi->id_transaksi) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="kode_voucher">Kode Voucher:</label>
                <input type="text" name="kode_voucher" class="form-control" value="{{ $transaksi->kode_voucher }}" required>
            </div>
            <div class="form-group">
                <label for="tanggal">Tanggal:</label>
                <input type="date" name="tanggal" class="form-control" value="{{ $transaksi->tanggal }}" required>
            </div>
            <div class="form-group">
                <label for="deskripsi">Deskripsi:</label>
                <textarea name="deskripsi" class="form-control" required>{{ $transaksi->deskripsi }}</textarea>
            </div>
            <div class="form-group">
                <label for="ket_jurnal">Keterangan Jurnal:</label>
                <textarea name="ket_jurnal" class="form-control" required>{{ $transaksi->ket_jurnal }}</textarea>
            </div>
            <table class="table table-bordered">
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
                    @foreach ($detailTransaksi as $index => $detail)
                        <tr>
                            <td>
                                <select name="kode_akun3[]" class="form-control" required>
                                    <option value="">Pilih Akun</option>
                                    @foreach ($akuns3 as $akun3)
                                        <option value="{{ $akun3->kode_akun3 }}"
                                            {{ $akun3->kode_akun3 == $detail->kode_akun3 ? 'selected' : '' }}>
                                            {{ $akun3->kode_akun3 }} | {{ $akun3->nama_akun3 }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>

                            <td>
                                <input type="number" name="debit[]" class="form-control" value="{{ $detail->debit }}"
                                    required>
                            </td>
                            <td>
                                <input type="number" name="kredit[]" class="form-control" value="{{ $detail->kredit }}"
                                    required>
                            </td>
                            <td>
                                <select name="status_id[]" class="form-control" required>
                                    <option value="">Pilih Status</option>
                                    @foreach ($statuses as $status)
                                        <option value="{{ $status->id_status }}"
                                            {{ $status->id_status == $detail->status_id ? 'selected' : '' }}>
                                            {{ $status->status }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                @if ($index === 0)
                                    <button type="button" class="btn btn-primary add-row">Tambah Baris</button>
                                @else
                                    <button type="button" class="btn btn-danger remove-row">Hapus</button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <button type="submit" class="btn btn-success">Simpan</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            $("table").on("click", ".add-row", function() {
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
                                @foreach ($statuses as $status)
                                    <option value="{{ $status->id_status }}">{{ $status->status }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <button type="button" class="btn btn-danger remove-row">Hapus</button>
                        </td>
                    </tr>
                `;
                $("table tbody").append(markup);
            });

            $("table").on("click", ".remove-row", function() {
                $(this).closest("tr").remove();
            });
        });
    </script>

    <!-- Include SweetAlert2 library -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.9/dist/sweetalert2.all.min.js"></script>

    <script>
        // When the form is submitted
        document.getElementById('edit-form').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent form submission

            // Display SweetAlert confirmation dialog
            Swal.fire({
                title: 'Simpan Perubahan?',
                text: 'Apakah Anda yakin ingin menyimpan perubahan ini?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Simpan',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // If user confirms, submit the form
                    document.getElementById('edit-form').submit();
                }
            });
        });
    </script>
@endsection
