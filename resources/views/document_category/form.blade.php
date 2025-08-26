@extends('layouts.app') @section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <div class="container">
                @if($action == 'store')
                <form action="{{ route('admin.category.store') }}" method="POST" enctype="multipart/form-data">
                @else
                <form action="{{ route('admin.category.update', $data->id) }}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @endif
                
                    @csrf
                    
                    <div class="form-group">
                        <label>Code</label>
                        <input type="text" name="code" value="{{ old('code', @$data->code) }}" placeholder="Masukkan Nama Kategoru" class="form-control @error('code') is-invalid @enderror">
                        @error('code')
                        <div class="invalid-feedback" style="display: block">
                            {{ $message }}
                        </div>
                        @enderror 
                    </div>
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" value="{{ old('name', @$data->name) }}" placeholder="Masukkan Nama Kategoru" class="form-control @error('name') is-invalid @enderror">
                        @error('name')
                        <div class="invalid-feedback" style="display: block">
                            {{ $message }}
                        </div>
                        @enderror 
                    </div>
                    <div class="form-group">
                        <label>Parent Kategori</label>
                        <select name="parent_id" class="form-select">
                            <option value="">-- Pilih Category --</option>
                            @foreach($document_categories as $category)
                                <option value="{{ $category->id }}" @if(@$data->parent_id == $category->id) selected @endif>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

    
                    <button class="btn btn-primary mr-1 btn-submit" type="submit"><i class="fa fa-paper-plane"></i>
                        Save</button>
                    <button class="btn btn-warning btn-reset" type="reset"><i class="fa fa-redo"></i> RESET</button>
    
                </form>
            </div>
        </div>
    </div>
</div>
@endsection 

@section('scripts')

@endsection