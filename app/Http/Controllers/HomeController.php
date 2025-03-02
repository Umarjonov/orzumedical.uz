<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\CallBack;
use App\Models\Video;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function index()
    {
        $videos = Video::where('status','active')->count();
        $branch = Branch::where('status','active')->count();
        $lead_count = CallBack::count();
        $leads = CallBack::latest()->limit(6)->get();
        return view('dashboard',compact('videos','branch','leads','lead_count'));
    }

    public function cache_clear()
    {
        Artisan::call('clear:all', [
            '--force' => true
        ]);
        return redirect()->route('/');
    }
}
