@extends('layouts.counsellor')

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

<button class="btn btn-sm btn-primary pull-right" data-toggle="modal" data-target="#addModal"><i class="fa fa-plus"></i>&nbsp; Add new Self Help</button>

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

<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModal">Edit Self Help</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('counsellor.help.update', 0) }}" method="POST" name="edit">
            @csrf
            @method('put')
            <input type="hidden" name="id" value="">
            <div class="modal-body">
                <label>Title</label>
                <input type="text" name="title" class="form-control" required>
                <label>Body</label>
                <textarea name="body" class="form-control" cols="30" rows="10" required></textarea>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <input type="submit" class="btn btn-warning" value="Edit User">
            </div>
        </form>
      </div>
    </div>
  </div>

<!-- Modal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModal">Add New Self Help</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('counsellor.help.store') }}" method="POST">
                @csrf
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                <div class="modal-body">
                    <label>Title</label>
                    <input type="text" name="title" class="form-control" required>
                    <label>Body</label>
                    <textarea name="body" class="form-control" cols="30" rows="10" required></textarea>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <input type="submit" class="btn btn-primary" value="Add Self Help">
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
