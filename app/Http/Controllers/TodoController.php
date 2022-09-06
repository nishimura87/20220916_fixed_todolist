<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use App\Http\Requests\TodoRequest;

class TodoController extends Controller
{

    public function __construct()
    {
        $this->todo = new Todo();
    }

    /**
     * 一覧画面
     */
    public function index()
    {
        $todos = $this->todo->findAllTodos();

        return view('index', compact('todos'));
    }

    /**
     * 登録処理
     */
    public function add(TodoRequest $request)
    {
        $registerTodo = $this->todo->InsertTodo($request);

        return redirect('/');
    }

    /**
     * 更新処理
     */
    public function update(Request $request, $id)
    {
        $todo = Todo::find($id);
        $updateTodo = $this->todo->updateTodo($request, $todo);

        return redirect('/');
    }

    /**
     * 削除処理
     */
    public function delete($id)
    {
        $deleteTodo = $this->todo->deleteTodoById($id);

        return redirect('/');
    }
}