@extends('layouts.extend-client')
<script src="{{ asset('js/jquery.js') }}"></script>

@section('title')
    Finalizar compra
@endsection

@section('content')
    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-lg-12 mt-4 col-sm-12">
                <h1 class="titulo-cardapio text-center mb-4">Vamos revisar o pedido antes de finalizar a compra.</h1>
                <hr>
            </div>

            <div class="col-12 mt-3">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12 col-lg-4 mb-4 mb-lg-0">
                            @if(session('msg'))
                                <div class="alert alert-danger alerta-sucesso-ref alert-dismissible fade show" role="alert">
                                    <span class="font-weight-bold">Poxa!</span> {{ session('msg') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            @if(session('msg-success'))
                                <div class="alert alert-success alerta-sucesso-user mt-2 alert-dismissible fade show" role="alert">
                                    <span class="text-muted font-weight-bold">Cupom inserido com sucesso!</span>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            @if(session('msg-exp') or session('msg-use'))
                                <div class="alert alert-danger alerta-sucesso-user mt-2 alert-dismissible fade show" role="alert">
                                    <span class="text-muted font-weight-bold">{{ session('msg-exp') }} {{ session('msg-use') }} </span>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            <div class="card">
                                <div class="card-header bg-danger">
                                    <h5 class="font-weight-bold text-white"><i class="fas fa-hamburger mr-2"></i>Seu pedido está assim</h5>
                                </div>
                                <div class="card-body">

                                    <div class="col-12">
                                        <ul>
                                            @if($myOrder['orderType'] == 'Combo')
                                                @if(isset($myOrder['hamburguer']))
                                                    <form action="{{ route('minhaBandeja.destroy', $food = $myOrder['comboItem']) }}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                            <li class="font-weight-bold" style="position: relative; right: 20px">{{ $myOrder['comboItem'] }} <button type="submit" class="removeItem ml-1" title="Remover item"><i class="fas fa-times text-danger"></i></button></li>
                                                    </form>

                                                   <div style="margin-top: -13px">
                                                       @if(isset($myOrder['extras']))
                                                           <ol>
                                                             @foreach(explode(', ', $myOrder['extras']) as $extra)
                                                                <li class="font-weight-bold mt-1">{{$extra}}
                                                                <button class="removeItem ml-1" title="Editar itens extras" data-toggle="modal" data-target="#editarExtrasCombo"><i class="fas fa-edit text-primary" style="font-size: 16px"></i></button></li>
                                                             @endforeach
                                                           </ol>

                                                           <form action="{{ route('editarComboExtras') }}">
                                                               @csrf

                                                               <div class="modal fade" id="editarExtrasCombo" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                                   <div class="modal-dialog modal-dialog-centered" role="document">
                                                                       <div class="modal-content">
                                                                           <div class="modal-header">
                                                                               <h5 class="modal-title font-weight-bold" id="exampleModalLongTitle">Edição de itens adicionais</h5>
                                                                               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                   <span aria-hidden="true">&times;</span>
                                                                               </button>
                                                                           </div>
                                                                           <div class="modal-body">
                                                                               <div class="container-fluid">
                                                                                   <div class="row">
                                                                                       <div class="col-6">
                                                                                           <img src="{{ asset($myOrder['image']) }}" style="border-radius: 4px" class="img-fluid" alt="">
                                                                                       </div>

                                                                                       <div class="col-6">

                                                                                            @foreach($addons as $addon)
                                                                                               <div>
                                                                                                   <input class="ml-1 form-check-input" type="checkbox" id="ing" name="ingredients[]" value="{{ $addon }}"

                                                                                                   @foreach(explode(', ', $myOrder['extras']) as $extra)
                                                                                                       @if($extra == $addon)
                                                                                                        checked
                                                                                                       @endif
                                                                                                   @endforeach

                                                                                                   >
                                                                                                   <span class="text-muted font-weight-bold ml-4 form-check-label">{{ $addon }}</span>
                                                                                               </div>
                                                                                            @endforeach
                                                                                       </div>
                                                                                   </div>
                                                                               </div>
                                                                           </div>
                                                                           <div class="modal-footer">
                                                                               <button type="button" class="btn btn-primary font-weight-bold" data-dismiss="modal">Fechar</button>
                                                                               <button type="submit" class="btn btn-success font-weight-bold">Salvar alterações</button>
                                                                           </div>
                                                                       </div>
                                                                   </div>
                                                               </div>
                                                           </form>
                                                       @endif
                                                   </div>

                                                @else
                                                    <li style="position: relative; right: 20px"><a href="{{ route('minhaBandeja.index') }}" class="text-danger font-weight-bold">Escolha um hambúrguer</a></li>
                                                @endif


                                                @if(isset($myOrder['portion']))
                                                    <form action="{{ route('minhaBandeja.destroy', $food = $myOrder['portion']) }}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <li class="font-weight-bold" style="position: relative; right: 20px">{{ $myOrder['portion'] }} <button type="submit" class="removeItem ml-1" title="Remover item"><i class="fas fa-times text-danger"></i></button></li>
                                                    </form>
                                                @else
                                                    <li style="position: relative; right: 20px"><a href="{{ route('minhaBandeja.index') }}" class="text-danger font-weight-bold">Escolha uma porção</a></li>
                                                @endif

                                                @if(isset($myOrder['drinks']))
                                                    <form action="{{ route('minhaBandeja.destroy', $food = $myOrder['drinks']) }}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <li class="font-weight-bold" style="position: relative; right: 20px">{{ $myOrder['drinks'] }} <button type="submit" class="removeItem ml-1" title="Remover item"><i class="fas fa-times text-danger"></i></button></li>

                                                    </form>
                                                @else
                                                    <li style="position: relative; right: 20px"><a href="{{ route('minhaBandeja.index') }}" class="text-danger font-weight-bold">Escolha uma bebida</a></li>
                                                @endif


                                            @elseif($myOrder['orderType'] == 'Avulso')

                                                @if(isset($customs))
                                                    @foreach($customs as $key => $val)
                                                        <form action="{{ route('removeCustomizado', $id = $val->id) }}" method="post">
                                                            @csrf
                                                            <li style="position: relative; right: 20px">{{ $val->Item }} <button type="submit" class="fas fa-times text-danger removeItem" style="cursor: pointer" title="Remover item"></button></li>
                                                            @if($val->nameExtra != '')
                                                                <ul>
                                                                    <li style="position: relative; right: 20px;">{{ $val->nameExtra }}
                                                                        <a href="{{ route('minhaBandeja.index') }}" class="removeItem ml-1" title="Editar itens extras"><i class="fas fa-edit text-primary" style="font-size: 16px"></i></a></li>
                                                                </ul>
                                                            @endif
                                                        </form>
                                                    @endforeach

                                                        <hr>
                                                @endif

                                                   @if(isset($items))
                                                        @foreach($items as $key => $value)

                                                            <form action="{{ route('removerItem', $value->id)}}" method="post">
                                                                @csrf
                                                                @if($value != '')
                                                                <li style="position: relative; right: 20px">{{ $value->itemName }}
                                                                    <button type="submit" class="removeItem ml-1" title="Remover item"><i class="fas fa-times text-danger"></i></button></li>
                                                                @endif
                                                            </form>

                                                        @endforeach

                                            @endif
                                            @endif
                                        </ul>
                                    </div>

                                    @if($myOrder['orderType'] != 'Avulso')
{{--                                    @if($myOrder['extras'] != '')--}}
{{--                                        <hr>--}}
{{--                                        <h5 class="font-weight-bold text-center mb-3">Adicionais:</h5>--}}
{{--                                        <ol>--}}

{{--                                            @foreach(explode(', ', $myOrder['extras']) as $extra)--}}
{{--                                                <form action="{{ route('removeadd')}}" class="form-group removerAdicional">--}}
{{--                                                    <li class="font-weight-bold" style="margin-bottom: -5px;"><span style="cursor:pointer;" title="Item adicionado ao sanduíche">{{ $extra }}</span> &nbsp;<button type="submit" class="fas fa-times text-danger removeItem" title="Remover item adicional" style="cursor: pointer"></button></li>--}}
{{--                                                    <select name="extra" hidden>--}}
{{--                                                        <option value="{{ $extra }}"></option>--}}
{{--                                                    </select>--}}

{{--                                                    <select name="id" hidden>--}}
{{--                                                        <option value="{{ $myOrder['id'] }}"></option>--}}
{{--                                                    </select>--}}
{{--                                                </form>--}}
{{--                                            @endforeach--}}

{{--                                        </ol>--}}
{{--                                        <hr>--}}
{{--                                    @endif--}}
                                    @endif

                                    <div class="col-12">
                                        <label class="text-muted font-weight-bold" style="font-size: 18px">Valor total:</label>
                                        <span class="text-success font-weight-bold total-val" style="font-size: 18px">{{ $myOrder['totalValue'] }}</span>
                                    </div>


                                    <form action="{{ route('aplicarCupom') }}" method="post">
                                        @csrf
                                        <div class="col-12 div-cupom">
                                            <label class="font-weight-bold text-muted" style="font-size: 18px">Cupom de desconto

                                            </label>
                                            <input type="text" autocomplete="off" class="form-control cupomDesconto" name="cupomDesconto"

                                                   @if(session('msg-success'))
                                                       value="{{ session('msg-success') }}" style="cursor: not-allowed;" readonly
                                                        title="Cupom já aplicado"
                                                   @endif
                                                   placeholder="Insira um cupom (se tiver).">
                                        </div>

                                        <div class="col-12 mt-4 d-flex justify-content-end">
                                            <button type="submit"  class="btn btn-success font-weight-bold"
                                                    @if(session('msg-success'))
                                                    hidden
                                                    @endif
                                            >Aplicar cupom</button>
                                        </div>
                                    </form>

                                    @if(session('msg-success'))
                                        <form action="{{ route('removerCupom', session('msg-success')) }}" method="post">
                                            @csrf
                                            <div class="col-12 mt-1 d-flex justify-content-end">
                                                <button type="submit" class="btn btn-danger font-weight-bold" title="Remover item">Remover Cupom</button></li>
                                            </div>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>


                        <div class="col-12 col-lg-8 mb-3">
                            <div class="card">
                                <div class="card-body">
                                    <form action="{{ route('pedidos.store') }}" method="post" class="form-group">
                                        @csrf
                                        <div class="row">
                                            <div class="col-12 col-lg-6 mt-4 mt-lg-0 div-forma-retirada">
                                                <label class="font-weight-bold text-muted" style="font-size: 18px">Forma de retirada</label>
                                                <select name="formaRetirada" class="form-control forma-entrega">
                                                    @if(isset($pendings))
                                                        <option value="{{ $pendings }}">{{ $pendings }}</option>
                                                    @elseif(isset($exist[0]))
                                                        <option value="{{ $exist[0]->deliverWay }}">{{ $exist[0]->deliverWay }}</option>
                                                    @else
                                                        <option value="Entrega em domicílio">Entrega em domicílio</option>
                                                        <option value="Retirada no restaurante">Retirada no restaurante</option>
                                                    @endif
                                                </select>
                                            </div>

                                            @if(isset($pendings))

                                            @if($separated != 0 && $pendings == 'Entrega em domicílio')

                                                <div class="col-12 col-lg-6 mt-4 mt-lg-0 pagamento">
                                                    <label class="font-weight-bold text-muted" style="font-size: 18px;">Método de pagamento</label>
                                                    <select name="formaPagamento" style="cursor: pointer;" class="form-control forma-pagamento">
                                                        <option value="Dinheiro">Dinheiro</option>
                                                        <option value="Cartão de crédito (Elo)">Cartão de crédito (Elo)</option>
                                                        <option value="Cartão de crédito (Visa)">Cartão de crédito (Visa)</option>
                                                        <option value="Cartão de débito (Elo)">Cartão de débito (Elo)</option>
                                                        <option value="Cartão de débito (Visa)">Cartão de débito (Visa)</option>
                                                    </select>
                                                </div>

                                                <div class="col-12 col-lg-9 mt-4 mt-lg-4 val-entregue">
                                                    <label class="font-weight-bold text-muted" style="font-size: 18px">Valor entregue</label>
                                                    <input type="text" autocomplete="off" class="form-control troco mb-2" name="valEntregue" placeholder="Cálculo de troco" required>
                                                    <span class="text-danger font-weight-bold verifica-val-troco">O valor do troco não pode ser menor ou igual ao valor do pedido.</span>
                                                    <span class="text-primary font-weight-bold verifica-troco">Informe o valor que você pagará no ato da compra para que possamos calcular o troco (Caso necessário).</span>
                                                </div>

                                                <div class="col-12 col-lg-4 mt-4 mt-lg-4 entrega">
                                                    <label class="font-weight-bold text-muted" style="font-size: 18px">Entregar em</label>
                                                    <br>
                                                    <input type="radio" class="entregaCasa" name="entrega" value="Entregaemcasa">
                                                    <label class="font-weight-bold text-muted"><span class="text-success">Minha residência</span></label><br>
                                                    <input type="radio" class="entregaFora" name="entrega" value="localEntregaFora">
                                                    <label class="font-weight-bold text-muted"><span class="text-danger">Outro local (Insira)</span></label><br>
                                                </div>

                                                <div class="col-12 col-lg-8 mt-4 mt-lg-4 local-entrega">
                                                    <label class="font-weight-bold text-muted" style="font-size: 18px">Será entregue em</label>
                                                    <input type="text" autocomplete="off" class="form-control end-entrega" name="localEntrega" required value="{{ $sendAddress }}" placeholder="Insira o local a ser entregue.">
                                                </div>
                                            @endif
                                            @endif



                                            @if(isset($exist[0]))
                                                @if($exist[0]->deliverWay == 'Entrega em domicílio')
                                                <div class="col-12 col-lg-6 mt-4 mt-lg-0 pagamento">
                                                    <label class="font-weight-bold text-muted" style="font-size: 18px;">Método de pagamento</label>
                                                    <select name="formaPagamento" style="cursor: pointer;" class="form-control forma-pagamento">
                                                        <option value="Dinheiro">Dinheiro</option>
                                                        <option value="Cartão de crédito (Elo)">Cartão de crédito (Elo)</option>
                                                        <option value="Cartão de crédito (Visa)">Cartão de crédito (Visa)</option>
                                                        <option value="Cartão de débito (Elo)">Cartão de débito (Elo)</option>
                                                        <option value="Cartão de débito (Visa)">Cartão de débito (Visa)</option>
                                                    </select>
                                                </div>

                                                <div class="col-12 col-lg-9 mt-4 mt-lg-4 val-entregue">
                                                    <label class="font-weight-bold text-muted" style="font-size: 18px">Valor entregue</label>
                                                    <input type="text" autocomplete="off" class="form-control troco mb-2" name="valEntregue" placeholder="Cálculo de troco" required>
                                                    <span class="text-danger font-weight-bold verifica-val-troco">O valor do troco não pode ser menor ou igual ao valor do pedido.</span>
                                                    <span class="text-primary font-weight-bold verifica-troco">Informe o valor que você pagará no ato da compra para que possamos calcular o troco (Caso necessário).</span>
                                                </div>

                                                <div class="col-12 col-lg-4 mt-4 mt-lg-4 entrega">
                                                    <label class="font-weight-bold text-muted" style="font-size: 18px">Entregar em</label>
                                                    <br>
                                                    <input type="radio" class="entregaCasa" name="entrega" value="Entregaemcasa">
                                                    <label class="font-weight-bold text-muted"><span class="text-success">Minha residência</span></label><br>
                                                    <input type="radio" class="entregaFora" name="entrega" value="localEntregaFora">
                                                    <label class="font-weight-bold text-muted"><span class="text-danger">Outro local (Insira)</span></label><br>
                                                </div>

                                                <div class="col-12 col-lg-8 mt-4 mt-lg-4 local-entrega">
                                                    <label class="font-weight-bold text-muted" style="font-size: 18px">Será entregue em</label>
                                                    <input type="text" autocomplete="off" class="form-control end-entrega" name="localEntrega" required value="{{ $sendAddress }}" placeholder="Insira o local a ser entregue.">
                                                </div>
                                            @endif
                                            @endif

                                                @if(isset($separated))
                                                @if($separated == 0)

                                                    <div class="col-12 col-lg-6 mt-4 mt-lg-0 pagamento">
                                                        <label class="font-weight-bold text-muted" style="font-size: 18px;">Método de pagamento</label>
                                                        <select name="formaPagamento" style="cursor: pointer;" class="form-control forma-pagamento">
                                                            <option value="Dinheiro">Dinheiro</option>
                                                            <option value="Cartão de crédito (Elo)">Cartão de crédito (Elo)</option>
                                                            <option value="Cartão de crédito (Visa)">Cartão de crédito (Visa)</option>
                                                            <option value="Cartão de débito (Elo)">Cartão de débito (Elo)</option>
                                                            <option value="Cartão de débito (Visa)">Cartão de débito (Visa)</option>
                                                        </select>
                                                    </div>

                                                    <div class="col-12 col-lg-9 mt-4 mt-lg-4 val-entregue">
                                                        <label class="font-weight-bold text-muted" style="font-size: 18px">Valor entregue</label>
                                                        <input type="number" autocomplete="off" class="form-control troco mb-2" name="valEntregue" placeholder="Cálculo de troco" required>
                                                        <span class="text-danger font-weight-bold verifica-val-troco">O valor do troco não pode ser menor ou igual ao valor do pedido.</span>
                                                        <span class="text-primary font-weight-bold verifica-troco">Informe o valor que você pagará no ato da compra para que possamos calcular o troco (Caso necessário).</span>
                                                    </div>

                                                    <div class="col-12 col-lg-4 mt-4 mt-lg-4 entrega">
                                                        <label class="font-weight-bold text-muted" style="font-size: 18px">Entregar em</label>
                                                        <br>
                                                        <input type="radio" class="entregaCasa" name="entrega" value="Entregaemcasa">
                                                        <label class="font-weight-bold text-muted"><span class="text-success">Minha residência</span></label><br>
                                                        <input type="radio" class="entregaFora" name="entrega" value="localEntregaFora">
                                                        <label class="font-weight-bold text-muted"><span class="text-danger">Outro local (Insira)</span></label><br>
                                                    </div>

                                                    <div class="col-12 col-lg-8 mt-4 mt-lg-4 local-entrega">
                                                        <label class="font-weight-bold text-muted" style="font-size: 18px">Será entregue em</label>
                                                        <input type="text" class="form-control end-entrega" name="localEntrega" required value="{{ $sendAddress }}" placeholder="Insira o local a ser entregue.">
                                                    </div>

                                                @endif
                                            @endif

                                            <div class="col-12 col-lg-12 mt-4 mt-lg-4">
                                                <label class="font-weight-bold text-muted" style="font-size: 18px">Observações</label>
                                                <textarea name="obs" class="form-control" id="" cols="30" rows="5" placeholder="Insira alguma observação caso necessário."></textarea>
                                            </div>

                                            <div class="col-12 col-lg-12 mt-4 mt-lg-4" hidden>
                                                <select name="pedir" hidden>
                                                    <option class="valor-retorno"></option>
                                                </select>
                                            </div>

                                            <div class="col-12 mt-3 d-flex justify-content-end" style="bottom: -20px">
                                                @if(isset($pendings))
                                                    @if($pendings == 'Entrega em domicílio')
                                                        <button class="btn btn-success font-weight-bold finalizar-pedido"><i class="fas fa-check-circle mr-2"></i>Finalizar Pedido</button>
                                                    @else
                                                        <button class="btn btn-success font-weight-bold verifica-outro"><i class="fas fa-check-circle mr-2"></i>Finalizar Pedido</button>
                                                    @endif

                                                @elseif(isset($exist[0]))
                                                    @if($exist[0]->deliverWay == 'Entrega em domicílio')
                                                        <button class="btn btn-success font-weight-bold finalizar-pedido"><i class="fas fa-check-circle mr-2"></i>Finalizar Pedido</button>
                                                    @else
                                                        <button class="btn btn-success font-weight-bold verifica-outro"><i class="fas fa-check-circle mr-2"></i>Finalizar Pedido</button>
                                                    @endif
                                                @else
                                                    <button class="btn btn-success font-weight-bold finalizar-pedido"><i class="fas fa-check-circle mr-2"></i>Finalizar Pedido</button>
                                                @endif
                                            </div>
                                        </div>

                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModalCentercompra" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title font-weight-bold" id="exampleModalLongTitle">Tudo certo!</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <span class="font-weight-bold text-muted">Pedido anotado. Deseja pedir algo mais?</span>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-danger font-weight-bold mais-pedidos">Sim, ir ao cardápio</button>
                                                        <button type="submit" class="btn btn-primary font-weight-bold">Não, pode trazer meu pedido</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if(session('msg-rem'))
        <button hidden class="disparo-removeCombo"></button>
    @elseif(session('msg-add'))
        <button hidden class="disparo-addCombo"></button>
    @else
        @if(isset($exist[0]))
            @if($exist[0]->deliverWay == 'Entrega em domicílio')
                <script>
                    function shoot(){
                        $.toast({
                            text: '<b>Você tem um pedido em andamento para entrega em domicílio, com isso não é possível escolher outra forma de retirada.</b>',
                            heading: '<b>Atenção aqui!</b>',
                            showHideTransition: 'slide',
                            bgColor : '#38C172',
                            position : 'top-right',
                            hideAfter: 14000
                        })
                    }

                    shoot();

                    $(".forma-entrega").on("click", function (){
                        shoot();
                    })
                </script>
            @elseif($exist[0]->deliverWay == 'Retirada no restaurante')
                <script>
                    function shoot(){
                        $.toast({
                            text: '<b>Você tem um pedido em andamento para retirada no restaurante, com isso não é possível escolher outra forma de retirada.</b>',
                            heading: '<b>Atenção aqui!</b>',
                            showHideTransition: 'slide',
                            bgColor : '#38C172',
                            position : 'top-right',
                            hideAfter: 14000
                        })
                    }

                    shoot();

                    $(".forma-entrega").on("click", function (){
                        shoot();
                    })
                </script>
            @endif
        @elseif(!isset($use) && !isset($couponName) && !isset($notExist))
            <button hidden class="disparo-fim"></button>
        @endif
    @endif
@endsection
