@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')

<section class="section">
    <div class="section-header">
        <h1>Broadcast Email</h1>
    </div>

    <div class="section-body">

        <!-- Tampilkan Pesan Sukses -->
        @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
        @endif

        <!-- Tampilkan Error -->
        @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
            <li style="color: red;">{{ $error }}</li>
            @endforeach
        </ul>
        @endif


        <!-- Form Upload -->
        <form action="{{ route('tickets.import') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="section-title">Masukkan Data Excel</div>
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="customFile" name="excel_file" required>
                <label class="custom-file-label" for="customFile">Choose file</label>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Upload</button>
        </form>


        <form id="delete-form" action="{{ route('tickets.deleteMultiple') }}" method="POST">
            @csrf
            @method('DELETE')

            <div class="card-body">
                <div class="d-flex justify-content-end mb-3">
                    @if ($tickets->isEmpty())
                    <a href="#" class="btn btn-primary disabled">
                        <i class="fas fa-paper-plane"></i> Broadcast Email ke Semua Peserta
                    </a>
                    @else
                    <a href="{{ route('tickets.broadcast') }}" class="btn btn-primary">
                        <i class="fas fa-paper-plane"></i> Broadcast Email ke Semua Peserta
                    </a>
                    @endif

                    <button type="button" class="btn btn-danger ml-2" onclick="confirmDelete()">
                        <i class="fas fa-trash"></i> Hapus Terpilih
                    </button>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped" id="table-2">
                        <thead>
                            <tr>
                                <th class="text-center">
                                    <div class="custom-checkbox custom-control">
                                        <input type="checkbox" id="checkbox-all">

                                    </div>
                                </th>
                                <th>No</th>
                                <th>Nomor BIB</th>
                                <th>Nama</th>
                                <th>Kategori</th>
                                <th>Ukuran Jersey</th>
                                <th>Nomor Handphone</th>
                                <th>Alamat Email</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($tickets as $index => $ticket)
                            <tr>
                                <td>
                                    <div class="custom-checkbox custom-control">
                                        <input type="checkbox" name="ids[]" value="{{ $ticket->id }}" class="custom-control-input checkbox-item" id="checkbox-{{ $index }}">
                                        <label for="checkbox-{{ $index }}" class="custom-control-label">&nbsp;</label>
                                    </div>
                                </td>
                                <td>{{ ($tickets->currentPage() - 1) * $tickets->perPage() + $index + 1 }}</td>
                                <td>{{ $ticket->bib_number }}</td>
                                <td>{{ $ticket->name }}</td>
                                <td>{{ $ticket->category }}</td>
                                <td>{{ $ticket->jersey_size }}</td>
                                <td>{{ $ticket->phone_number }}</td>
                                <td>{{ $ticket->email }}</td>
                                <td>
                                    <a href="{{ route('tickets.edit', $ticket->id) }}" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                </td>


                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" style="text-align: center;">Tidak ada data tiket.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <!-- Kontrol paginasi -->
                <div class="d-flex justify-content-end mt-3">
                    {{ $tickets->links() }}
                </div>
            </div>
        </form>

        <script>
            // Fungsi untuk memilih semua checkbox
            document.getElementById('checkbox-all').addEventListener('change', function() {
                let checkboxes = document.querySelectorAll('.checkbox-item');
                checkboxes.forEach((checkbox) => {
                    checkbox.checked = this.checked;
                });
            });

            // Konfirmasi penghapusan data
            function confirmDelete() {
                if (confirm('Apakah Anda yakin ingin menghapus tiket yang dipilih?')) {
                    document.getElementById('delete-form').submit();
                }
            }
        </script>


    </div>
</section>

@endsection