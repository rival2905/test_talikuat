@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="card shadow-lg rounded-5 border-0">
        <div class="card-body p-4">
            <h4 class="mb-4 fw-bold" style="letter-spacing: 0.5px;">{{ $action == 'store' ? 'Tambah Kategori' : 'Edit Kategori' }}</h4>

            @if($action == 'store')
            <form action="{{ route('admin.category.store') }}" method="POST" enctype="multipart/form-data">
            @else
            <form action="{{ route('admin.category.update', $data->id) }}" method="POST" enctype="multipart/form-data">
                @method('PUT')
            @endif
                @csrf
                
                <div class="mb-3 form-floating">
                    <input type="text" name="code" value="{{ old('code', @$data->code) }}" 
                           class="form-control shadow-sm @error('code') is-invalid @enderror rounded-4" 
                           id="code" placeholder="Code Kategori">
                    <label for="code">Code Kategori</label>
                    @error('code')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror 
                </div>

                <div class="mb-3 form-floating">
                    <input type="text" name="name" value="{{ old('name', @$data->name) }}" 
                           class="form-control shadow-sm @error('name') is-invalid @enderror rounded-4" 
                           id="name" placeholder="Nama Kategori">
                    <label for="name">Nama Kategori</label>
                    @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror 
                </div>

                <div class="mb-4 form-floating">
                    <select name="parent_id" id="parent_id" class="form-select shadow-sm rounded-4">
                        <option value="">-- Pilih Category --</option>
                        @foreach($document_categories as $category)
                            <option value="{{ $category->id }}" @if(@$data->parent_id == $category->id) selected @endif>{{ $category->name }}</option>
                        @endforeach
                    </select>
                    <label for="parent_id">Parent Kategori</label>
                </div>

                <div class="d-flex gap-2">
                    <button class="btn btn-primary btn-lg rounded-pill shadow-sm" type="submit" 
                            style="background: linear-gradient(90deg,#4e54c8,#8f94fb); border:none; transition: transform 0.2s;">
                        <i class="fa fa-paper-plane me-1"></i> Save
                    </button>
                    <button class="btn btn-warning btn-lg rounded-pill shadow-sm" type="reset" 
                            style="transition: transform 0.2s;">
                        <i class="fa fa-redo me-1"></i> Reset
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Optional: animasi hover tombol
    const buttons = document.querySelectorAll('.btn');
    buttons.forEach(btn => {
        btn.addEventListener('mouseenter', () => btn.style.transform = 'scale(1.05)');
        btn.addEventListener('mouseleave', () => btn.style.transform = 'scale(1)');
    });
</script>
@endsection
