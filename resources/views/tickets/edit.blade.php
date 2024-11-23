@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Edit Data</h1>
    </div>

    <div class="section-body">

        <div class="section-title">Edit Data Tiket</div>
        <form action="{{ route('tickets.update', $ticket->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label>Nomor BIB</label>
                <input type="text" class="form-control" name="bib_number" value="{{ $ticket->bib_number }}" required>
            </div>
            <div class="form-group">
                <label>Nama</label>
                <input type="text" class="form-control" name="name" value="{{ $ticket->name }}" required>
            </div>
            <div class="form-group">
                <label>Kategori</label>
                <input type="text" class="form-control" name="category" value="{{ $ticket->category }}" required>
            </div>
            <div class="form-group">
                <label>Ukuran Jersey</label>
                <input type="text" class="form-control" name="jersey_size" value="{{ $ticket->jersey_size }}" required>
            </div>
            <div class="form-group">
                <label>Nomor Handphone</label>
                <input type="text" class="form-control" name="phone_number" value="{{ $ticket->phone_number }}" required>
            </div>
            <div class="form-group">
                <label>Alamat Email</label>
                <input type="email" class="form-control" name="email" value="{{ $ticket->email }}" required>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Update</button>
            <a href="{{ route('tickets.index') }}" class="btn btn-secondary mt-3">Kembali</a>
        </form>
    </div>
</section>
@endsection