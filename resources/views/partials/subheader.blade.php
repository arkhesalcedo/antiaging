<div class="container">
    <div class="row">
        <div class="col-md-12">
            @if(!Auth::guest())
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a href="{{ url('home') }}">Pages</a> | 
                    <a href="{{ url('themes') }}">Themes</a> | 
                    <a href="{{ url('links') }}">Links</a> | 
                    <a href="#" data-toggle="modal" data-target="#myModal">File Manager</a>
                </div>
                <div class="panel-body">
            @endif