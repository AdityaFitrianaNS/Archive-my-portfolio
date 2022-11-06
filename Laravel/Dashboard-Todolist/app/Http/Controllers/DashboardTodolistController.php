<?php

namespace App\Http\Controllers;

use App\Models\Todolist;
use App\Models\Category;
use Illuminate\Http\Request;
use Alert;

class DashboardTodolistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pagination = 6;

        return view('dashboard/todolists/index', [
            'title' => 'To-do list',
            'image' => 'anime.jpg',
            'name' => 'profile',
            'todolists' => Todolist::latest()->where('user_id', auth()->user()->id)->paginate($pagination)->withQueryString()
            // 'count' => Todolist::
        ])->with('i', ($request->input('page', 1) - 1) * $pagination);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard/todolists/form/create', [
            'title' => 'New Todolist',
            'categories' => Category::all()
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
            'title' => ['required', 'max:100', 'min:5'],
            'slug' => ['required', 'min:5', 'max:100'],
            'category_id' => ['required', 'max:100'],
            'due' => ['required'],
            'description' => ['required'],
            'status' => ['required', 'max:10']
        ]);
        
        // Ambil user_id, dan excerpt
        $validation['user_id'] = auth()->user()->id;

        // Lakukan create
        Todolist::create($validation);

        return redirect('/todolists')->with('toast_success', 'Todolist Created Successfully!');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Todolist  $todolist
     * @return \Illuminate\Http\Response
     */
    public function show(Todolist $todolist)
    {
        if ($todolist->owner->id !== auth()->user()->id) {
            abort(403);
        }
        return view('dashboard/todolists/_detail', [
            'title' => $todolist->title,
            'todolist' => $todolist
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Todolist  $todolist
     * @return \Illuminate\Http\Response
     */
    public function edit(Todolist $todolist)
    {
        if ($todolist->owner->id !== auth()->user()->id) {
            abort(403);
        }
        return view('dashboard/todolists/form/edit', [
            'title' => 'Edit ' . $todolist->title,
            'todolist' => $todolist,
            'categories' => Category::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Todolist  $todolist
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Todolist $todolist)
    {
        $validation = [
            'title' => ['required', 'max:100', 'min:5'],
            'slug' => ['required', 'min:5', 'max:100'],
            'category_id' => ['required', 'max:100'],
            'due' => ['required'],
            'description' => ['required'],
            'status' => ['required', 'max:10']
        ];

        if ($request->slug != $todolist->slug)
        {
            $rules['slug'] = ['required', 'min:5', 'max:100'];
        }

        // Pass validation
        $validationData = $request->validate($validation);

        // Get user_id
        $validationData['user_id'] = auth()->user()->id;

        // Update to-do list
        Todolist::where('id', $todolist->id)->update($validationData);
        
        return redirect('/todolists')->with('toast_success', 'Todolist Updated Successfully!');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Todolist  $todolist
     * @return \Illuminate\Http\Response
     */
    public function destroy(Todolist $todolist)
    {
        Todolist::destroy($todolist->id);

        return redirect('/todolists')->with('toast_success', 'Todolist Deleted Successfully!');
    }
}
