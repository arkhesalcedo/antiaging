@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-4">
        <h4>Update Page</h4>
        <hr>
        @include('partials.status')
        <form method="post" action="{{ url('pages/' . $page->id . '/edit') }}">
            {{ csrf_field() }}
            {{ method_field('PUT') }}

            <div class="form-group">
                <label class="control-label" for="slug">Code</label>
                <input id="slug" type="text" class="form-control" name="slug" value="{{ $page->slug }}" required autofocus>

                @if ($errors->has('slug'))
                    <span class="help-block">
                        <strong>{{ $errors->first('slug') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group">
                <label class="control-label" for="theme">Select Theme</label>
                <select class="form-control" name="theme_id" required>
                    @foreach($themes as $theme)
                        <option value="{{ $theme->id }}" {{ $theme->id == $page->theme_id ? 'selected' : '' }}>{{ $theme->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label class="control-label" for="link">Select Link</label>
                <select class="form-control" name="link_id" required>
                    @foreach($links as $link)
                        <option value="{{ $link->id }}" {{ $link->id == $page->link_id ? 'selected' : '' }}>{{ $link->slug }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <button type="submit" class="form-control btn btn-warning">Update</button>
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