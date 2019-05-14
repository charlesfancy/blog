@extends('layout')

@section('content')

    <h1 class="tittle"> Edit Ponda </h1>

    <form method="POST" action="/ponda/{{ $ponda->id }}">
        {{ method_field('PATCH') }}
        {{ csrf_field() }}
        <div class="field">
            <label class="label" for="tittle">Name</label>

            <div class="control">
                <input type="text" class="input" name="name" placehoder="Name" value="{{ $ponda->name }}">
            </div>
        </div>

        <div class="field">
            <label class="label" for="introduction">Introduction</label>

            <div class="control">
                <textarea name="introduction" class="textarea">{{ $ponda->introduction }}</textarea>
            </div>
        </div>

        <div class="field">
            <div class="control">
                <button type="submit" class="button is-link"> Update Ponda</button>
            </div>
        </div>

    </form>

@endsection

