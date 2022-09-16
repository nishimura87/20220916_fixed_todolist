<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;
    protected $guarded = array('id');

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function tag() {
        return $this->belongsTo(Tag::class);
    }

    public function getTagname(){
        return 'tag_id'.$this->tag_name . optional($this->tag)->name;
    }

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
     * 更新処理
     */
    public function updateTodo($request, $todo)
    {
        $result = $todo->fill([
            'task_name' => $request->task_name,
            'tag_name' => $request->tag_name
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
