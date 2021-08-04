<?php

namespace App\Http\Controllers;

use App\Adverts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RatingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function evaluate()
    {
        $items = Adverts::all()->where('foodType', '<>', 'Bebida');
        $eval = \App\User::find(Auth::user()->id);
        $eval = explode(',', $eval->itemsRated);
        $itensToEvaluate = array();

        foreach ($items as $item){
            $evaluate = DB::table('orders')
                ->where('detached', 'like', '%'. $item->name . '%')
                ->where('idClient', '=', Auth::user()->id)
                ->get()->toArray();

            if (count($evaluate) != ''){
                array_push($itensToEvaluate, [$item->id, $item->name, $item->picture]);
            }
        }

        foreach ($eval as $ev){
            foreach ($itensToEvaluate as $i => $value){
                if ($ev == $value[0]){
                    unset($itensToEvaluate[$i]);
                }
            }
        }

        return view('Assessments.ItemsEvaluate', compact('itensToEvaluate'));
    }

    public function sendRating(Request $request, $id)
    {
        $item = Adverts::find($id);

        if ($item->ratingGrade == null){
            $item->ratingGrade = $request->radio1;
        }else{
            $item->ratingGrade += $request->radio1;
        }

        if ($item->ratingAmount == null){
            $item->ratingAmount = 1;
        }else{
            $item->ratingAmount += 1;
        }

        if ($item->finalGrade != null){
            $item->finalGrade = $item->ratingGrade / $item->ratingAmount;
        }else{
            $item->finalGrade = $request->radio1;
        }

        $item->save();

        $user = \App\User::find(Auth::user()->id);
        if ($user->itemsRated == null){
            $user->itemsRated = $id;
        }else{
            $user->itemsRated = $user->itemsRated . ',' . $id;
        }

        $user->save();

        return redirect()->back()->with('msg', ' ');
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
