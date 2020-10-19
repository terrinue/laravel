@extends('layouts.app')
@section('content')
    <!-- Bootstrapの定形コード… -->
    <div class="row">
        <div class="col-md-12">
        @include('common.errors')

        <!-- 更新フォーム -->
        <form action="{{ url('books/update') }}" method="POST">
            @csrf

        <div class="form-group">
            <!-- 本のタイトル -->
            <label for="item_name">Title</label>
            <input type="text" name="item_name" class="form-control" value="{{$book->item_name}}" />
        </div>

        <div class="form-group">
            <!-- 本のタイトル -->
            <label for="item_number">Number</label>
            <input type="text" name="item_number" class="form-control" value="{{$book->item_number}}" />
        </div>

        <div class="form-group">
            <!-- 本のタイトル -->
            <label for="item_amount">Amount</label>
            <input type="text" name="item_amount" class="form-control" value="{{$book->item_amount}}" />
        </div>

        <div class="form-group">
            <!-- 本のタイトル -->
            <label for="published">Published</label>
            <input type="text" name="published" class="form-control" value="{{$book->published}}" />
        </div>

        <div class="well well-sm">
            <button type="submit" class="btn btn-primary">
                Save
            </button>

            <a class="btn btn-link pull-right" href="{{ url('/') }}">
                Back
            </a>
        </div>
            <input type="hidden" name="id" value="{{$book->id}}" />
        </form>
        </div>
        </div>
    @endsection
