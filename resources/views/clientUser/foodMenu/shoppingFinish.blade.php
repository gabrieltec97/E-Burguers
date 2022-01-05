@extends('layouts.extend-client')
<script src="{{ asset('js/jquery.js') }}"></script>
<script src="{{ asset('js/ajaxFinalizarPedido.js') }}"></script>

@section('title')
    Finalizar compra
@endsection

@section('content')

    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-12 mt-5">
                <div class="container-fluid mt-2">
                    <div class="row">
                        <div class="col-12 col-lg-8 mb-3 mt-3 mt-lg-0">
                            <div class="card card-finalizando" style="border: none;">
                                <div class="card-header bg-dark">
                                    <h5 class="font-weight-bold text-white" style="margin-bottom: -1px">Finalizando pedido</h5>
                                </div>
                                <div class="card-body">
                                    <form id="cadastrarPedido" action="{{ route('pedidos.store') }}" method="post" class="form-group">
                                        @csrf
                                        <div class="row">
{{--                                            <div class="col-12 col-lg-6 div-forma-retirada">--}}
{{--                                                <label class="font-weight-bold" style="font-size: 18px">Forma de retirada (Escolha)</label>--}}
{{--                                                <select name="formaRetirada" class="form-control forma-entrega">--}}
{{--                                                    @if(isset($pendings))--}}
{{--                                                        <option value="{{ $pendings }}">{{ $pendings }}</option>--}}
{{--                                                    @elseif(isset($exist[0]))--}}
{{--                                                        <option value="{{ $exist[0]->deliverWay }}">{{ $exist[0]->deliverWay }}</option>--}}
{{--                                                    @elseif($deliver != null)--}}
{{--                                                        <option value="{{ $deliver }}" class="deliver-coupon" title="Local inserido junto com cupom. Para trocar, clique em alterar local.">{{ $deliver }}</option>--}}
{{--                                                    @else--}}
{{--                                                        <option value="Entrega em domicílio">Entrega em domicílio</option>--}}
{{--                                                        <option value="Retirada no restaurante">Retirada no restaurante</option>--}}
{{--                                                    @endif--}}
{{--                                                </select>--}}
{{--                                            </div>--}}

                                            @if(isset($pendings))

                                            @if($separated != 0 && $pendings == 'Entrega em domicílio')

                                                    @if(isset($exist[0]))
                                                        <div class="col-12 col-lg-6 local-entrega">
                                                            <label class="font-weight-bold" style="font-size: 18px">Será entregue em</label>
                                                            <input type="text" autocomplete="off" class="form-control end-entrega" name="localEntrega" required value="{{ $exist[0]->address }}" placeholder="Insira o local a ser entregue.">
                                                        </div>
                                                    @else
                                                        <div class="col-12 col-lg-4 mt-4 mt-lg-4 entrega">
                                                            <label class="font-weight-bold" style="color: black; font-size: 18px">Entregar em</label>
                                                            <br>
                                                            <input type="radio" class="entregaCasa" name="entrega" value="Entregaemcasa">
                                                            <label class="font-weight-bold" style="color: black;"><span class="text-success">Minha residência</span></label><br>
                                                            <input type="radio" class="entregaFora" name="entrega" value="localEntregaFora">
                                                            <label class="font-weight-bold" style="color: black;"><span class="text-danger">Outro local (Insira)</span></label><br>
                                                        </div>

                                                        <div class="col-12 col-lg-8 mt-4 mt-lg-4 local-entrega">
                                                            <label class="font-weight-bold" style="color: black; font-size: 18px">Será entregue em</label>
                                                            <input type="text" autocomplete="off" class="form-control end-entrega" name="localEntrega" required value="{{ $sendAddress }}" placeholder="Insira o local a ser entregue.">
                                                        </div>
                                                    @endif

                                            @if($diffSend != null)
                                              @if($diffSend[1] != 'dinheiro' && $diffSend[1] != null)
                                                  <div class="col-12 mt-4">
                                                      <a href="https://pt.vecteezy.com/vetor-gratis/carteira" style="cursor: initial" target="_blank"><img src="{{ asset('logo/cartao-de-debito.png') }}" alt="pagamento" title="Pagamento em cartão" style="width: 80px; height: 80px"></a>
                                                      <h5>Pagamento em {{ $diffSend[1] }}</h5>
                                                  </div>

                                                                <div class="col-12 col-lg-6 mt-lg-4">
                                                                    <img src="{{ asset('logo/mapas.png') }}" style="width: 50px; height: 50px; border-radius: 5px" alt="Local de entrega">
                                                                    <label>Será enviado para: {{ $diffSend[0] }}</label>
                                                                </div>

                                                                <div class="col-12 mt-4">
                                                                    <button type="button" title="Alterar local de entrega." class="btn btn-primary float-right alterar-local-cupom">Remover cupom / Alterar local / Pagamento</button>
                                                                </div>

                                              @elseif($diffSend[1] != null)
                                                                <label for="troco">Troco para (alterar):</label>
                                                                <input type="text" class="form-control w-50 editar-valor-ent" autocomplete="off" name="valEntregue" value="{{ $diffSend[2] }}">
                                                                <span class="text-danger font-weight-bold ver-troco mt-2">Valor inválido para troco.</span><br>
                                        </div>

                                        <div class="col-12 col-lg-6 mt-lg-4">
                                            <img src="{{ asset('logo/mapas.png') }}" style="width: 50px; height: 50px; border-radius: 5px" alt="Local de entrega">
                                            <label>Será enviado para: {{ $diffSend[0] }}</label>
                                        </div>

                                        <div class="col-12 mt-4">
                                            <button type="button" title="Alterar local de entrega." class="btn btn-primary float-right alterar-local-cupom">Remover cupom / Alterar local / Pagamento</button>
                                        </div>
                                              @endif

                                                  <button class="hasCoupon" value="{{ $diffSend[1] }}" hidden></button>
                                            @else
                                            <div class="col-12 col-lg-6 mt-4 pagamento">
                                                <label class="font-weight-bold" style="color:black;font-size: 18px;">Método de pagamento</label>
                                                <select name="formaPagamento" style="cursor: pointer;" class="form-control forma-pagamento">
                                                    <option value="Dinheiro">Dinheiro</option>
                                                    <option value="Cartão de crédito (Elo)">Cartão de crédito (Elo)</option>
                                                    <option value="Cartão de crédito (Visa)">Cartão de crédito (Visa)</option>
                                                    <option value="Cartão de débito (Elo)">Cartão de débito (Elo)</option>
                                                    <option value="Cartão de débito (Visa)">Cartão de débito (Visa)</option>
                                                </select>
                                            </div>

                                            <div class="col-12 col-lg-6 mt-4 val-entregue">
                                                <label class="font-weight-bold text-mutd" style="color:black;font-size: 18px">Valor entregue</label>
                                                <input type="text" autocomplete="off" class="form-control troco mb-2" name="valEntregue" placeholder="Cálculo de troco" required>
                                                <span class="text-danger verifica-val-troco" style="font-size: 15px">O valor do troco não pode ser menor ou igual ao valor do pedido.</span>
                                            </div>
                                            @endif

                                                <div class="col-12 col-lg-6 mt-4 mt-lg-4 bairro-entrega">
                                                    <label class="font-weight-bold" style="color:black; font-size: 18px">Bairro</label>
                                                    <select class="form-control entregaDiff" name="diffDistrict">
                                                        <option value="" selected hidden>Selecione</option>
                                                        @foreach($places as $place)
                                                            <option value="{{ $place->name }}">{{ $place->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="col-12 col-lg-6 mt-4 mt-lg-4 bairro-entrega">
                                                    <label class="font-weight-bold" style="color:black; font-size: 18px">Ponto de referência</label>
                                                    <input type="text" class="form-control pontoRef" name="pontoRef" placeholder="Dê mais detalhes sobre a localização.">
                                                </div>
                                            @endif
                                            @endif

                                            @if(isset($exist[0]) && !isset($pendings))
                                                @if($exist[0]->deliverWay == 'Entrega em domicílio')
                                                    @if(isset($exist[0]))
                                                        <div class="col-12 col-lg-6 local-entrega">
                                                            <label class="font-weight-bold" style="color: black; font-size: 18px">Será entregue em</label>
                                                            <input type="text" autocomplete="off" class="form-control end-entrega" name="localEntrega" required value="{{ $exist[0]->address }}" placeholder="Insira o local a ser entregue.">
                                                        </div>
                                                    @else
                                                        <div class="col-12 col-lg-4 mt-4 mt-lg-4 entrega">
                                                            <label class="font-weight-bold" style="color: black; font-size: 18px">Entregar em</label>
                                                            <br>
                                                            <input type="radio" class="entregaCasa" name="entrega" value="Entregaemcasa">
                                                            <label class="font-weight-bold"><span class="text-success">Minha residência</span></label><br>
                                                            <input type="radio" class="entregaFora" name="entrega" value="localEntregaFora">
                                                            <label class="font-weight-bold"><span class="text-danger">Outro local (Insira)</span></label><br>
                                                        </div>

                                                        <div class="col-12 col-lg-8 mt-4 mt-lg-4 local-entrega">
                                                            <label class="font-weight-bold" style="color: black; font-size: 18px">Será entregue em</label>
                                                            <input type="text" autocomplete="off" class="form-control end-entrega" name="localEntrega" required value="{{ $sendAddress }}" placeholder="Insira o local a ser entregue.">
                                                        </div>
                                                    @endif

                                                    @if($diffSend != null)
                                                        @if($diffSend[1] != 'dinheiro' && $diffSend[1] != null)
                                                            <div class="col-12 col-lg-6 mt-4">
                                                                <a href="https://pt.vecteezy.com/vetor-gratis/carteira" style="cursor: initial" target="_blank"><img src="{{ asset('logo/cartao-de-debito.png') }}" alt="pagamento" title="Pagamento em cartão" style="width: 80px; height: 80px"></a>
                                                                <h5>Pagamento em {{ $diffSend[1] }}</h5>
                                                            </div>

                                                                <div class="col-12 col-lg-6 mt-lg-4">
                                                                    <img src="{{ asset('logo/mapas.png') }}" style="width: 50px; height: 50px; border-radius: 5px" alt="Local de entrega">
                                                                    <label>Será enviado para: {{ $diffSend[0] }}</label>
                                                                </div>

                                                                <div class="col-12 mt-4">
                                                                    <button type="button" title="Alterar local de entrega." class="btn btn-primary float-right alterar-local-cupom">Remover cupom / Alterar local / Pagamento</button>
                                                                </div>
                                                        @elseif($diffSend[1] != null)
                                                                <div class="col-12 col-lg-6">
                                                                    <label for="troco">Troco para (alterar)sss:</label>
                                                                    <input type="text" class="form-control w-50 editar-valor-ent" autocomplete="off" name="valEntregue" value="{{ $diffSend[2] }}">
                                                                    <span class="text-danger font-weight-bold ver-troco mt-2">Valor inválido para troco.</span><br>
                                                                </div>

                                <div class="col-12 col-lg-6 ">
                                    <img src="{{ asset('logo/mapas.png') }}" style="width: 50px; height: 50px; border-radius: 5px" alt="Local de entrega">
                                    <label>Será enviado para: {{ $diffSend[0] }}</label>
                                </div>

                                <div class="col-12 mt-4">
                                    <button type="button" title="Alterar local de entrega." class="btn btn-primary float-right alterar-local-cupom">Remover cupom / Alterar local / Pagamento</button>
                                </div>
                                                        @endif

                                                            <button class="hasCoupon" value="{{ $diffSend[1] }}" hidden></button>
                                                    @else
                                                        <div class="col-12 col-lg-6 pagamento">
                                                            <label class="font-weight-bold" style="color:black; font-size: 18px;">Método de pagamento</label>
                                                            <select name="formaPagamento" style="cursor: pointer;" class="form-control forma-pagamento">
                                                                <option value="invalid" disabled selected>Escolha uma opção</option>
                                                                <option value="Dinheiro">Dinheiro</option>
                                                                <option value="Cartão de crédito (Elo)">Cartão de crédito (Elo)</option>
                                                                <option value="Cartão de crédito (Visa)">Cartão de crédito (Visa)</option>
                                                                <option value="Cartão de débito (Elo)">Cartão de débito (Elo)</option>
                                                                <option value="Cartão de débito (Visa)">Cartão de débito (Visa)</option>
                                                            </select>
                                                        </div>

                                                        <div class="col-12 col-lg-6 mt-4 mt-lg-0 val-entregue">
                                                            <label class="font-weight-bold" style="color:black; font-size: 18px">Valor entregue</label>
                                                            <input type="text" autocomplete="off" class="form-control troco mb-2" name="valEntregue" placeholder="Cálculo de troco" required>
                                                            <span class="text-danger verifica-val-troco" style="font-size: 15px">O valor do troco não pode ser menor ou igual ao valor do pedido.</span>
                                                        </div>

                                                            <div class="col-12 col-lg-6 mt-3 mt-lg-0">
                                                                <img src="{{ asset('logo/mapas.png') }}" style="width: 50px; height: 50px; border-radius: 5px" alt="Local de entrega">
                                                                <label>Será enviado para: {{ $exist[0]->address }}</label>
                                                            </div>
                                                    @endif

                                                    <div class="col-12 col-lg-6 mt-4 mt-lg-4 bairro-entrega">
                                                        <label class="font-weight-bold" style="color: black; font-size: 18px">Bairro</label>
                                                        <select class="form-control entregaDiff" name="diffDistrict">
                                                            <option value="" selected hidden>Selecione</option>
                                                            @foreach($places as $place)
                                                                <option value="{{ $place->name }}">{{ $place->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="col-12 col-lg-6 mt-4 mt-lg-4 bairro-entrega">
                                                        <label class="font-weight-bold" style="color: black;font-size: 18px">Ponto de referência</label>
                                                        <input type="text" class="form-control pontoRef" name="pontoRef" placeholder="Dê mais detalhes sobre a localização.">
                                                    </div>
                                                @endif
                                            @endif

                                                @if(isset($separated))
                                                @if($separated == 0)

{{--                                                Verificando se o cupom foi inserido em um local diferente.    --}}
                                                @if($diffSend != null)

                                                    @if($diffSend[1] != 'dinheiro' && $diffSend[1] != null)
                                                      <div class="col-12 col-lg-6 mt-4">
                                                          <a href="https://pt.vecteezy.com/vetor-gratis/carteira" style="cursor: initial" target="_blank"><img src="{{ asset('logo/cartao-de-debito.png') }}" alt="pagamento" title="Pagamento em cartão" style="width: 80px; height: 80px"></a>
                                                          <h5>Pagamento em {{ $diffSend[1] }}</h5>
                                                      </div>

                                                            <div class="col-12 col-lg-6 mt-lg-4">
                                                                <img src="{{ asset('logo/mapas.png') }}" style="width: 50px; height: 50px; border-radius: 5px" alt="Local de entrega">
                                                                <label>Será enviado para: {{ $diffSend[0] }}</label>
                                                            </div>

                                                            <div class="col-12 mt-4">
                                                                <button type="button" title="Alterar local de entrega." class="btn btn-primary float-right alterar-local-cupom">Remover cupom / Alterar local / Pagamento</button>
                                                            </div>
                                                    @elseif($diffSend[1] != null)

                                                      <div class="col-12 col-lg-6 mt-4">
                                                          <a href="https://pt.vecteezy.com/vetor-gratis/carteira" style="cursor: initial" target="_blank"><img src="{{ asset('logo/apenas-a-dinheiro.png') }}" alt="pagamento" title="Pagamento em dinheiro" style="width: 80px; height: 80px"></a>
                                                          <h5 class="mt-3">Pagamento em {{ $diffSend[1] }}</h5>

                                                          <label for="troco">Troco para (alterar):</label>
                                                              <input type="text" class="form-control w-50 editar-valor-ent" autocomplete="off" name="valEntregue" value="{{ $diffSend[2] }}">
                                                              <span class="text-danger font-weight-bold ver-troco mt-2">Valor inválido para troco.</span><br>
                                                      </div>

                                                        <div class="col-12 col-lg-6 mt-lg-4">
                                                            <img src="{{ asset('logo/mapas.png') }}" style="width: 50px; height: 50px; border-radius: 5px" alt="Local de entrega">
                                                            <label>Será enviado para: {{ $diffSend[0] }}</label>
                                                        </div>

                                                      <div class="col-12 mt-4">
                                                          <button type="button" title="Alterar local de entrega." class="btn btn-primary float-right alterar-local-cupom">Remover cupom / Alterar local / Pagamento</button>
                                                      </div>
                                                    @endif

                                                        <button class="hasCoupon" value="{{ $diffSend[1] }}" hidden></button>
                                                @else
                                                    <div class="col-12 col-lg-6">
                                                        <label class="font-weight-bold entrega-mobile" style="color: black; font-size: 18px">Entregar em</label>
                                                        <br>
                                                        <input type="radio" class="entregaCasa mt-1" name="entrega" value="Entregaemcasa">
                                                        <label class="font-weight-bold" style="color: black;"><span class="text-success">Meu endereço</span></label>
                                                        <input type="radio" class="entregaFora  ml-2" name="entrega" value="localEntregaFora">
                                                        <label class="font-weight-bold"><span class="text-danger">Outro local (Insira)</span></label><br>
                                                    </div>

                                                        <div class="col-12 col-lg-6 mt-4 mt-lg-2 local-entrega-see">
                                                            <div class="row">
                                                                <div class="col-1 mr-3">
                                                                    <img src="{{ asset('logo/mapas.png') }}" style="width: 50px; height: 50px; border-radius: 5px" alt="Local de entrega">
                                                                </div>

                                                                <div class="col-8">
                                                                    <label class="ml-3 font-weight-bold">{{ $sendAddress }} - {{ $district }}</label><br>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    <div class="col-12 col-lg-6 mt-4 mt-lg-0 local-entrega">
                                                        <label class="font-weight-bold" style="color: black; font-size: 18px">Será entregue em</label>
                                                        <input type="text" autocomplete="off" class="form-control end-entrega" name="localEntrega" required value="{{ $sendAddress }}" placeholder="Digite apenas o nome da rua.">
                                                    </div>

                                                        <div class="col-12 col-lg-6 mt-4 mt-lg-4 bairro-entrega">
                                                            <label class="font-weight-bold" style="color: black;font-size: 18px">Nº da residência (Complemento)</label>
                                                            <input type="text" class="form-control adDeliver" name="adNumber" placeholder="Dê mais detalhes sobre a residência.">
                                                        </div>

                                                    <div class="col-12 col-lg-6 mt-4 mt-lg-4 bairro-entrega">
                                                        <label class="font-weight-bold" style="color: black; font-size: 18px">Bairro</label>
                                                        <select class="form-control entregaDiff" name="diffDistrict">
                                                            <option value="" selected hidden>Selecione</option>
                                                            @foreach($places as $place)
                                                                <option value="{{ $place->name }}">{{ $place->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="col-12 col-lg-6 mt-4 mt-lg-4 bairro-entrega">
                                                        <label class="font-weight-bold" style="color: black;font-size: 18px">Ponto de referência</label>
                                                        <input type="text" class="form-control pontoRef" name="pontoRef" placeholder="Dê mais detalhes sobre a localização.">
                                                    </div>

                                                    <div class="col-12 col-lg-6 mt-4 pagamento">
                                                        <label class="font-weight-bold" style="color: black;font-size: 18px;">Método de pagamento</label>
                                                        <select name="formaPagamento" style="cursor: pointer;" class="form-control forma-pagamento">
                                                            <option value="invalid" disabled selected>Escolha uma opção</option>
                                                            <option value="Dinheiro">Dinheiro</option>
                                                            <option value="Cartão de crédito (Elo)">Cartão de crédito (Elo)</option>
                                                            <option value="Cartão de crédito (Visa)">Cartão de crédito (Visa)</option>
                                                            <option value="Cartão de débito (Elo)">Cartão de débito (Elo)</option>
                                                            <option value="Cartão de débito (Visa)">Cartão de débito (Visa)</option>
                                                        </select>
                                                    </div>

                                                    <div class="col-12 col-lg-6 mt-4 mt-lg-4 val-entregue">
                                                        <label class="font-weight-bold" style="color: black;font-size: 18px">Valor entregue</label>
                                                        <input type="text" autocomplete="off" class="form-control troco mb-2" name="valEntregue" placeholder="O valor que você vai pagar ao entregador." required>
                                                        <span class="text-danger verifica-val-troco" style="font-size: 15px">O valor do troco não pode ser menor ou igual ao valor do pedido.</span>
                                                    </div>
                                                @endif
                                                    @if(isset($exist[0]))
                                                        <div class="col-12 col-lg-8 mt-4 mt-lg-4 local-entrega">
                                                            <label class="font-weight-bold" style="color: black;font-size: 18px">Será entregue em</label>
                                                            <input type="text" autocomplete="off" class="form-control end-entrega" name="localEntrega" required value="{{ $exist[0]->address }}" placeholder="Insira o local a ser entregue.">
                                                        </div>
{{--                                                    @else--}}
{{--                                                        <div class="col-12 col-lg-6 entrega">--}}
{{--                                                            <label class="font-weight-bold text-muted" style="font-size: 18px">Entregar em</label>--}}
{{--                                                            <br>--}}
{{--                                                            <input type="radio" class="entregaCasa mt-1" name="entrega" value="Entregaemcasa">--}}
{{--                                                            <label class="font-weight-bold text-muted"><span class="text-success">Meu endereço</span></label>--}}
{{--                                                            <input type="radio" class="entregaFora  ml-2" name="entrega" value="localEntregaFora">--}}
{{--                                                            <label class="font-weight-bold text-muted"><span class="text-danger">Outro local (Insira)</span></label><br>--}}
{{--                                                        </div>--}}

{{--                                                        <div class="col-12 col-lg-8 mt-4 mt-lg-4 local-entrega">--}}
{{--                                                            <label class="font-weight-bold text-muted" style="font-size: 18px">Será entregue em</label>--}}
{{--                                                            <input type="text" autocomplete="off" class="form-control end-entrega" name="localEntrega" required value="{{ $sendAddress }}" placeholder="Insira o local a ser entregue.">--}}
{{--                                                        </div>--}}
                                                    @endif

                                                @endif
                                            @endif

                                            <div class="col-12 col-lg-12 mt-4 mt-lg-4">
                                                <label class="font-weight-bold" style="color: black; font-size: 18px">Observações</label>
                                                <textarea name="obs" class="form-control" id="" cols="30" rows="5" placeholder="Insira alguma observação caso necessário."></textarea>
                                            </div>

                                            <div class="col-12 col-lg-12 mt-4 mt-lg-4" hidden>
                                                <select name="pedir" hidden>
                                                    <option class="valor-retorno"></option>
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModalCentercompra" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header" style="background-color: #343a40">
                                                        <h5 class="modal-title font-weight-bold" id="exampleModalLongTitle" style="color: white">Quase lá!</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <span class="font-weight-bold" style="color: black">Deseja confirmar o pedido? Ele será registrado e começará a ser preparado.</span>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-primary" data-dismiss="modal" aria-label="Close">Voltar</button>
                                                        <button type="submit" class="btn btn-success cadastrar-pedido-agora"><i class="fa fa-check"></i> Confirmar pedido</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-lg-4 mb-4 mb-lg-0">
                            @if(session('msg'))
                                <script>
                                    const Toast = Swal.mixin({
                                        toast: true,
                                        position: 'top-end',
                                        showConfirmButton: false,
                                        timer: 5000,
                                        timerProgressBar: true,
                                    })

                                    Toast.fire({
                                        icon: 'warning',
                                        title: 'Poxa! Item removido do pedido.'
                                    })
                                </script>
                            @endif

                            @if(session('msg-coupon-used'))
                                <script>
                                    const Toast = Swal.mixin({
                                        toast: true,
                                        position: 'top-end',
                                        showConfirmButton: false,
                                        timer: 8000,
                                        timerProgressBar: true,
                                    })

                                    Toast.fire({
                                        icon: 'warning',
                                        title: 'Cupom não aplicado pois você já o utilizou anteriormente.'
                                    })
                                </script>
                            @endif

                            @if(session('msg-retire'))
                                    <script>
                                        const Toast = Swal.mixin({
                                            toast: true,
                                            position: 'top-end',
                                            showConfirmButton: false,
                                            timer: 12000,
                                            timerProgressBar: true,
                                        })

                                        Toast.fire({
                                            icon: 'error',
                                            title: 'O cupom de frete grátis não se aplica a pedidos para a retirada no restaurante.'
                                        })
                                    </script>
                            @endif

                            @if(session('msg-rem-cup'))
                                <script>
                                    const Toast = Swal.mixin({
                                        toast: true,
                                        position: 'top-end',
                                        showConfirmButton: false,
                                        timer: 10000,
                                        timerProgressBar: true,
                                    })

                                    Toast.fire({
                                        icon: 'warning',
                                        title: 'Item removido do pedido. O cupom também foi removido por não atender aos requisitos mínimos de uso.'
                                    })
                                </script>
                            @endif

                            @if(session('msg-success'))
                                <script>
                                    const Toast = Swal.mixin({
                                        toast: true,
                                        position: 'top-end',
                                        showConfirmButton: false,
                                        timer: 5000,
                                        timerProgressBar: true,
                                    })

                                    Toast.fire({
                                        icon: 'success',
                                        title: 'Cupom inserido com sucesso!'
                                    })
                                </script>
                            @endif

                            @if(session('msg-exp') or session('msg-use'))
                                <script>
                                    const Toast = Swal.mixin({
                                        toast: true,
                                        position: 'top-end',
                                        showConfirmButton: false,
                                        timer: 8000,
                                        timerProgressBar: true,
                                    })

                                    Toast.fire({
                                        icon: 'error',
                                        title: '{{ session('msg-exp') }} {{ session('msg-use') }}'

                                    })
                                </script>
                            @endif
                            <div class="card">
                                <div class="card-header bg-danger">
                                    <h5 class="font-weight-bold text-white" style="margin-bottom: -1px">Itens e cupom</h5>
                                </div>
                                <div class="card-body">

                                    <div class="col-12">

                                        <?php

                                            if (str_contains($myOrder['totalValue'] , '.')){
                                                $totalValue = $myOrder['totalValue'];
                                                if ($totalValue > 0){
                                                    $vals = explode('.', $totalValue);

                                                    $pieces = strlen($vals[0]);
                                                    $piecesAfter = strlen($vals[1]);
                                                }else{
                                                    $pieces = 0;
                                                }

                                                $count2 = strlen($totalValue);

                                                if ($count2 == 4 && $totalValue > 10){
                                                    $price = $totalValue . '0';
                                                }elseif ($count2 == 2){
                                                    $price = $totalValue. '.' . '00';
                                                }elseif($count2 == 5 && $pieces == 3){
                                                    $price = $totalValue. '0';
                                                }elseif($count2 == 3){
                                                    $price = $totalValue . '0';
                                                }elseif($pieces == 5  && $count2 >= 6 && $piecesAfter < 2){
                                                    $price = $totalValue . '0';
                                                }elseif($pieces == 4  && $count2 >= 6 && $piecesAfter < 2){
                                                    $price = $totalValue . '0';
                                                }
                                                elseif($pieces > 3 && $count2 >= 6){
                                                    $price = $totalValue;
                                                } else{
                                                    $price = $totalValue;
                                                }
                                            }else{
                                                $price = $myOrder['totalValue'] . '.00';
                                            }
                                        ?>

                                        <label class="font-weight-bold" style="font-size: 18px; color: black;">Valor total: <span class="text-success font-weight-normal">R$</span> </label>
                                        <span class="text-success total-val" style="font-size: 17px">{{ $price }}</span>
                                        <button class="pg-val" value="{{ $price }}" hidden></button>
                                    </div>

                                   <div class="col-12 mb-lg-3">
                                       <!-- Button trigger modal -->
                                       <a style="font-size: 16px; color: red; cursor: pointer;" data-toggle="modal" data-target="#modalDeItens">
                                           <i class="fas fa-utensils mr-2"></i>Ver itens do pedido.
                                       </a>
                                   </div>

                                    <!-- Modal -->
                                    <div class="modal fade" id="modalDeItens" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header bg-danger">
                                                    <h5 class="modal-title" id="exampleModalLongTitle" style="color: white">Meus itens da bandeja</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="col-12">
                                                        <ul>


                                                                @if(isset($items))
                                                                    @foreach($items as $key => $value)

                                                                        <form action="{{ route('removerItem', $value->id)}}" method="post">
                                                                            @csrf
                                                                            @if($value != '')
                                                                                <li style="position: relative; right: 20px; font-size: 15px;">{{ $value->item }}
                                                                                    <button type="submit" class="removeItem ml-1" title="Remover item" style="border: none; background: none; cursor: pointer;"><i class="fas fa-times text-danger"></i></button></li>
                                                                            @endif
                                                                        </form>

                                                                    @endforeach

                                                                @endif
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <a href="{{ route('cardapio', $insert = true) }}" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Adicionar mais itens</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <form id="couponApply" action="{{ route('aplicarCupom') }}" method="post">
                                        @csrf

                                        <input name="diffEnd" class="diffEnd" hidden>
                                        <input name="newPrice" class="newPrice" hidden>
                                        <input name="refPoint" class="refPoint" hidden>
                                        <input name="adSend" class="adSend" hidden>
                                        <input name="district" class="district" hidden>
                                        <input name="deliverType" class="deliverType" hidden>
                                        <input name="payingMethod" class="payingMethod" hidden>
                                        <input name="payingValue" class="payingValue" hidden>
                                        <div class="col-12 div-cupom">
                                            <label class="font-weight-bold mt-2 mt-lg-0" style="font-size: 18px; color: black">Cupom de desconto

                                            </label>
                                            <input type="text" autocomplete="off" class="form-control cupomDesconto" name="cupomDesconto"

                                                   @if(session('msg-success') or $myOrder['disccountUsed'] != null)
                                                   @if($myOrder['disccountUsed'] != null)
                                                   value="{{ $usedCoupon }}"
                                                   style="cursor: not-allowed;" readonly title="Cupom já aplicado"
                                                   @else
                                                   value="{{ session('msg-success') }} "
                                                   style="cursor: not-allowed;" readonly title="Cupom já aplicado"
                                                   @endif
                                                   @endif
                                                   placeholder="Insira um cupom (se tiver)." required>
                                        </div>

                                        <div class="col-12 d-flex justify-content-end">
                                            <button type="submit"  class="btn btn-primary font-weight-bold mt-3 aplicar-cupom"
                                                    @if(session('msg-success') or $myOrder['disccountUsed'] != null)
                                                    hidden
                                                @endif
                                            >Aplicar cupom</button>
                                        </div>
                                    </form>

                                    @if(session('msg-success') or $myOrder['disccountUsed'] != null)
                                        @if($myOrder['disccountUsed'] != null)
                                            <form action="{{ route('removerCupom', $myOrder['disccountUsed']) }}" method="post">
                                                @elseif(session('msg-success'))
                                                    <form action="{{ route('removerCupom', session('msg-success')) }}" method="post">
                                                        @endif
                                                        @csrf
                                                        <div class="col-12 d-flex justify-content-end">
                                                            <button type="submit" class="btn btn-danger font-weight-bold remove-cupon" title="Remover cupom">Remover Cupom</button></li>
                                                        </div>
                                                    </form>
                                        @endif

                                    <div class="col-12 mt-4">
                                        @if(isset($pendings))
                                            @if($pendings == 'Entrega em domicílio')
                                                <button class="btn btn-success font-weight-bold finalizar-pedido w-100"><i class="fas fa-check-circle mr-2"></i>Finalizar Pedido</button>
                                            @else
                                                <button class="btn btn-success font-weight-bold verifica-outro w-100"><i class="fas fa-check-circle mr-2"></i>Finalizar Pedido</button>
                                            @endif
                                        @elseif(isset($exist[0]))
                                            @if($exist[0]->deliverWay == 'Entrega em domicílio')
                                                <button class="btn btn-success font-weight-bold finalizar-pedido w-100"><i class="fas fa-check-circle mr-2"></i>Finalizar Pedido</button>
                                            @else
                                                <button class="btn btn-success font-weight-bold verifica-outro w-100"><i class="fas fa-check-circle mr-2"></i>Finalizar Pedido</button>
                                            @endif
                                        @else
                                            <button class="btn btn-success font-weight-bold finalizar-pedido w-100"><i class="fas fa-check-circle mr-2"></i>Finalizar Pedido</button>
                                        @endif
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <button class="bt-total" value="{{ $price }}" hidden></button>

    <div class="col-12 d-flex justify-content-end">
        <div class="footertray">

            <span class="badge badge-success">R$ <span class="total-val">{{ $price }}</span></span>
            <img src="{{ asset('logo/bandeja-de-comida.png') }}" style="width: 60px; height: 60px; cursor: pointer" title="Minha bandeja" data-toggle="modal" data-target="#modalDeItens">
        </div>
    </div>


        @if(isset($exist[0]))
            @if(session('msg-coupon-used') or session('msg-retire'))
                <script>
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 8000,
                        timerProgressBar: true,
                    })

                    Toast.fire({
                        icon: 'warning',
                        title: 'Cupom não aplicado pois você já o utilizou anteriormente.'
                    })
                </script>
            @else
            @if($exist[0]->deliverWay == 'Entrega em domicílio')
              @if(session('msg-exp') == false or !session('msg-use') == false)
                <script>
                    function shoot(){
                        Swal.fire({
                            title: 'Ei, atenção aqui!',
                            html: 'Você tem um pedido <b style="color: red">em andamento</b>, com isso não é possível escolher outro endereço.',
                            imageUrl: 'https://localhost/E-Pedidos/public/logo/resee.svg',
                            imageWidth: 400,
                            imageHeight: 200,
                            imageAlt: 'Revise seu pedido!',
                        })
                    }

                    shoot();

                    $(".forma-entrega").on("click", function (){
                        shoot();
                    })
                </script>
              @endif
            @elseif($exist[0]->deliverWay == 'Retirada no restaurante')
                @if(session('msg-exp') == false or !session('msg-use') == false)
                <script>
                    function shoot(){

                        Swal.fire({
                            title: 'Ei, atenção aqui!',
                            html: 'Você tem um pedido em andamento para <b style="color: red">retirada no restaurante</b>, com isso não é possível escolher outra forma de retirada, ok?',
                            imageUrl: 'https://localhost/E-Pedidos/public/logo/resee.svg',
                            imageWidth: 400,
                            imageHeight: 200,
                            imageAlt: 'Revise seu pedido!',
                        })
                    }

                    shoot();

                    $(".forma-entrega").on("click", function (){
                        shoot();
                    })
                </script>
                @endif
            @endif
        @endif
    @endif

    @if(session('msg-troco'))
        <script>
            Swal.fire({
                icon: 'warning',
                text: 'Você inseriu um valor inválido para troco.',
            })
        </script>
    @endif

    @if(session('msg-pag'))
        <script>
            Swal.fire({
                icon: 'warning',
                text: 'Cupom não aplicado porque você não escolheu uma forma de pagamento.',
            })
        </script>
    @endif

    @if(session('msg-exp') or session('msg-retire')or session('msg-pag') or session('msg-coupon-used') or session('msg-troco') or session('msg-use') or session('msg-success') or session('msg-rem-cup') or session('msg') or isset($exist[0]))

    @else
        <script>
            Swal.fire({
                title: 'Quase lá!',
                text: 'Revise seu pedido para que possa vir certinho, ok?',
                imageUrl: 'http://localhost/E-Pedidos/public/logo/resee.svg',
                imageWidth: 400,
                imageHeight: 200,
                imageAlt: 'Revise seu pedido!',
            })
        </script>
    @endif
@endsection
