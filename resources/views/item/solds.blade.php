@extends('adminlte::page')

@section('title', '売却商品一覧')

@section('content_header')
    <h1>売却商品一覧</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">

                    <!--検索機能--> 
                    <form action="/items/search"method="GET">
                    <input type="text" name="keyword" value="">
                    <input type="submit" value="検索"> 
                    </form>
                </div>
                    <div class="card-tools">
                        <div class="input-group input-group-sm">
                            <div class="input-group-append">
                                <a href="{{ url('items/add') }}" class="btn btn-default">商品登録</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>名前</th>
                                <th>種別</th>
                                <th>詳細</th>
                                <!--新規追加機能-->
                                <th>キャンセル</th>
                                <th>削除</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->type }}</td>
                                    <td>{{ $item->detail }}</td>
                                    <!--キャンセル機能-->
                                    <td>
                                        <form action="/items/Updateing/{{ $item->id}}"method="POST">
                                            @csrf 
                                        <input type="hidden" name="CancelId" value="{{ $item->id}}">
                                        <button type="submit"class="btn">キャンセル</button>
                                        </form>
                                    </td>                                   
                                    
                                    
                                    
                                    
                                    <!--削除機能-->
                                    <td>   
                                        <form action="/items/destroy/{{ $item->id }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="deleteId" id="deleteId" value="{{ $item->id }}">
                                        <button type="submit" class="btn btn-danger ">削除</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
@stop
