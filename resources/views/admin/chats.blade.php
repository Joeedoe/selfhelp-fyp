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
            <a href="{{ route('admin.chat.show', $chat->id) }}" class="product-title">
                    {{ $chat->freceiver->username }} >
                    {{ $chat->fsender->username }}
            </a>
            <span class="product-description">
                {{ $chat->messages->last()['created_at'] }}
            </span>
            </div>
        </li>
        @endforeach
        <!-- /.item -->
        </ul>
    </div>
    <!-- /.box-body -->
</div>

@endsection
