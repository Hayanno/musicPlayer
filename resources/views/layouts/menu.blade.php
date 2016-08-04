
<li class="{{ Request::is('tracks*') ? 'active' : '' }}">
    <a href="{!! route('tracks.index') !!}"><i class="fa fa-edit"></i><span>tracks</span></a>
</li>

<li class="{{ Request::is('artists*') ? 'active' : '' }}">
    <a href="{!! route('artists.index') !!}"><i class="fa fa-edit"></i><span>artists</span></a>
</li>

<li class="{{ Request::is('albums*') ? 'active' : '' }}">
    <a href="{!! route('albums.index') !!}"><i class="fa fa-edit"></i><span>albums</span></a>
</li>

