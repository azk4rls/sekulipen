@extends('layouts.app')

@section('title', 'Edit Data Acara')

@section('content')
<div class="container mt-4 mb-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
                <div class="card-header bg-warning py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 fw-bold text-dark">
                            <i class="bi bi-pencil-square me-2"></i>Edit Data Acara
                        </h5>
                        <a href="/dashboard" class="btn btn-sm btn-outline-dark rounded-pill">
                            <i class="bi bi-arrow-left me-1"></i>Kembali
                        </a>
                    </div>
                </div>
                
                <div class="card-body p-4">
                    <form action="/event/{{ $event->id }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- Section: Informasi Dasar --}}
                        <div class="mb-4">
                            <h6 class="text-uppercase text-muted fw-bold mb-3 small" style="letter-spacing: 1px;">Informasi Dasar</h6>
                            
                            <div class="mb-3">
                                <label class="form-label fw-bold">Kategori Acara</label>
                                <select name="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
                                    <option value="" disabled>Pilih Kategori</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" @selected($event->category_id == $category->id)>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Judul Acara</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                       name="title" value="{{ old('title', $event->title) }}" 
                                       placeholder="Masukkan judul acara..." required>
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Section: Detail Pelaksanaan --}}
                        <div class="mb-4">
                            <h6 class="text-uppercase text-muted fw-bold mb-3 small" style="letter-spacing: 1px;">Detail Pelaksanaan</h6>
                            
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label class="form-label fw-bold">Tanggal</label>
                                    <input type="date" name="event_date" 
                                           class="form-control @error('event_date') is-invalid @enderror" 
                                           value="{{ old('event_date', $event->event_date) }}" required>
                                    @error('event_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-bold">Lokasi</label>
                                    <input type="text" name="location" 
                                           class="form-control @error('location') is-invalid @enderror" 
                                           value="{{ old('location', $event->location) }}" 
                                           placeholder="Lokasi acara..." required>
                                    @error('location')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-bold">Kuota</label>
                                    <input type="number" name="quota" 
                                           class="form-control @error('quota') is-invalid @enderror" 
                                           value="{{ old('quota', $event->quota) }}" 
                                           placeholder="0" required>
                                    @error('quota')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">Deskripsi</label>
                            <textarea name="description" class="form-control @error('description') is-invalid @enderror" 
                                      rows="4" placeholder="Tuliskan deskripsi lengkap acara..." 
                                      required>{{ old('description', $event->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Section: Media --}}
                        <div class="mb-4">
                            <h6 class="text-uppercase text-muted fw-bold mb-3 small" style="letter-spacing: 1px;">Poster Acara</h6>
                            
                            <div class="card bg-light border-dashed p-3 text-center mb-3">
                                <div id="preview-container" class="mb-3 {{ $event->poster ? '' : 'd-none' }}">
                                    <img src="{{ $event->poster ? asset('storage/' . $event->poster) : '' }}" 
                                         id="img-preview" class="img-fluid rounded shadow-sm border" 
                                         style="max-height: 300px;">
                                    <p class="text-muted small mt-2">Pratinjau Poster</p>
                                </div>
                                
                                <div class="mt-2">
                                    <label for="poster" class="form-label small text-muted">Abaikan jika tidak ingin mengganti poster</label>
                                    <input type="file" class="form-control @error('poster') is-invalid @enderror" 
                                           id="poster" name="poster" accept="image/*" 
                                           onchange="previewImage()">
                                    @error('poster')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-warning fw-bold py-2 shadow-sm rounded-pill">
                                <i class="bi bi-save me-2"></i>Update Data Acara
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .border-dashed {
        border: 2px dashed #dee2e6;
    }
    .form-control:focus, .form-select:focus {
        border-color: #ffc107;
        box-shadow: 0 0 0 0.25rem rgba(255, 193, 7, 0.25);
    }
    .btn-warning:hover {
        background-color: #e0a800;
        border-color: #d39e00;
    }
</style>

<script>
    function previewImage() {
        const image = document.querySelector('#poster');
        const imgPreview = document.querySelector('#img-preview');
        const previewContainer = document.querySelector('#preview-container');
        
        if (image.files && image.files[0]) {
            previewContainer.classList.remove('d-none');
            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);
            oFReader.onload = function(oFREvent) { 
                imgPreview.src = oFREvent.target.result; 
            }
        }
    }
</script>
@endsection