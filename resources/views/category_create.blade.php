@extends('layouts.app')
@section('title', 'Tambah Kategori')

@section('content')
<div class="container mb-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">Tambah Kategori Baru</h5>
                </div>
                <div class="card-body">
                    <form action="/dashboard/category/store" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <label class="form-label">Nama Kategori</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" required>
                            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label class="form-label">URL Slug</label>
                            <input type="text" name="slug" class="form-control @error('slug') is-invalid @enderror" required>
                            @error('slug') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        
                        <div class="d-flex justify-content-between">
                            <a href="/dashboard" class="btn btn-secondary">Batal</a>
                            <button type="submit" class="btn btn-success">Simpan Kategori</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection