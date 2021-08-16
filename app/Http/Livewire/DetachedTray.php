<?php

namespace App\Http\Livewire;

use App\Adverts;
use App\ItemWithoutExtras;
use App\Tray;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class DetachedTray extends Component
{

    public function render()
    {
        $foods = Adverts::all();
        $tray = Auth::user()->userOrderTray()->select('id')->get();
        $val = Auth::user()->userOrderTray()->select('totalValue')->get()->toArray();

        if (isset($tray[0]->id)) {
            $items = DB::table('item_without_extras')
                ->select('itemName', 'id')
                ->where('idOrder', '=', $tray[0]->id)
                ->get()->toArray();

            $query = DB::table('auxiliar_detacheds')
                ->select('item', 'nameExtra', 'id')
                ->where('idOrder', '=', $tray[0]->id)
                ->get()->toArray();

            $itemWExtras = array();

            foreach ($query as $it) {
                array_push($itemWExtras, ['name' => $it->item . ' + ' . $it->nameExtra, 'id' => $it->id]);
            }
        }

        if (isset($tray[0]->id)) {
            $items = DB::table('item_without_extras')
                ->select('itemName', 'id')
                ->where('idOrder', '=', $tray[0]->id)
                ->get()->toArray();

            $query = DB::table('auxiliar_detacheds')
                ->select('item', 'nameExtra', 'id')
                ->where('idOrder', '=', $tray[0]->id)
                ->get()->toArray();

            $itemWExtras = array();

            foreach ($query as $it) {
                array_push($itemWExtras, ['name' => $it->item . ' + ' . $it->nameExtra, 'id' => $it->id]);
            }
        }

        foreach ($foods as $food) {
            $foodFormat = explode(',', $food->extras);
            $one = array();
            foreach ($foodFormat as $t) {
                $extra = DB::table('extras')
                    ->select('namePrice')
                    ->where('name', '=', $t)
                    ->get()->toArray();

                foreach ($extra as $ext) {
                    array_push($one, $ext->namePrice);
                    $food->extras = $one;
                }
            }
        }

        $rate = DB::table('lock_rating')
            ->get();

        if (isset($rate[0])) {
            $rate = $rate[0]->lock;
        } else {
            $rate = "Não";
        }

        if (isset($items)) {
            return view('livewire.detached-tray', compact('foods', 'rate', 'items', 'val'));
        } else {
            return view('livewire.detached-tray', compact('foods', 'rate'));
        }
    }

    public function insertItem(Request $request, $item)
    {
        $user = Auth::user()->id;
        $item = Adverts::find($item);

        //Verificando se o usuário possui um pedido.
        $verifyOrder = Auth::user()->userOrderTray()->get()->first();

        if (isset($request['ingredients'])) {
            $requirements = implode(', ', $request['ingredients']);
        }

        if ($verifyOrder == null) {

            if (isset ($request->extras)) {

                $order = new Tray();
                $order->idClient = $user;
                $order->orderType = "Avulso";
                $order->day = date('d/m/Y');
                $order->hour = date('H:i');

                //Buscando acompanhamento.
                $extras = [];
                $valorNovo = 0;

                foreach ($request->extras as $ex) {
                    $extra = DB::table('extras')
                        ->select('name')
                        ->where('namePrice', '=', $ex)
                        ->get()->toArray();

                    foreach ($extra as $e => $value) {
                        array_push($extras, $value);
                    }
                }

                //Somando os valores dos itens adicionais
                foreach ($request->extras as $exts) {
                    $vals = DB::table('extras')
                        ->select('price')
                        ->where('namePrice', '=', $exts)
                        ->get()->toArray();

                    foreach ($vals as $v => $vls) {
                        $valorNovo += doubleval($vls->price);
                    }
                }

                //Ajustando o array que recebe os itens adicionais
                $add = [];

                foreach ($extras as $ext => $val) {
                    array_push($add, $val->name);
                }

                $addItems = implode(', ', $add);

                $order->extras = $addItems;
                $order->totalValue = $item->value + $valorNovo;
                $order->valueWithoutDisccount = $item->value + $valorNovo;

                $order->save();

                $auxItems = new AuxiliarDetached();
                $auxItems->item = $item->name;
                $auxItems->idOrder = $order->id;
                $auxItems->foodType = $item->foodType;

                if (isset($requirements)) {
                    $auxItems->extras = $item->name . ": " . $requirements;
                }

                $auxItems->nameExtra = $addItems;
                $auxItems->valueWithExtras = $item->value + $valorNovo;
                $auxItems->save();

            } else {

                //Inserindo itens sem extras.
                $order = new Tray();
                $order->idClient = $user;
                $order->orderType = "Avulso";
                $order->day = date('d/m/Y');
                $order->hour = date('H:i');
                $order->totalValue = $item->value;
                $order->valueWithoutDisccount = $item->value;
                $order->save();

                $itemWithoutExtras = new ItemWithoutExtras();
                $itemWithoutExtras->idOrder = $order->id;
                $itemWithoutExtras->foodType = $item->foodType;

                if (isset($request['ingredients'])) {
                    $itemWithoutExtras->item = $item->name . ': ' . $requirements;
                } else {
                    $itemWithoutExtras->item = $item->name;
                }

                if ($request->sabor == '') {
                    $itemWithoutExtras->itemName = $item->name;
                } else {
                    $itemWithoutExtras->itemName = $item->name . ' sabor: ' . $request->sabor;
                }

                $itemWithoutExtras->value = $item->value;
                $itemWithoutExtras->save();
            }

            return redirect(route('cardapio', $insert = 'added'));

        } else {

            $order = Tray::find($verifyOrder->id);

            if (isset ($request->extras)) {
                //Buscando acompanhamento.
                $extras = [];
                $valorNovo = 0;

                foreach ($request->extras as $ex) {
                    $extra = DB::table('extras')
                        ->select('name')
                        ->where('namePrice', '=', $ex)
                        ->get()->toArray();

                    foreach ($extra as $e => $value) {
                        array_push($extras, $value);
                    }
                }

                //Somando os valores dos itens adicionais
                foreach ($request->extras as $exts) {
                    $vals = DB::table('extras')
                        ->select('price')
                        ->where('namePrice', '=', $exts)
                        ->get()->toArray();

                    foreach ($vals as $v => $vls) {
                        $valorNovo += doubleval($vls->price);
                    }
                }

                //Ajustando o array que recebe os itens adicionais

                $add = [];

                foreach ($extras as $ext => $val) {
                    array_push($add, $val->name);
                }

                $addItems = implode(', ', $add);

                $order->extras = $addItems;
                $order->valueWithoutDisccount = $order->totalValue + $item->value + $valorNovo;
                $order->totalValue = $order->totalValue + $item->value + $valorNovo;
                $order->save();

                $auxItems = new AuxiliarDetached();
                $auxItems->item = $item->name;
                $auxItems->idOrder = $order->id;
                $auxItems->foodType = $item->foodType;

                if (isset($requirements)) {
                    $auxItems->extras = $item->name . ": " . $requirements;
                }

                $auxItems->nameExtra = $addItems;
                $auxItems->valueWithExtras = $item->value + $valorNovo;
                $auxItems->save();

            } else {

                $updated = Tray::find($verifyOrder->id);

                $itemWithoutExtras = new ItemWithoutExtras();
                $itemWithoutExtras->idOrder = $order->id;
                $itemWithoutExtras->foodType = $item->foodType;

                if (isset($request['ingredients'])) {
                    $itemWithoutExtras->item = $item->name . ': ' . $requirements;
                } else {
                    $itemWithoutExtras->item = $item->name;
                }

                $itemWithoutExtras->itemName = $item->name;
                $itemWithoutExtras->value = $item->value;
                $itemWithoutExtras->save();

                $order->totalValue = $updated->totalValue + $item->value;
                $order->valueWithoutDisccount = $updated->totalValue + $item->value;
            }

            $order->save();

            session()->flash('message', 'Post successfully updated.');
        }
    }

    public function removeItem($remove)
    {
        $order = Auth::user()->userOrderTray()->get()->first()->toArray();
        $item = DB::table('item_without_extras')
            ->select()
            ->where('id', '=', $remove)
            ->get()->toArray();

        //Abatendo o preço na tabela de pedido.
        $updateOrder = $order['totalValue'] - $item[0]->value;

        DB::table('trays')
            ->where('id', '=', $order['id'])
            ->update(['totalValue' => $updateOrder]);

        //Deletando o item da tabela de itens sem extras.
        DB::table('item_without_extras')
            ->where('id', '=', $remove)
            ->delete();

    }
}
