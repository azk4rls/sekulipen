@extends('layouts.app')
@section('title', 'Tambah Acara')

@section('content')
<div class="container mb-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Tambah Data Acara</h5>
                </div>
                
                <div class="card-body">
                    <form action="/event/store" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Kategori Acara</label>
                            <select name="category_id" class="form-select" required>
                                <option value="" disabled selected>-- Pilih Kategori --</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Judul Acara</label>
                            <input type="text" class="form-control" name="title" required>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label class="form-label">Tanggal</label>
                                <input type="date" name="event_date" class="form-control" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Lokasi</label>
                                <input type="text" name="location" class="form-control" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Kuota</label>
                                <input type="number" name="quota" class="form-control" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Deskripsi</label>
                            <textarea name="description" class="form-control" rows="4" required></textarea>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Poster Acara (Maks. 2MB)</label>
                            <img class="img-preview img-fluid mb-3 col-sm-5" style="display: none; max-height: 250px;">
                            <input type="file" class="form-control" id="poster" name="poster" accept="image/*" onchange="previewImage()">
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="/events" class="btn btn-secondary">Batal</a>
                            <button type="submit" class="btn btn-primary">Simpan Data</button>
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
        const imgPreview = document.querySelector('.img-preview');
        
        imgPreview.style.display = 'block';
        const oFReader = new FileReader();
        oFReader.readAsDataURL(image.files[0]);
        
        oFReader.onload = function(oFREvent) { 
            imgPreview.src = oFREvent.target.result; 
        }
    }
</script>
@endsection