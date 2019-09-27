<?php

namespace App\Http\Controllers;

use App\Goal;
use App\Finance;
use Illuminate\Http\Request;

class GoalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = \Auth::user()->id;
        $goals = Goal::where('user_id', $id)->paginate(10);
        $finances = Finance::where('user_id', $id)->get();
        $total = 0;

        foreach ($finances as $finance)
        {
            $total = $total + $finance->amount;
        }
        return view('goal.index', compact('goals', 'total'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('goal.create');
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
        // $check = Goal::where('user_id',$id)->get();
        // foreach ($check as $test)
        // {
        //     if ($test->type == $request->type)
        //         return redirect()->route('goal.index')->withError(__($request->type.' already exist.'));
        // }
        // dd($check);

        $goal = new Goal();
        $goal->goal = $request->amount;
        $goal->description = $request->description;
        $goal->user_id = $id;
        $goal->save();

        return redirect()->route('goal.index')->withStatus(__('New record successfully added.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Goal  $goal
     * @return \Illuminate\Http\Response
     */
    public function show(Goal $goal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Goal  $goal
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $goals = Goal::where('id', $id)->get();
        return view('goal.edit', compact('goals'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Goal  $goal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $goal = Goal::find($id);
        $goal->goal = $request->get('amount');
        $goal->description = $request->get('description');
        $goal->save();

         return redirect()->route('goal.index')->withStatus(__('Record has been updated.'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Goal  $goal
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $goal = Goal::find($id);
        $goal->delete();

        return redirect()->route('goal.index')->withStatus(__('Record has been deleted.'));
    }
}
