@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-4">
        <h4>Create Pages</h4>
        <hr>
        @include('partials.status')
        <form method="post" action="{{ url('pages') }}">
            {{ csrf_field() }}

            <div class="form-group">
                <label class="control-label" for="slug">Start Code</label>
                <input id="slug" type="text" class="form-control" name="slug" value="{{ old('slug') }}" required autofocus>

                @if ($errors->has('slug'))
                    <span class="help-block">
                        <strong>{{ $errors->first('slug') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group">
                <label class="control-label" for="slug">End Code (optional)</label>
                <input id="slug_end" type="text" class="form-control" name="slug_end" value="{{ old('slug_end') }}">

                @if ($errors->has('slug_end'))
                    <span class="help-block">
                        <strong>{{ $errors->first('slug_end') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group">
                <label class="control-label" for="theme">Select Theme</label>
                <select class="form-control" name="theme_id" required>
                    @foreach($themes as $theme)
                        <option value="{{ $theme->id }}">{{ $theme->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label class="control-label" for="link">Select Link</label>
                <select class="form-control" name="link_id" required>
                    @foreach($links as $link)
                        <option value="{{ $link->id }}">{{ $link->slug }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <button type="submit" class="form-control btn btn-info">Submit</button>
            </div>
        </form>
    </div>
    <div class="col-md-8">
        <h4>Lists</h4>
        <hr>
        <table class="table table-striped">
            <tr>
                <th>Slug</th>
                <th>Theme</th>
                <th>Action</th>
            </tr>
            @foreach($pages as $page)
                <tr>
                    <td>{{ $page->slug }}</td>
                    <td>{{ $page->theme->name }}</td>
                    <td><a href="{{ url('pages/' . $page->id . '/edit') }}">Edit</a></td>
                </tr>
            @endforeach
        </table>
        {{ $pages->links() }}
    </div>
</div>            
@endsection