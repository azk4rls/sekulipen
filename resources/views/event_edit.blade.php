@extends('layouts.app')
@section('title', 'Edit Data Acara')

@section('content')
<div class="container mb-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-warning">
                <div class="card-header bg-warning text-dark">
                    <h5 class="mb-0">Edit Data Acara</h5>
                </div>
                
                <div class="card-body">
                    <form action="/event/{{ $event->id }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label">Kategori Acara</label>
                            <select name="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
                                <option value="" disabled>Pilih Kategori</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" @selected($event->category_id == $category->id)>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Judul Acara</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                   name="title" value="{{ old('title', $event->title) }}" required>
                            @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label class="form-label">Tanggal</label>
                                <input type="date" name="event_date" 
                                       class="form-control @error('event_date') is-invalid @enderror" 
                                       value="{{ old('event_date', $event->event_date) }}" required>
                                @error('event_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Lokasi</label>
                                <input type="text" name="location" 
                                       class="form-control @error('location') is-invalid @enderror" 
                                       value="{{ old('location', $event->location) }}" required>
                                @error('location') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Kuota</label>
                                <input type="number" name="quota" 
                                       class="form-control @error('quota') is-invalid @enderror" 
                                       value="{{ old('quota', $event->quota) }}" required>
                                @error('quota') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Deskripsi</label>
                            <textarea name="description" class="form-control @error('description') is-invalid @enderror" 
                                      rows="4" required>{{ old('description', $event->description) }}</textarea>
                            @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Poster Acara (Opsional)</label>
                            <div class="mb-2">
                                @if($event->poster)
                                    <img src="{{ asset('storage/' . $event->poster) }}" id="img-preview" class="img-fluid col-sm-5 mb-2" style="max-height: 250px;">
                                @else
                                    <img class="img-fluid col-sm-5 mb-2" id="img-preview" style="display: none; max-height: 250px;">
                                @endif
                            </div>
                            <input type="file" class="form-control @error('poster') is-invalid @enderror" 
                                   id="poster" name="poster" accept="image/*" onchange="previewImage()">
                            <small class="text-muted">Abaikan jika tidak ingin mengganti poster.</small>
                            @error('poster') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="/events" class="btn btn-secondary">Batal</a>
                            <button type="submit" class="btn btn-warning text-dark">Update Data Acara</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function previewImage() {
        const image = document.querySelector('#poster');
        const imgPreview = document.querySelector('#img-preview');
        
        imgPreview.style.display = 'block';
        const oFReader = new FileReader();
        oFReader.readAsDataURL(image.files[0]);
        
        oFReader.onload = function(oFREvent) { 
            imgPreview.src = oFREvent.target.result; 
        }
    }
</script>
@endsection
