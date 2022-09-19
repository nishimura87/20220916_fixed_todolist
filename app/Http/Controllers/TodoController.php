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
        $tags = Tag::all();
        $todos = Todo::where('task_name', \Auth::user()->id)->get();

        return view('index', compact('todos','user','tags'));
    }

    /**
     * 登録処理
     */
    public function add(TodoRequest $request)
    {
        // $form = [
        //     'task_name' => $request->input('task_name'),
        //     'tag_id' => $request->input('tag_id'),
        //     'user_id' => $user_id= Auth::id()
        // ];
        // unset($form['_token']);

        $todo = new Todo;
        $form = $request->all();
        $form['user_id'] =  Auth::id();
        unset($form['_token']);
        $todo->fill($form)->save;

        dd($form);
        //Todo::create([$form]);
        return redirect('/home');
    }

    /**
     * 更新処理
     */
    public function update(Request $request, $id)
    {
        $todo = Todo::find($id);
        $updateTodo = $this->todo->updateTodo($request, $todo);

        return redirect('/home');
    }

    /**
     * 削除処理
     */
    public function delete($id)
    {
        $deleteTodo = $this->todo->deleteTodoById($id);

        return redirect('/home');
    }

    public function find(Request $request)
    {
        return redirect('find');
    }

    public function categry() 
    {
        $prefs = config('pref');
        return view('categry')->with(['prefs' => $prefs]);
}

    
}