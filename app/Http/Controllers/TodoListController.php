<?php

namespace App\Http\Controllers;

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

    public function store(Request $request){
       $request->validate(['name'=>['required']]);

       return TodoList::create($request->all());
        //return response($todo, Response::HTTP_CREATED);
    }

    public function destroy(TodoList $id)
    {
        $id->delete();
        return response('', Response::HTTP_NO_CONTENT);
    }

    public function update(Request $request, TodoList $id)
    {
        $request->validate(['name'=>['required']]);
        
        $id->update($request->all());
        return response($id);
    }
}
