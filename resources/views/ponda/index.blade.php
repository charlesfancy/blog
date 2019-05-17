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



<table class="table">
    <thead>
        <tr>
            <th>候選人</th>
            <th>政見發表</th>
            <th>得票</th>
            <th>動作</th>
            @guest
                
            @else
            <th>統計</th> 
            @endguest
        </tr>
    </thead>
    <tbody>
        @foreach ($pondas as $ponda)
        <tr>
            <td>{{ $ponda->name }}</td>
            <td>{{ $ponda->introduction }}</td>
            <td>{{ $ponda->score }}</td>
            <td>
                @guest
                <a class="btn btn-warning" href="{{ route('ponda.vote', $ponda->id) }}">投票</a>
                @else
                <a class="btn btn-warning" href="{{ route('ponda.vote', $ponda->id) }}">投票</a>
                <a class="btn btn-primary" href="{{ route('ponda.edit', $ponda->id) }}">修改</a>
                <a class="btn btn-danger deleteBtn" data-route="{{ route('ponda.destroy', $ponda->id) }}">刪除</a>
                @endguest
            </td>
            
                @guest
                
                @else
                <td>
                {{ $ponda->score }} / {{ $total = DB::table('pondas')->sum('score') }} = {{ round($ponda->score/$total*100,2) }} %
                </td>
                @endguest
            

        </tr>
        @endforeach
    </tbody>
</table>
@guest

@else
<a class="btn btn-success" href="{{ route('ponda.create') }}">新增候選人</a>

@endguest
總投票數：{{ $total = DB::table('pondas')->sum('score') }}。

@endsection