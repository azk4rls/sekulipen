@extends('layouts.app')
@section('title', 'Edit Kategori')

@section('content')
<div class="container mb-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-warning">
                <div class="card-header bg-warning text-dark">
                    <h5 class="mb-0">Edit Kategori</h5>
                </div>
                <div class="card-body">
                    <form action="/kategori/{{ $category->id }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label class="form-label">Nama Kategori</label>
                            <input type="text" name="name" class="form-control" value="{{ $category->name }}" required>
                        </div>
                        
                        <div class="mb-4">
                            <label class="form-label">URL Slug</label>
                            <input type="text" name="slug" class="form-control" value="{{ $category->slug }}" required>
                        </div>
                        
                        <div class="d-flex justify-content-between">
                            <a href="/dashboard" class="btn btn-secondary">Batal</a>
                            <button type="submit" class="btn btn-warning text-dark">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection