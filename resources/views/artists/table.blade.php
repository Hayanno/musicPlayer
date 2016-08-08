<table class="table table-responsive" id="artists-table">
    <thead>
        <th>Name</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($artists as $artists)
        <tr>
            <td>{!! $artists->name !!}</td>
            <td>
                {!! Form::open(['route' => ['artists.destroy', $artists->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('artists.show', [$artists->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('artists.edit', [$artists->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>