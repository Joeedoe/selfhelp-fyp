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

<table class="table table-bordered table-hovered dt">
    <thead>
        <th>Sender</th>
        <th>Receiver</th>
        <th>Action</th>
    </thead>
    <tbody>
        @foreach ($chats as $chat)
            <td>{{ $chat->sender->username }}</td>
            <td>{{ $chat->receiver->username }}</td>
            <td>
                <form method="post" action="{{ route('admin.user.destroy', $user->id) }}" onsubmit="return confirm('Are you sure?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button>
                </form>
            </td>
        @endforeach
    </tbody>
</table>
@endif


@endsection
