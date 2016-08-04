@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            artists
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($artists, ['route' => ['artists.update', $artists->id], 'method' => 'patch']) !!}

                        @include('artists.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection