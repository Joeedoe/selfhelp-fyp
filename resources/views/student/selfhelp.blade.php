@extends('layouts.student')

@section('content')

@if ($errors->any())
<div class="alert alert-danger alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4>Error!</h4>
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<section class="content-header">
    <h1>
        SelfHelp Center
    </h1>
  </section>

<br>
<hr>
@foreach ($selfhelps as $selfhelp)
<div class="box box-widget collapsed-box">
    <div class="box-header with-border">
      <div class="user-block">
        <span class="username"><a href="#">{{ $selfhelp->creator->username }}</a></span>
        <span class="description">Shared publicly - {{ $selfhelp->created_at }}</span>
        <section class="content-header">
            <h1>
                {{ $selfhelp->title }}
            </h1>
          </section>
      </div>
      <!-- /.user-block -->
      <div class="box-tools">
        <form method="post" action="{{ route('counsellor.help.destroy', $selfhelp->id) }}" onsubmit="return confirm('Are you sure?')">
            @method('DELETE')
            @csrf
            @if ($selfhelp->user_id == Auth::user()->id)
                <button type="submit" class="btn btn-xs btn-danger" data-toggle="tooltip" title="delete" ><i class="fa fa-trash"></i></button>
                <button type="button" class="btn btn-xs btn-warning" data-toggle="modal" data-target="#editModal" title="edit" onclick="event.preventDefault(); editHelp('{{ $selfhelp }}')"><i class="fa fa-edit"></i></button>
            @endif
            <button type="button" class="btn btn-xs btn-primary" data-widget="collapse" title="See More" onclick="event.preventDefault()"><i class="fa fa-plus"></i></button>
        </form>
      </div>
      <!-- /.box-tools -->
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <!-- post text -->
      <p>{{ $selfhelp->body }}</p>
    </div>
    <!-- /.box-body -->

  </div>
@endforeach

@endsection
