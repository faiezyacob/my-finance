<?php


namespace App\Http\Controllers;

use App\Goal;
use App\Finance;

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
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $id = \Auth::user()->id;
        $goals = Goal::where('user_id', $id)->get();
        $finances = Finance::where('user_id', $id)->get();
        $total = 0;

        foreach ($finances as $finance)
        {
            $total = $total + $finance->amount;
        }
        
        return view('dashboard', compact('goals', 'total'));
    }
}
