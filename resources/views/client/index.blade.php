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

<a class="btn btn-success" href="{{ route('client.create') }}">新增客戶</a>

<table class="table">
    <thead>
        <tr>
            <th>客戶</th>
            <th>住址</th>
            <th>電話</th>
            <th>備註</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($clients as $client)
        <tr>
            <td>{{ $client->name }}</td>
            <td>{{ $client->address }}</td>
            <td>{{ $client->phone }}</td>
            <td>{{ $client->body }}</td>
            <td>
                <!-- <a class="btn btn-primary" href="{{ route('client.edit', $client->id) }}">修改</a> -->
                <a class="btn btn-danger deleteBtn" data-route="{{ route('client.destroy', $client->id) }}">刪除</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection