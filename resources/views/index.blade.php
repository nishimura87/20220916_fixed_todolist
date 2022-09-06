<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <title>Todo List</title>
  </head>
  <body>
    <div class="content">
      <div class="todo_list">
        <p class="title">Todo List</p>
        @if ($errors->has('name'))
        <ul>
          <li>The content field is required.</li>
        </ul>
        @endif
        <form action="/add" method="POST"class="input_task">
          @csrf
          <input type="text" class="input_add" name="name">
          <input class="button_add" type="submit" value="追加">
        </form>
        <table calss = "table table-todo">
          <tr>
            <th>作成日</th>
            <th>タスク名</th>
            <th>更新</th>
            <th>削除</th>
          </tr>
          @foreach ($todos as $todo)
          <tr>
            <td>{{ $todo->created_at }}</td>
            <form action="{{ route('todo.update', ['id'=>$todo->id]) }}" method="POST">
              @csrf
            <td>
              <input type ="hidden" name="id" value="{{ $todo->id }}">
              <input type="text" name="name"  id="name" value="{{ $todo->name }}" class=task_con></td>
            <td><button type="submit" class="btn btn-update">更新</button></td>
            </form>
            <td>
              <form action="{{ route('todo.delete', ['id'=>$todo->id]) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-delete">削除</button>
              </form>
            </td>
          </tr>
          @endforeach
        </table>
      </div>
    </div>
  </body>
</html>