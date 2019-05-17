@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Create ponda</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('ponda.store') }}">
                        
                        {{ csrf_field() }}
                        
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('introduction') ? ' has-error' : '' }}">
                            <label for="text" class="col-md-4 control-label">Introduction</label>

                            <div class="col-md-6">
                                <!-- <input  type="text" class="form-control" name="introduction"  autofocus> -->
                                <textarea id="introduction" name="introduction" class="form-control" rows="5" ></textarea>
                                @if ($errors->has('introduction'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('introduction') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('score') ? ' has-error' : '' }}">
                            <label for="score" class="col-md-4 control-label">Score</label>

                            <div class="col-md-6">
                                <input id="score" type="number" class="form-control" name="score" value="{{ old('score') }}">

                                @if ($errors->has('score'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('score') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Create
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection