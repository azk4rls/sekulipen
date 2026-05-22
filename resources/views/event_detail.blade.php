@extends('layouts.app')
@section('title', $event->title)

@section('content')
<div class="container mb-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-sm border-0">
                @if($event->poster)
                    <img src="{{ asset('storage/'.$event->poster) }}" class="card-img-top w-100" 
                         style="max-height: 500px; object-fit: cover;" alt="Poster {{ $event->title }}">
                @else
                    <div class="card-img-top bg-secondary d-flex justify-content-center align-items-center text-white w-100" 
                         style="height: 300px;">
                        <span>Tanpa Poster</span>
                    </div>
                @endif

                <div class="card-body p-4">
                    <span class="badge bg-info text-dark mb-3 px-3 py-2">
                        {{ $event->category->name }}
                    </span>
                    
                    <h2 class="fw-bold mb-4">{{ $event->title }}</h2>
                    
                    <div class="row mb-4 bg-light p-3 rounded">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <h6 class="text-muted fw-bold mb-2">Tanggal & Waktu</h6>
                            <p class="mb-0 fs-5">
                                <i class="bi bi-calendar-event text-primary me-2"></i> 
                                {{ date('d F Y', strtotime($event->event_date)) }}
                            </p>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-muted fw-bold mb-2">Lokasi & Kuota</h6>
                            <p class="mb-1">
                                <i class="bi bi-geo-alt text-primary me-2"></i> {{ $event->location }}
                            </p>
                            <p class="mb-0">
                                <i class="bi bi-people text-primary me-2"></i> {{ $event->quota }} Peserta
                            </p>
                        </div>
                    </div>

                    <h5 class="fw-bold border-bottom pb-2 mb-3">Deskripsi Acara</h5>
                    <div class="text-dark" style="white-space: pre-line; line-height: 1.6;">
                        {{ $event->description }}
                    </div>

                    <div class="mt-4 text-center">
                        <a href="/" class="btn btn-outline-secondary px-4">
                            Kembali ke Katalog
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
