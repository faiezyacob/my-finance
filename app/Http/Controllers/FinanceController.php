<?php

namespace App\Http\Controllers;

use App\Finance;
use App\User;
use App\Goal;
use Illuminate\Http\Request;

class FinanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = \Auth::user()->id;
        $goals = Goal::where('user_id', $id)->get();
        $finances = Finance::where('user_id', $id)->orderBy('created_at', 'desc')->paginate(10);
        $total = 0;

        foreach ($finances as $finance)
        {
            $total = $total + $finance->amount;
        }
        return view('finance.index', compact('finances', 'goals', 'total'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('finance.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id = \Auth::user()->id;
        $finance = new Finance();
        $finance->amount = $request->get('amount');
        $finance->user_id = $id;
        $finance->save();

        return redirect()->route('finance.index')->withStatus(__('Congratulations! You have increased your saving.'));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Finance  $finance
     * @return \Illuminate\Http\Response
     */
    public function show(Finance $finance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Finance  $finance
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $finances = Finance::where('id', $id)->get();
        // dd($finances);
        return view('finance.edit', compact('finances'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Finance  $finance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $finance = Finance::find($id);
        // dd($finance);
        $finance->amount = $request->get('amount');
        $finance->save();

        return redirect()->route('finance.index')->withStatus(__('Record has been updated.'));
     }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Finance  $finance
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $finance = Finance::find($id);
        $finance->delete();

        return redirect()->route('finance.index')->withStatus(__('Record has been deleted.'));
    }
}
