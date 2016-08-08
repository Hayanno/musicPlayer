<table class="table table-responsive" id="albums-table">
    <thead>
        <th>Title</th>
        <th>Art</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($albums as $albums)
        <tr>
            <td>{!! $albums->title !!}</td>
            <td>{!! $albums->art !!}</td>
            <td>
                {!! Form::open(['route' => ['albums.destroy', $albums->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('albums.show', [$albums->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('albums.edit', [$albums->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>