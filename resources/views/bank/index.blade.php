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

Hi~ BANK!!!

@endsection