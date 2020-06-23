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
        Edit Profile
    </h1>
</section>

<br>
<hr>

<div class="row">
    <div class="col-md-6">
        <form action="{{ route('student.editprofile') }}" action="post">
            @csrf
            Username:
            <input class="form-control" type="text" name="username" value="{{ auth()->user()->username }}">
            <br>
            Email:
            <input class="form-control" type="email" name="email" value="{{ auth()->user()->email }}">
            <br>
            <input type="submit" class="btn btn-warning" value="Edit Profile">
        </form>
    </div>
</div>

<hr>

<div class="row">
    <div class="col-md-6">
        <form action="{{ route('student.editpassword') }}" action="post">
            @csrf
            Old Password:
            <input class="form-control" type="password" name="op">
            <br>
            New Password:
            <input class="form-control" type="password" name="np">
            <br>
            Confirm Password:
            <input class="form-control" type="password" name="cp">
            <br>
            <input type="submit" class="btn btn-warning" value="Update Password">
        </form>
    </div>
</div>

@endsection
