@extends('layouts.admin')

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

<button class="btn btn-sm btn-primary pull-right" data-toggle="modal" data-target="#addModal"><i class="fa fa-plus"></i>&nbsp; Add new User</button>
<hr>
    <section class="content-header">
        <h1>
          List Of Students
        </h1>
      </section>
      <hr>
<table class="table table-bordered table-hover dt">
    <thead>
        <tr>
            <th>Student ID</th>
            <th>Username</th>
            <th>Email</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $i => $user)
            @if ($user->userRole == 3)
            <tr>
                <td>{{ $user->uniId }}</td>
                <td>{{ $user->username }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    @if ($user->status)
                        <button class="btn btn-xs btn-success">Online</button>
                    @else
                        <button class="btn btn-xs btn-danger">Offline</button>
                    @endif
                </td>
                <td>
                    <form method="post" action="{{ route('admin.user.destroy', $user->id) }}" onsubmit="return confirm('Are you sure?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-xs btn-warning" data-toggle="modal" data-target="#editModal" onclick="event.preventDefault(); editUser('{{ $user }}')"><i class="fa fa-edit"></i></button>
                        <button class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button>
                    </form>
                </td>
            </tr>
            @endif
        @endforeach
    </tbody>
</table>
<hr>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
          List Of Counsellors
        </h1>
      </section>
      <hr>
<table class="table table-bordered table-hover dt">
    <thead>
        <tr>
            <th>Staff ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $i => $user)
            @if ($user->userRole == 2)
            <tr>
                <td>{{ $user->uniId }}</td>
                <td>{{ $user->username }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    @if ($user->status)
                        <button class="btn btn-xs btn-success">Online</button>
                    @else
                        <button class="btn btn-xs btn-danger">Offline</button>
                    @endif
                </td>
                <td>
                    <form method="post" action="{{ route('admin.user.destroy', $user->id) }}" onsubmit="return confirm('Are you sure?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-xs btn-warning" data-toggle="modal" data-target="#editModal" onclick="event.preventDefault(); editUser('{{ $user }}')"><i class="fa fa-edit"></i></button>
                        <button class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button>
                    </form>
                </td>
            </tr>
            @endif
        @endforeach
    </tbody>
</table>

<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModal">Edit User</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('admin.user.update', 0) }}" method="POST" name="edit">
            @csrf
            @method('put')
            <input type="hidden" name="id" value="">
            <div class="modal-body">
                <label>Student / Staff Id</label>
                <input type="text" name="uniId" class="form-control" required>
                <label>Username</label>
                <input type="text" name="username" class="form-control" required>
                <label>Email</label>
                <input type="email" name="email" class="form-control" required>
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
                <h5 class="modal-title" id="addModal">Add New User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.user.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <label>Student / Staff Id</label>
                    <input type="text" name="uniId" class="form-control" required>
                    <label>Username</label>
                    <input type="text" name="username" class="form-control" required>
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" required>
                    <label>Role</label>
                    <select name="userRole" class="form-control">
                        <option value="2">Counsellor</option>
                        <option value="3">Student</option>
                    </select>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <input type="submit" class="btn btn-primary" value="Add Owner">
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
