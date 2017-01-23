@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-8">
        <h4>Create Link</h4>
        <hr>
        @include('partials.status')
        <form method="post" action="{{ url('links') }}">
            {{ csrf_field() }}

            <div class="form-group">
                <label class="control-label" for="slug">Link Name</label>
                <input id="slug" type="text" class="form-control" name="slug" value="{{ old('slug') }}" required autofocus>

                @if ($errors->has('slug'))
                    <span class="help-block">
                        <strong>{{ $errors->first('slug') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group">
                <label class="control-label" for="link">Link</label>
                <input id="link" type="text" class="form-control" name="link" value="{{ old('link') }}" required>

                @if ($errors->has('link'))
                    <span class="help-block">
                        <strong>{{ $errors->first('link') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group">
                <label class="control-label" for="keywords">Keywords</label>

                <textarea name="keywords" rows="5" class="form-control" required>{{ old('keywords') }}</textarea>
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
            @foreach($links as $link)
                <tr>
                    <td>{{ $link->slug }}</td>
                    <td><a href="{{ url('links/' . $link->id . '/edit') }}">Edit</a></td>
                </tr>
            @endforeach
        </table>
        {{ $links->links() }}
    </div>
</div>            
@endsection