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
        Live Help
    </h1>
</section>

<br>
<hr>

<div class="box box-success direct-chat direct-chat-success">
    <div class="box-header with-border">
        <h3 class="box-title">Direct Chat</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <!-- Conversations are loaded here -->
        <div class="direct-chat-messages">
            @foreach($chat->messages as $message)
            <!-- Message. Default to the left -->
            <div class="direct-chat-msg
            @if($message->user_id == auth()->user()->id)
                right
            @endif

            ">
                <div class="direct-chat-info clearfix">
                    <span class="direct-chat-name pull-left">{{ $message->user->username }}</span>
                    <span class="direct-chat-timestamp pull-right">{{ $message->user->created_at }}</span>
                </div>
                <!-- /.direct-chat-info -->
                {{-- <img class="direct-chat-img" src="../dist/img/user1-128x128.jpg" alt="Message User Image"><!-- /.direct-chat-img --> --}}
                <div class="direct-chat-text">
                    {{ $message->message }}
                </div>
                <!-- /.direct-chat-text -->
            </div>
            <!-- /.direct-chat-msg -->
            @endforeach

        </div>
        <!--/.direct-chat-messages-->

    </div>
    <!-- /.box-body -->
    <div class="box-footer">
        <form action="{{ route('student.addMessage', $chat->id) }}" method="post">
            @csrf
            <div class="input-group">
                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                <input type="text" id="message" name="message" placeholder="Type Message ..." class="form-control">
                <span class="input-group-btn">
                    <button type="submit" class="btn btn-success btn-flat">Send</button>
                </span>
            </div>
            <small>Clear textbox when not using. This is to allow reload to happen.</small>
        </form>
    </div>
    <!-- /.box-footer-->
</div>

<script>
    setInterval(function(){
        const msg = document.getElementById('message').value;
        console.log(msg)
        if (msg == "") {
            window.location.reload(1);
        }
        else{

        }
    }, 5000);
</script>

@endsection
