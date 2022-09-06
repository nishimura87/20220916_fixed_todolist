<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;
    protected $guarded = array('id');

    /**
     * 一覧画面表示用にtodosテーブルから全てのデータを取得
     */
    public function findAllTodos()
    {
        return Todo::all();
    }

    /**
     * リクエストされたIDをもとにtodosテーブルのレコードを1件取得
     */
    public function findTodoById($id)
    {
        return Todo::find($id);
    }

    /**
     * 登録処理
     */
    public function InsertTodo($request)
    {
        // リクエストデータを基に管理マスターユーザーに登録する
        return $this->create([
            'name' => $request->name
        ]);
    }

    /**
     * 更新処理
     */
    public function updateTodo($request, $todo)
    {
        $result = $todo->fill([
            'name' => $request->name
        ])->save();

        return $result;
    }

    /**
     * 削除処理
     */
    public function deleteTodoById($id)
    {
        return $this->destroy($id);
    }
}
