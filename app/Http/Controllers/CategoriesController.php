<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoriesController extends Controller
{
    public function show(Request $request, Category $category)
    {
        $topics = Topic::withOrder($request->order)
            ->where('category_id', $category->id)
            ->paginate(10);

        return view('topics.index', compact('topics', 'category'));
    }
}
