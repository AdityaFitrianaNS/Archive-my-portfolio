<?php

namespace App\Http\Controllers;

use App\Models\Todolist;

class DashboardStatusController extends Controller
{
    public function finished()
    {
        return view('dashboard/status/finished', [
            'title' => 'Task Finished',
            'finished' => Todolist::where('status', 'Finished')->where('user_id', auth()->user()->id)->paginate(6)->withQueryString(),
        ]);
    }

    public function unfinished()
    {
        return view('dashboard/status/unfinished', [
            'title' => 'Task Unfinished',
            'unfinished' => Todolist::where('status', 'Unfinished')->where('user_id', auth()->user()->id)->paginate(6)->withQueryString(),
        ]);
    }
}
