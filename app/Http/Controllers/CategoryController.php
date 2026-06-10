<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // GET /categories
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    // GET /categories/create
    public function create()
    {
        return view('categories.create');
    }

    // POST /categories
    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        Category::create([
            'name'        => $request->name,
            'description' => $request->description,
            'is_active'   => $request->has('is_active'),
        ]);

        return redirect()->route('categories.index')
            ->with('success', 'Category created successfully.');
    }

    // GET /categories/{id}/edit
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    // PUT /categories/{id}
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $category->update([
            'name'        => $request->name,
            'description' => $request->description,
            'is_active'   => $request->has('is_active'),
        ]);

        return redirect()->route('categories.index')
            ->with('success', 'Category updated successfully.');
    }

    // DELETE /categories/{id}
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('categories.index')
            ->with('success', 'Category deleted successfully.');
    }
}
