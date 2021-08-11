<?php

namespace App\Http\Controllers;

use App\Adverts;
use App\Rating;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Exceptions\UnauthorizedException;
use Symfony\Component\HttpKernel\Exception\HttpException;

class RatingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!Auth::user()->hasPermissionTo('Avaliações')){
//            throw new UnauthorizedException('403', 'Opa, você não tem acesso para esta rota.');
            return redirect()->back();
        }

        $rating = Rating::all()->toArray();
        $grade = 0;

        foreach ($rating as $r){
            $grade += $r['ratingGrade'];
        }

        $grade = $grade / count($rating);

        $data = [
          'count' => count($rating),
          'grade' => round($grade, 1)
        ];

        return view ('Assessments.assessments', compact('rating', 'data'));
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

        $rated = DB::table('ratings')
            ->where('idUser', '=', Auth::user()->id)
            ->get()->toArray();

        $orders = DB::table('orders')
            ->where('idClient', '=', Auth::user()->id)
            ->get();

        $rated = [
            'rated' => count($rated),
            'ordered' => count($orders)
        ];

        return view('Assessments.ItemsEvaluate', compact('itensToEvaluate', 'rated'));
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

    public function rate(Request $request)
    {
        $rated = DB::table('ratings')
            ->where('idUser', '=', Auth::user()->id)
            ->get()->toArray();

        if (count($rated) == 0){
            $rate = new Rating();
            $rate->idUser = Auth::user()->id;
            $rate->ratingGrade = $request->radio1;
            $rate->comments = $request->opiniao;

            $rate->save();
        }else{
            DB::table('ratings')
                ->where('idUser', '=', Auth::user()->id)
                ->update(['ratingGrade' => $request->radio1, 'comments' => $request->opiniao]);
        }

        return redirect()->back()->with('msg', ' ');
    }

    public function sendNotification()
    {
        $items = DB::table('adverts')
            ->select('picture', 'name', 'id')
            ->where('foodType', '<>', 'Bebida')
            ->get()->toArray();

        $eval = Auth::user();
        $eval = explode(',', $eval->itemsRated);
        $rate = array();

        foreach ($items as $item){
            $evaluate = DB::table('orders')
                ->where('detached', 'like', '%'. $item->name . '%')
                ->where('idClient', '=', Auth::user()->id)
                ->get()->toArray();

            if (count($evaluate) != ''){
                array_push($rate, [$item->id, $item->name, $item->picture]);
            }
        }

        foreach ($eval as $ev){
            foreach ($rate as $i => $value){
                if ($ev == $value[0]){
                    unset($rate[$i]);
                }
            }
        }

        return $rate;
    }
}
