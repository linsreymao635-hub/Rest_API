<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        if (request()->expectsJson()) {
            return response()->json(Category::all(), 200);
        }
        return view('categories.index', ['categories' => Category::all()]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string',
            'description' => 'required|string',
            'is_active'   => 'boolean',
        ]);

        $category = Category::create($validated);

        if (request()->expectsJson()) {
            return response()->json($category, 201);
        }
        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }

    public function show($id)
    {
        $category = Category::findOrFail($id);
        if (request()->expectsJson()) {
            return response()->json($category, 200);
        }
        return view('categories.show', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $validated = $request->validate([
            'name'        => 'required|string',
            'description' => 'required|string',
            'is_active'   => 'boolean',
        ]);
        $category->update($validated);

        if (request()->expectsJson()) {
            return response()->json($category, 200);
        }
        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy($id)
    {
        Category::findOrFail($id)->delete();

        if (request()->expectsJson()) {
            return response()->json(['message' => 'Deleted successfully'], 200);
        }
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
}