<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $tracks->id !!}</p>
</div>

<!-- File Field -->
<div class="form-group">
    {!! Form::label('file', 'File:') !!}
    <p>{!! $tracks->file !!}</p>
</div>

<!-- Art Field -->
<div class="form-group">
    {!! Form::label('art', 'Art:') !!}
    <p>{!! $tracks->art !!}</p>
</div>

<!-- Title Field -->
<div class="form-group">
    {!! Form::label('title', 'Title:') !!}
    <p>{!! $tracks->title !!}</p>
</div>

<!-- Artists Field -->
<div class="form-group">
    {!! Form::label('artists', 'Artists:') !!}
    <ul>
        @foreach($tracks->artists as $artist)
            <li>{{ $artist->name }}</li>
        @endforeach
    </ul>
</div>
