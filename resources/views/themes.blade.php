@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-8">
        <h4>Create Theme</h4>
        <hr>
        @include('partials.status')
        <form method="post" action="{{ url('themes') }}">
            {{ csrf_field() }}

            <div class="form-group">
                <label class="control-label" for="name">Theme Name</label>
                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                @if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group">
                <label class="control-label" for="html">HTML Code</label>

                <textarea rows="20" name="html" class="form-control">{!! old('html') !!}</textarea>
            </div>

            <div class="form-group">
                <button type="submit" class="form-control btn btn-info">Submit</button>
            </div>
        </form>
    </div>
    <div class="col-md-4">
        <h4>Lists</h4>
        <hr>
        <table class="table table-striped">
            <tr>
                <th>Name</th>
                <th>Action</th>
            </tr>
            @foreach($themes as $theme)
                <tr>
                    <td>{{ $theme->name }}</td>
                    <td><a href="{{ url('themes/' . $theme->id . '/edit') }}">Edit</a></td>
                </tr>
            @endforeach
        </table>
        {{ $themes->links() }}
    </div>
</div>            
@endsection