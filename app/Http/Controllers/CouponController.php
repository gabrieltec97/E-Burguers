<?php

namespace App\Http\Controllers;

use App\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Exceptions\UnauthorizedException;
use Symfony\Component\HttpKernel\Exception\HttpException;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!Auth::user()->hasPermissionTo('Cupons')){
            throw new UnauthorizedException('403', 'Opa, você não tem acesso para esta rota.');
        }

        date_default_timezone_set('America/Sao_Paulo');
        $couponsOld = DB::table('coupons')->get()->toArray();
        $date = date('Y'. '-' . 'm' . '-' . 'd');

        foreach ($couponsOld as $c){

            if ($c->expireDate <= $date){
                $delete = Coupon::find($c->id);
                $delete->destroy($c->id);
            }
        }

        $coupons = DB::table('coupons')->get()->toArray();

        return view('Coupons.couponsManagement', compact('coupons', 'date'));
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
        if(!Auth::user()->hasPermissionTo('Cupons')){
            throw new UnauthorizedException('403', 'Opa, você não tem acesso para esta rota.');
        }

        $rules = [
            'couponName' => 'required|min:5|max:14',
            'expireDate' => 'required|date',
            'disccount' => 'required',
            'disccountRule' => 'required|min:3|max:6'
        ];

        $messages = [
            'couponName.required' => 'Por favor, insira o nome do cupom',
            'couponName.min' => 'O nome do cupom deve conter no mínimo 5 caracteres',
            'disccountRule.min' => 'O valor do cupom deve conter no mínimo 3 caracteres',
            'couponName.max' => 'O nome do cupom não pode ter mais de 14 caracteres',
            'expireDate.required' => 'Por favor, insira a data de expiração',
            'expireDate.date' => 'Data inválida! Insira uma data correta',
            'disccount.required' => 'Por favor, insira o descondo a ser aplicado',
            'disccountRule.required' => 'Por favor, insira a regra de desconto',
            'disccountRule.max' => 'Este campo só pode ter no máximo 5 caracteres'
        ];

        $request->validate($rules, $messages);

        $coupons = DB::table('coupons')
            ->select('name')
            ->get()->toArray();

        foreach ($coupons as $c){
            if ($request->couponName == $c->name){
                return back()->withInput()->with('msg-2', 'Cupom não cadastrado! Já existe um cupom registrado com este nome, consulte a lista de cupons ativos.');
            }
        }

        date_default_timezone_set('America/Sao_Paulo');
        $date = date('Y'. '-' . 'm' . '-' . 'd');

        if ($request->expireDate == $date){
            return back()->with('msg-2', 'Cupom não cadastrado! A data de expiração deve ser diferente da data atual.');
        }

        $name = DB::table('coupons')
            ->select('name')
            ->where('name', '=', $request->couponName)
            ->get()->toArray();

        if (count($name) != 0){
            return back()->with('msg-2', 'Cupom não cadastrado! Já existe um cupom cadastrado com este nome.');
        }

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
        if(!Auth::user()->hasPermissionTo('Cupons')){
            throw new UnauthorizedException('403', 'Opa, você não tem acesso para esta rota.');
        }

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
        if(!Auth::user()->hasPermissionTo('Cupons')){
            throw new UnauthorizedException('403', 'Opa, você não tem acesso para esta rota.');
        }

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
        if(!Auth::user()->hasPermissionTo('Cupons')){
            throw new UnauthorizedException('403', 'Opa, você não tem acesso para esta rota.');
        }

        $coupon = Coupon::find($id);

        $coupon->destroy($id);

        return redirect(route('cupons.index'))->with('msg-2', 'Cupom deletado com sucesso!');
    }
}
