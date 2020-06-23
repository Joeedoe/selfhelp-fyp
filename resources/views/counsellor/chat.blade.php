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
        Live Help
    </h1>
  </section>

<br>
<hr>

<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Chat List</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <ul class="products-list product-list-in-box">
            @foreach($chats as $chat)
        <li class="item">
            <div class="product-img">
            {{-- <img src="dist/img/default-50x50.gif" alt="Product Image"> --}}
            </div>
            <div class="product-info">
            <a href="{{ route('counsellor.openchat', $chat->id) }}" class="product-title">
                @if(auth()->user()->id == $chat->sender)
                    {{ $chat->freceiver->username }}
                    @if($chat->freceiver->status)
                        <span class="label label-success pull-right">online</span>
                    @endif
                @else
                    {{ $chat->fsender->username }}
                    @if($chat->fsender->status)
                        <span class="label label-success pull-right">online</span>
                    @endif
                @endif
            </a>
            <span class="product-description">
                {{ ($chat->messages->last()->user_id == auth()->user()->id ? "You: " : "") }}{{ $chat->messages->last()->message }}
            </span>
            </div>
        </li>
        @endforeach
        <!-- /.item -->
        </ul>
    </div>
    <!-- /.box-body -->
</div>

<div class="box box-success">
    <div class="box-header with-border">
        <h3 class="box-title">Online</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <ul class="products-list product-list-in-box">
            @foreach($onlines as $online)
                @if($online->id != auth()->user()->id)
                    <li class="item">
                        <div class="product-img">
                        {{-- <img src="dist/img/default-50x50.gif" alt="Product Image"> --}}
                        </div>
                        <div class="product-info">
                        <a href="{{ route('counsellor.newchat', $online->id) }}" class="product-title">
                            {{ $online->username }}
                            <span class="label label-success pull-right">online</span></a>
                        {{-- <span class="product-description">
                            Samsung 32" 1080p 60Hz LED Smart HDTV.
                        </span> --}}
                        </div>
                    </li>
                @endif
            @endforeach
        <!-- /.item -->
        </ul>
    </div>
    <!-- /.box-body -->
</div>

@endsection
