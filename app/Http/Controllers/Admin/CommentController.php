<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Comment;
use App\Article;

class CommentController extends Controller
{
    public function index()
    {
        return view('admin/comment/index')->withComments(Comment::all())->withArticles(Article::all());
    }

    public function show($nickname) {
        return view('admin/comment/index')->withComments(Comment::where('nickname', '=', $nickname)->get())->withArticles(Article::all());
    }

    public function article_comments($id) {
        return view('admin/comment/index')->withComments(Comment::where('article_id', '=', $id)->get())->withArticles(Article::all());
    }

    public function edit($id)
    {
        return view('admin/comment/edit')->withComment(Comment::find($id));
    }

    public function update(Request $request, $id)
    {
        // 数据验证
        $this->validate($request, [
            'email' => 'required|unique:comments|max:100', // 必填、在 comments 表中唯一、最大长度 255
            'nickname' => 'required', // 必填
            'content' => 'required', // 必填
        ]);
        $comment = Comment::find($id);
        $comment->email = $request->get('email');
        $comment->nickname = $request->get('nickname');
        $comment->content = $request->get('content');

        // 将数据保存到数据库，通过判断保存结果，控制页面进行不同跳转
        if ($comment->save()) {
            return redirect('admin/comments'); // 更新成功，跳转到 评论管理 页
        } else {
            // 更新失败，跳回来路页面，保留用户的输入，并给出提示
            return redirect()->back()->withInput()->withErrors('更新失败！');
        }
    }

    public function destroy($id)
    {
        Comment::find($id)->delete();
        return redirect()->back()->withInput()->withErrors('删除成功！');
    }
}
