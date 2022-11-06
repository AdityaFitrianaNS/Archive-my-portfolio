<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Todolist;
use Illuminate\Http\Request;

class DashboardCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard/categories/index', [
            'title' => 'Categories',
            'image' => 'anime.jpg',
            'name' => 'Category',
            'categories' => Category::latest()->where('user_id', auth()->user()->id)->paginate(6)->withQueryString(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard/categories/form/create', [
            'title' => 'New Category'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validation = $request->validate([
            'name' => ['required', 'min:5', 'max:100'],
            'slug' => ['required', 'min:5', 'max:100']
        ]);

        // Ambil user_id, dan excerpt
        $validation['user_id'] = auth()->user()->id;

        // Lakukan create
        Category::create($validation);

        return redirect('/categories')->with('toast_success', 'Category Created Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view('/dashboard/categories/show', [
            'title' => 'Todolist | Category',
            'todolists' => Todolist::latest()->filter(Request(['owner', 'category']))
            ->paginate(6)->withQueryString()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        if ($category->user_id !== auth()->user()->id) {
            abort(403);
        }

        return view('dashboard/categories/form/edit', [
            'title' => 'Edit ' . $category->title,
            'category' => $category,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $validation = [
            'name' => ['required', 'min:5', 'max:100'],
            'slug' => ['required', 'min:5', 'max:100']
        ];

        // Pass validation
        $validationData = $request->validate($validation);
        
        // Get user_id
        $validationData['user_id'] = auth()->user()->id;

        // Update to-do list
        Category::where('id', $category->id)->update($validationData);

        return redirect('/categories')->with('toast_success', 'Categories Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        Category::destroy($category->id);

        return redirect('/categories')->with('toast_success', 'Category Deleted Successfully!');
    }
}
