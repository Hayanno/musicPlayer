<!-- File Field -->
<div class="form-group col-sm-6">
    {!! Form::label('file', 'File:') !!}
    {!! Form::file('file') !!}
</div>

<!-- Art Field -->
<div class="form-group col-sm-6">
    {!! Form::label('art', 'Art:') !!}
    {!! Form::text('art', null, ['class' => 'form-control']) !!}
</div>

<!-- Title Field -->
<div class="form-group col-sm-6">
    {!! Form::label('title', 'Title:') !!}
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>

<!-- Artists Field -->
<div class="form-group col-sm-6">
    {!! Form::label('artists_list', 'Artists:') !!}
    {!! Form::select('artists_list[]', $artists, null, ['class' => 'form-control', 'multiple']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('tracks.index') !!}" class="btn btn-default">Cancel</a>
</div>
