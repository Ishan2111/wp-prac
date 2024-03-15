<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::with('children')->whereNull('parent_id')->get();
        return view('categories.index', compact('categories'));
    }

    public function create()
{
    $mainCategories = Category::where('active',1)->whereNull('parent_id')->get();
    $options = $this->prepareCategoryOptions($mainCategories);
    return view('categories.create', compact('options'));
}

private function prepareCategoryOptions($categories, $prefix = '')
{
    $options = new Collection();
    foreach ($categories as $category) {
        $options->push(['id' => $category->id, 'name' => $prefix . $category->name]);
        if ($category->children->isNotEmpty()) {
            $options = $options->merge($this->prepareCategoryOptions($category->children, $prefix . '--'));
        }
    }
    return $options;
}

    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'parent_id' => 'nullable|exists:categories,id',
            'name' => 'required|string|max:255',
        ]);

        // Create a new category instance
        $category = new Category();
        $category->parent_id = $request->parent_id;
        $category->name = $request->name;
        $category->save();

        // Redirect back with success message
        return redirect()->back()->with('success', 'Category created successfully.');
    }

    public function toggleActive(Category $category)
    {
        $category->active = !$category->active;
        $category->save();
        return redirect()->route('categories.view');
    }
}
