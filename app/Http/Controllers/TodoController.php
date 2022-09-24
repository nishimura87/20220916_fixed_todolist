<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Requests\TodoRequest;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }

    public function __construct()
    {
        $this->todo = new Todo();
        $this->middleware('auth');
    }

    /**
     * 一覧画面
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $tags = Tag::All();
        $todos = Todo::where('user_id', \Auth::user()->id)->get();

        return view('index', compact('todos','user','tags'));
    }

    /**
     * 登録処理
     */
    public function add(TodoRequest $request)
    {
        $todo = new Todo;
        $form = $request->all();
        $form['user_id'] =  Auth::id();
        unset($form['_token']);

        //dd($form);
        Todo::create($form);
        return redirect('/home');
    }

    /**
     * 更新処理
     */
    public function update(TodoRequest $request, $id)
    {
        $todo = Todo::find($id);
        $form = $todo->fill([
            'task_name' => $request->task_name,
            'tag_id' => $request->tag_id
        ])->save();

        return back();
    }

    /**
     * 削除処理
     */
    public function delete($id)
    {
        $todo = Todo::destroy($id);

        return back();
    }

    /**
     * 検索画面遷移処理
     */

    public function find(Request $request)
    {
        $user = Auth::user();
        $tags = Tag::All();
        $todos = [];

        return view('find', compact('todos','user','tags'));
    }

    /**
     * 検索処理
     */
    public function search(Request $request)
    {
        $form = Todo::query();
        $user = Auth::user();
        $tags = Tag::All();

        $task_name = $request->task_name;
        $tag_id = $request->tag_id;

        if (!empty($task_name)) {
            $form = Todo::where('user_id', \Auth::user()->id)->where('task_name','like',"%$task_name%");
        }
        if (!empty($tag_id)) {
            $form = Todo::where('user_id', \Auth::user()->id)->where('tag_id','like',$tag_id);
        }
        else {
            //$form = Todo::All();
        }

        $todos = $form->get();
        

        //dd($todos);

        return view('find', compact('todos','user','tags'));
        
    }

    public function return(Request $request)
    {
        return redirect('/home');
    }
}