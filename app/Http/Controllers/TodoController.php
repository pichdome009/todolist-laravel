<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;
use App\Models\Category; 

class TodoController extends Controller
{
    public function index()
    {
   
        $todos = Todo::with('category')->orderBy('created_at', 'desc')->get();
        
        $categories = Category::all(); 
        
        return view('todos', compact('todos', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'category_id' => 'required',
            'due_date' => 'nullable|date' 
        ]);

        Todo::create([
            'title' => $request->title,
            'category_id' => $request->category_id,
            'due_date' => $request->due_date 
        ]);
        
        return redirect()->back()->with('success', 'ការងារត្រូវបានបន្ថែមជោគជ័យ!');
    }

    public function toggleComplete($id)
    {
        $todo = Todo::find($id);
        $todo->is_completed = !$todo->is_completed;
        $todo->save();

        return redirect()->back()->with('success', 'ស្ថានភាពការងារត្រូវបានផ្លាស់ប្តូរ!');
    }

    public function edit($id)
    {
        $todo = Todo::find($id);
        $categories = Category::all();
        return view('edit', compact('todo', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'category_id' => 'required',
            'due_date' => 'nullable|date'
        ]);

        $todo = Todo::find($id);
        $todo->title = $request->title;
        $todo->category_id = $request->category_id;
        $todo->due_date = $request->due_date;
        $todo->save();

        return redirect('/')->with('success', 'ការងារត្រូវបានកែប្រែជោគជ័យ!');
    }

    public function destroy($id)
    {
        Todo::find($id)->delete();
        return redirect()->back()->with('success', 'ការងារត្រូវបានលុបចោល!');
    }
}