<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoListRequest;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Models\TodoList;

class TodoListController extends Controller
{
    public function index(){
        $todoList = TodoList::all();
        return response($todoList);
    }

    public function show($id){
        $todo= TodoList::findOrFail($id);
        return response($todo);
    }

    public function store(TodoListRequest $request){
       return TodoList::create($request->all());
        //return response($todo, Response::HTTP_CREATED);
    }

    public function destroy(TodoList $id)
    {
        $id->delete();
        return response('', Response::HTTP_NO_CONTENT);
    }

    public function update(TodoListRequest $request, TodoList $id)
    {
        $id->update($request->all());
        return response($id);
    }
}
