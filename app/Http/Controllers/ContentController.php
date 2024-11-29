<?php

namespace App\Http\Controllers;

use App\Models\Content;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    public function tampil()
    {
        $contents = Content::all();
        return view('dashboard', compact('contents'));
    }
    public function index(Request $request)
    {
        $query = Content::query();

        if ($search = $request->query('search')) {
            $query->where('title', 'like', "%{$search}%")
                ->orWhere('body', 'like', "%{$search}%");
        }

        $contents = $query->paginate(10); // Default 10 items per page
        return response()->json($contents, 200);
    }

    // Create Content
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        $content = Content::create($validated);
        return response()->json($content, 201);
    }

    // Read Content by ID
    public function show($id)
    {
        $content = Content::findOrFail($id);
        return response()->json($content);
    }

    // Update Content
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'body' => 'sometimes|required|string',
        ]);

        $content = Content::findOrFail($id);
        $content->update($validated);

        return response()->json($content);
    }

    // Delete Content
    public function destroy($id)
    {
        $content = Content::findOrFail($id);
        $content->delete();

        return response()->json(['message' => 'Content deleted successfully']);
    }
}
