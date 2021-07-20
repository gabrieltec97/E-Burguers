<?php

namespace App\Http\Controllers;

use App\Adverts;
use App\Extras;
use App\Tray;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Symfony\Component\Console\Input\Input;

class menuController extends Controller
{

    public function foodMenu($insert)
    {
        $foods = Adverts::all();
        $tray = Auth::user()->userOrderTray()->select('id')->get();
        $val = Auth::user()->userOrderTray()->select('totalValue')->get()->toArray();

        if (isset($tray[0]->id)){
            $items = DB::table('item_without_extras')
                ->select('itemName')
                ->where('idOrder', '=', $tray[0]->id)
                ->get()->toArray();

            $query = DB::table('auxiliar_detacheds')
                ->select('item', 'nameExtra')
                ->where('idOrder', '=', $tray[0]->id)
                ->get()->toArray();

            $itemWExtras = array();

            foreach ($query as $it){
                array_push($itemWExtras, $it->item . ' + ' . $it->nameExtra);
            }
        }

        foreach ($foods as $food){
            $foodFormat = explode(',', $food->extras);
            $one = array();
            foreach ($foodFormat as $t){
                $extra = DB::table('extras')
                    ->select('namePrice')
                    ->where('name', '=', $t)
                    ->get()->toArray();

                foreach ($extra as $ext){
                    array_push($one, $ext->namePrice);
                    $food->extras = $one;
                }
            }
        }


        if(isset($tray[0]->id)){
            return view('clientUser.foodMenu.foodMenu', compact('foods', 'insert', 'tray', 'items', 'val', 'itemWExtras'));
        }else{
            return view('clientUser.foodMenu.foodMenu', compact('foods', 'insert'));
        }
    }

    public function index()
    {
        $meals = Adverts::all();
        return view('adverts.advertsManagement', compact('meals'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $items = Extras::all();

        if (count($items) != 0){
            return view('adverts.newAdv', compact('items'));
        }else{
            return view('adverts.newAdv');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $rules = [
            'mealValue' => 'required',
            'mealName' => 'required|min:4|max:35',
            'promoValue' => 'required',
            'mealDescription' => 'required|min:70|max:90'

        ];

        $messages = [
            'mealName.required' => 'Por favor, insira o nome da refeição.',
            'mealName.min' => 'O nome da refeição deve conter no mínimo 4 caracteres.',
            'mealName.max' => 'O nome da refeição não pode ter mais de 35 caracteres.',
            'valComboPromo.required' => 'Por favor, insira o valor propocional.',
            'disccount.required' => 'Por favor, insira o descondo a ser aplicado.',
            'ingredients.required' => 'Por favor, insira os ingredientes da refeição.',
            'mealDescription.required' => 'Por favor, insira a descrição da refeição.',
            'mealDescription.min' => 'Este campo deve conter no mínimo 70 caracteres',
            'mealDescription.max' => 'Este campo deve conter no máximo 90 caracteres'
        ];

        $request->validate($rules, $messages);

        $adverts = DB::table('adverts')
            ->select('name')
            ->get()->toArray();

        foreach ($adverts as $ad){
            if ($request->mealName == $ad->name){
                return redirect()->back()->withInput()->with('msg', 'Já existe uma refeição cadastrada com este nome. Por favor insira um nome diferente ou verifique a lista de itens');
            }
        }


//        $advert = new Adverts();
//
//        $advert->name = $request->mealName;
//        $advert->value = $request->mealValue;
//        $advert->ingredients = $request->ingredients;
//        $advert->foodType = $request->tipoRef;
//        $advert->tastes = $request->sabores;
//
//        if (isset($request->extras)){
//            $extras = implode(',', $request->extras);
//            $advert->extras = $extras;
//        }
//
//
//        if(isset($_POST['combo'])){
//            $advert->combo = $_POST['combo'];
//        }
//
//        $advert->description = $request->mealDescription;
//        $advert->comboValue = $request->promoValue;
//
//
//        if($request->hasFile('advPhoto')){
//           $image = $request->file('advPhoto');
//           $extension = $image->getClientOriginalExtension();
//
//           if ($extension != 'png' && $extension != 'jpg' && $extension != 'jpeg' && $extension != 'gif'){
//              return back()->with('msg', 'Não foi possível fazer o upload da imagem. Por favor, insira uma imagem no formato png ou jpg.
//              Você inseriu um arquivo no formato .'.$extension);
//           }
//        }
//
//        if($request->hasFile('advPhoto')){
//            $number = rand(1, 2000000);
//            File::move($image, public_path(). '/imagens/img'.$number.'.'.$extension);
//            $advert->picture = 'imagens/img'.$number.'.'.$extension;
//        }else{
//            $advert->picture = 'logo/hamburguer.jpg';
//        }
//
//        $advert->save();
//
//      return redirect(route('refeicoes.index'))->with('msg-2', 'A refeição foi cadastrada com sucesso e já está disponível no');
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
        $meal = Adverts::find($id);

        return view('adverts.advShow', compact('meal'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $meal = Adverts::find($id);
        $extras = Extras::all();
        $options = array();

        foreach ($extras as $ext => $val){
            array_push( $options, $val['name']);
        }

        //Juntando extras do lanche com os extras gerais.
        $xtras = explode(',', $meal->extras);
        foreach ($xtras as $xt){
            array_push($options, $xt);
        }

        $count = array_count_values($options);

        return view('adverts.advEdit', compact('meal', 'count'));
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
            'mealName' => 'required|min:4|max:35',
            'mealValue' => 'required|min:5|max:5',
            'mealDescription' => 'required|min:70|max:90'
        ];

        $messages = [
            'mealName.required' => 'Por favor, insira o nome da refeição.',
            'mealName.min' => 'O nome da refeição deve conter no mínimo 4 caracteres.',
            'mealName.max' => 'O nome da refeição não pode ter mais de 20 caracteres.',
            'mealValue.required' => 'Por favor, insira o valor da refeição.',
            'mealValue.min' => 'Por favor, insira um valor válido.',
            'promoValue.required' => 'Por favor, insira o valor propocional.',
            'promoValue.min' => 'Por favor, insira um valor válido.',
            'disccount.required' => 'Por favor, insira o descondo a ser aplicado.',
            'ingredients.required' => 'Por favor, insira os ingredientes da refeição.',
            'mealDescription.required' => 'Por favor, insira a descrição da refeição.',
            'mealDescription.min' => 'Este campo deve conter no mínimo 70 caracteres',
            'mealDescription.max' => 'Este campo deve conter no máximo 96 caracteres'
        ];

        $request->validate($rules, $messages);

        $advert = Adverts::find($id);

        $advert->name = $request->mealName;
        $advert->value = $request->mealValue;
        $advert->ingredients = $request->ingredients;
        $advert->tastes = $request->sabores;

        if(isset($_POST['combo'])){
            $advert->combo = $_POST['combo'];
        }
        $advert->description = $request->mealDescription;
        $advert->comboValue = $request->promoValue;

        if ($request->extras != ''){
            $addExtra = implode(',', $request->extras);
            $advert->extras = $addExtra;
        }


        $advert->save();

        return redirect(route('refeicoes.show', $id))->with('msg', 'Anúncio alterado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $advert = Adverts::find($id);

        $advert->destroy($id);

        File::delete($advert->picture);

        return redirect(route('refeicoes.index', $id))->with('msg', 'Anúncio deletado com sucesso!');
    }
}
