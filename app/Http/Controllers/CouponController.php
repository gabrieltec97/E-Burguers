<?php

namespace App\Http\Controllers;

use App\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $couponsOld = DB::table('coupons')->get()->toArray();
        $date = date('Y'. '-' . 'm' . '-' . 'd');

        foreach ($couponsOld as $c){

            if ($c->expireDate == $date){
                $delete = Coupon::find($c->id);
                $delete->destroy($c->id);
            }
        }

        $coupons = DB::table('coupons')->get()->toArray();

        return view('Coupons.couponsManagement', compact('coupons'));
    }

    public function create()
    {
        //Não foi necessária a utilização, uma vez que se cria os cupons na mesma view que olha os que estão ativos.
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $date = date('Y'. '-' . 'm' . '-' . 'd');

        $rules = [
            'couponName' => 'required|min:5|max:14',
            'expireDate' => 'required|date',
            'expireDate' => 'different:',
            'disccount' => 'required',
            'disccountRule' => 'required|max:5'

        ];

        $messages = [
            'couponName.required' => 'Por favor, insira o nome do cupom',
            'couponName.min' => 'O nome do cupom deve conter no mínimo 5 caracteres',
            'couponName.max' => 'O nome do cupom não pode ter mais de 14 caracteres',
            'expireDate.required' => 'Por favor, insira a data de expiração',
            'expireDate.date' => 'Data inválida! Insira uma data correta',
            'disccount.required' => 'Por favor, insira o descondo a ser aplicado',
            'disccountRule.required' => 'Por favor, insira a regra de desconto',
            'disccountRule.max' => 'Este campo só pode ter no máximo 5 caracteres'
        ];

        $request->validate($rules, $messages);

        $coupon = new Coupon();

        $coupon->name = $request->couponName;
        $coupon->expireDate = $request->expireDate;
        $coupon->disccount = $request->disccount;
        $coupon->disccountRule = $request->disccountRule;

        $coupon->save();

        return redirect(route('cupons.index'))->with('msg', 'Cupom cadastrado com sucesso!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $coupon = Coupon::find($id);
        return view ('Coupons.couponEditing', compact('coupon'));
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
        $rules = [
            'couponName' => 'required|min:5|max:14',
            'expireDate' => 'required|date',
            'disccount' => 'required',
            'disccountRule' => 'required|max:5'

        ];

        $messages = [
            'couponName.required' => 'Por favor, insira o nome do cupom',
            'couponName.min' => 'O nome do cupom deve conter no mínimo 5 caracteres',
            'couponName.max' => 'O nome do cupom não pode ter mais de 14 caracteres',
            'expireDate.required' => 'Por favor, insira a data de expiração',
            'expireDate.date' => 'Data inválida! Insira uma data correta',
            'disccount.required' => 'Por favor, insira o descondo a ser aplicado',
            'disccountRule.required' => 'Por favor, insira a regra de desconto',
            'disccountRule.max' => 'Este campo só pode ter no máximo 5 caracteres'
        ];

        $request->validate($rules, $messages);

        $coupon = Coupon::find($id);

        $coupon->name = $request->couponName;
        $coupon->expireDate = $request->expireDate;
        $coupon->disccount = $request->disccount;
        $coupon->disccountRule = $request->disccountRule;

        $coupon->save();

        return redirect(route('cupons.index'))->with('msg', 'Cupom alterado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $coupon = Coupon::find($id);

        $coupon->destroy($id);

        return redirect(route('cupons.index'))->with('msg-2', 'Cupom deletado com sucesso!');
    }
}
