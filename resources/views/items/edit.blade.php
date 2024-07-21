@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Item</h1>
    <form action="{{ route('items.update', $item) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <!-- Left Column -->
            <div class="col-md-6">
                <div class="form-group mt-3">
                    <label for="category_id">Category</label>
                    <select id="category_id" name="category_id" class="form-control @error('category_id') is-invalid @enderror" required>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $item->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group mt-3">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $item->name) }}" required>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group mt-3">
                    <label for="sku">SKU</label>
                    <input type="text" id="sku" name="sku" class="form-control @error('sku') is-invalid @enderror" value="{{ old('sku', $item->sku) }}" required>
                    @error('sku')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group mt-3">
                    <label for="description">Description</label>
                    <textarea id="description" name="description" class="form-control @error('description') is-invalid @enderror">{{ old('description', $item->description) }}</textarea>
                    @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <!-- Right Column -->
            <div class="col-md-6">
                <div class="form-group mt-3">
                    <label for="price">Price</label>
                    <input type="number" id="price" name="price" class="form-control @error('price') is-invalid @enderror" step="0.01" value="{{ old('price', $item->price) }}" required>
                    @error('price')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group mt-3">
                    <label for="count">Count</label>
                    <input type="number" id="count" name="count" class="form-control @error('count') is-invalid @enderror" value="{{ old('count', $item->count) }}" required>
                    @error('count')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group mt-3">
                    <label for="added_date">Added Date</label>
                    <input type="date" id="added_date" name="added_date" class="form-control @error('added_date') is-invalid @enderror" value="{{ old('added_date', $item->added_date ? $item->added_date->format('Y-m-d') : '') }}" required>
                    @error('added_date')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group mt-3">
                    <label for="remarks">Remarks</label>
                    <textarea id="remarks" name="remarks" class="form-control @error('remarks') is-invalid @enderror">{{ old('remarks', $item->remarks) }}</textarea>
                    @error('remarks')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="form-group mt-3">
            <button type="submit" class="btn btn-primary">Update Item</button>
        </div>
    </form>
</div>
@endsection
