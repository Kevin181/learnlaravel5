@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">编辑评论</div>
                <div class="panel-body">

                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>编辑失败</strong> 输入不符合要求<br><br>
                            {!! implode('<br>', $errors->all()) !!}
                        </div>
                    @endif

                    <form action="{{ url('admin/comments/'.$comment->id) }}" method="POST">
                        {{ method_field('PATCH') }}
                        {!! csrf_field() !!}
                        <label for="nickname">Nickname:</label>
                        <input type="text" name="nickname" id="nickname" class="form-control" required="required" placeholder="请输入昵称" value="{{$comment->nickname}}">
                        <br>
                        <label for="email">Email:</label>
                        <input type="text" name="email" id="email" class="form-control" required="required" placeholder="请输入邮件地址" value="{{$comment->email}}">
                        <br>
                        <label for="website">Website:</label>
                        <input type="text" name="website" id="website" class="form-control" required="required" placeholder="请输入网址" value="{{$comment->website}}">
                        <br>
                        <label for="content">Content:</label>
                        <textarea name="content" id="content" rows="10" class="form-control" required="required" placeholder="请输入内容">{{$comment->content}}</textarea>
                        <br>
                        <button class="btn btn-lg btn-primary">提交修改</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection