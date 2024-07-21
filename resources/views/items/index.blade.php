@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Items</h1>
    <a href="{{ route('items.create') }}" class="btn btn-primary mb-3">Add New Item</a>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>SKU</th>
                <th>Price</th>
                <th>Count</th>
                <th>Category</th>
                <th>Added Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->sku }}</td>
                <td>{{ $item->price }}</td>
                <td>{{ $item->count }}</td>
                <td>{{ $item->category->name }}</td>
                <td>{{ $item->added_date->format('F j, Y') }}</td>
                <td>
                    <a href="{{ route('items.edit', $item) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('items.destroy', $item) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
