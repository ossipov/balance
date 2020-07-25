<?php

namespace App\Http\Controllers;

use App\Balance;
use Illuminate\Http\Request;

class BalanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $data = Balance::select('id','label','date','amount')->orderBy('date', 'desc')->paginate(100);
        $total = Balance::sum('amount');

        $data = json_encode($data->toArray() + ['total_balance' => $total]);

        if($request->ajax()){
            return $data;
        }
        return view('user-balance', [
            'data' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $entry = new Balance;
        $entry->label = $request->label;
        $entry->date = $request->date;
        $entry->amount = $request->amount;
        $entry->save();

        return response($entry);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\balance  $balance
     * @return \Illuminate\Http\Response
     */
    public function show(balance $balance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\balance  $balance
     * @return \Illuminate\Http\Response
     */
    public function edit(balance $balance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Balance  $balance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $entry = Balance::findOrFail($request->id);
        $entry->label = $request->label;
        $entry->date = $request->date;
        $entry->amount = $request->amount;
        $entry->save();
        return $entry;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Balance  $balance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Balance $balance, Request $request)
    {
        return Balance::findOrFail($request->id)->delete();
    }
}
