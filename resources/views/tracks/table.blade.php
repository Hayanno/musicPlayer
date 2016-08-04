<table class="table table-responsive" id="tracks-table">
    <thead>
        <th>Title</th>
        <th>Art</th>
        <th>File</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($tracks as $tracks)
        <tr>
            <td>{!! $tracks->title !!}</td>
            <td>{!! $tracks->art !!}</td>
            <td>{!! $tracks->file !!}</td>
            <td>
                {!! Form::open(['route' => ['tracks.destroy', $tracks->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('tracks.show', [$tracks->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('tracks.edit', [$tracks->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>