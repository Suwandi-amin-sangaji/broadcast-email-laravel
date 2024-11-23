@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')

<section class="section">
    <div class="section-header">
        <h1>Dashboard</h1>
    </div>

    <div class="section-body">
        <div class="row">
            <!-- Total Peserta -->
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="far fa-user"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Peserta</h4>
                        </div>
                        <div class="card-body">
                            {{ $totalTickets }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tiket Berdasarkan Kategori -->
            @foreach ($ticketsByCategory as $category => $count)
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-danger">
                            <i class="fas fa-running"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>{{ $category }} Peserta</h4>
                            </div>
                            <div class="card-body">
                                {{ $count }}
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

@endsection
