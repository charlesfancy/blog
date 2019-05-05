@extends('layouts.app')

@push('scripts')
    <script>
        let buttons = document.querySelectorAll('.deleteBtn');
        
        buttons.forEach((btn) => {
            btn.addEventListener('click', (e) => {
                e.preventDefault();

                axios.delete(btn.dataset.route).then(() => {
                    location.reload();
                });
            })
        });
    </script>
@endpush

@section('content')
    <a class="btn btn-success" href="{{ route('product.create') }}">Create</a>
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Manufacture Date</th>
                <th>Stock</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->manufacture_date }}</td>
                    <td>{{ $product->stock }}</td>
                    <td>
                        <a class="btn btn-primary" href="{{ route('product.edit', $product->id) }}">Edit</a>
                        <a class="btn btn-danger deleteBtn" data-route="{{ route('product.destroy', $product->id) }}">Delete</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection