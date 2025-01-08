<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;

class TodoController extends Controller
{
    public function index() 
    {
        $data = Todo::orderBy('order', 'DESC')->get();
        return response()->json($data);
    }

    public function store(Request $request) 
    {
        $data = Todo::create([
            'title' => $request->title,
            'dec'   => $request->dec
        ]);

        if ($data) {
            return response()->json([
                'message' => 'Todo add successfully',
                'data'    => $data
            ]);
        } else {
            return response()->json(['message' => 'Todo add Failed']);
        }
    }

    public function update(Request $request, $id) 
    {
        $data        = Todo::find($id);
        $data->title = $request->title; // Perbarui nilai kolom
        $data->dec   = $request->dec; // Perbarui nilai kolom
        $data->save();

        if ($data) {
            return response()->json([
                'message' => 'Todo update successfully',
                'data'    => $data
            ]);
        } else {
            return response()->json(['message' => 'Todo reordered Failed']);
        }
    }

    public function destroy($id) 
    {
        $data = Todo::destroy($id);
        if ($data) {
            return response()->json(['message' => 'Todo delete successfully']);
        } else {
            return response()->json(['message' => 'Todo delete Failed']);
        }
    }

    public function reorder(Request $request) 
    {
        $data = $request->input('todo'); // Array tugas dengan ID dan posisi baru

        foreach ($data as $item) {
            Todo::where('id', $item['id'])->update(['order' => $item['order']]);
        }

        return response()->json(['message' => 'Todo reordered successfully']);
    }
}
