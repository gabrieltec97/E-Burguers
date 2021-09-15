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
                        <div class="col-12 col-lg-8 mb-3">
                            <div class="card">
                                <div class="card-header bg-danger">
                                    <h5 class="font-weight-bold text-white">Finalizando pedido</h5>
                                </div>
                                <div class="card-body">
                                    <form id="cadastrarPedido" action="{{ route('pedidos.store') }}" method="post" class="form-group">
                                        @csrf
                                        <div class="row">
                                            <div class="col-12 col-lg-6 div-forma-retirada">
                                                <label class="font-weight-bold text-muted" style="font-size: 18px">Forma de retirada</label>
                                                <select name="formaRetirada" class="form-control forma-entrega">
                                                    @if(isset($pendings))
                                                        <option value="{{ $pendings }}">{{ $pendings }}</option>
                                                    @elseif(isset($exist[0]))
                                                        <option value="{{ $exist[0]->deliverWay }}">{{ $exist[0]->deliverWay }}</option>
                                                    @elseif($deliver != null)
                                                        <option value="{{ $deliver }}" class="deliver-coupon" title="Local inserido junto com cupom. Para trocar, clique em alterar local.">{{ $deliver }}</option>
                                                    @else
                                                        <option value="Entrega em domicílio">Entrega em domicílio</option>
                                                        <option value="Retirada no restaurante">Retirada no restaurante</option>
                                                    @endif
                                                </select>
                                            </div>

                                            @if(isset($pendings))

                                            @if($separated != 0 && $pendings == 'Entrega em domicílio')

                                                    @if(isset($exist[0]))
                                                        <div class="col-12 col-lg-6 local-entrega">
                                                            <label class="font-weight-bold text-muted" style="font-size: 18px">Será entregue em</label>
                                                            <input type="text" autocomplete="off" class="form-control end-entrega" name="localEntrega" required value="{{ $exist[0]->address }}" placeholder="Insira o local a ser entregue.">
                                                        </div>
                                                    @else
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

                                            @if($diffSend != null)
                                              @if($diffSend[1] != 'dinheiro' && $diffSend[1] != null)
                                                  <div class="col-12 mt-4">
                                                      <a href="https://pt.vecteezy.com/vetor-gratis/carteira" style="cursor: initial" target="_blank"><img src="{{ asset('logo/cartao-removebg-preview.png') }}" alt="pagamento" title="Pagamento em cartão" style="width: 80px; height: 80px"></a>
                                                      <h5>Pagamento em {{ $diffSend[1] }}</h5>
                                                  </div>

                                              @elseif($diffSend[1] != null)
                                                  <div class="col-12 mt-4">
                                                      <a href="https://pt.vecteezy.com/vetor-gratis/carteira" style="cursor: initial" target="_blank"><img src="{{ asset('logo/money-removebg-preview.png') }}" alt="pagamento" title="Pagamento em dinheiro" style="width: 80px; height: 80px"></a>
                                                      <h5>Pagamento em {{ $diffSend[1] }}, troco para {{ $diffSend[2] }}</h5>
                                                  </div>
                                              @endif
                                            @else
                                            <div class="col-12 col-lg-6 mt-4 pagamento">
                                                <label class="font-weight-bold text-muted" style="font-size: 18px;">Método de pagamento</label>
                                                <select name="formaPagamento" style="cursor: pointer;" class="form-control forma-pagamento">
                                                    <option value="Dinheiro">Dinheiro</option>
                                                    <option value="Cartão de crédito (Elo)">Cartão de crédito (Elo)</option>
                                                    <option value="Cartão de crédito (Visa)">Cartão de crédito (Visa)</option>
                                                    <option value="Cartão de débito (Elo)">Cartão de débito (Elo)</option>
                                                    <option value="Cartão de débito (Visa)">Cartão de débito (Visa)</option>
                                                </select>
                                            </div>

                                            <div class="col-12 col-lg-6 mt-4 val-entregue">
                                                <label class="font-weight-bold text-muted" style="font-size: 18px">Valor entregue</label>
                                                <input type="text" autocomplete="off" class="form-control troco mb-2" name="valEntregue" placeholder="Cálculo de troco" required>
                                                <span class="text-danger font-weight-bold verifica-val-troco">O valor do troco não pode ser menor ou igual ao valor do pedido.</span>
                                                <span class="text-primary font-weight-bold verifica-troco">Informe o valor que você pagará no ato da compra para que possamos calcular o troco (Caso necessário).</span>
                                            </div>
                                            @endif

                                                <div class="col-12 col-lg-6 mt-4 mt-lg-4 bairro-entrega">
                                                    <label class="font-weight-bold text-muted" style="font-size: 18px">Bairro</label>
                                                    <select class="form-control entregaDiff" name="diffDistrict">
                                                        <option value="" selected hidden>Selecione</option>
                                                        @foreach($places as $place)
                                                            <option value="{{ $place->name }}">{{ $place->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="col-12 col-lg-6 mt-4 mt-lg-4 bairro-entrega">
                                                    <label class="font-weight-bold text-muted" style="font-size: 18px">Ponto de referência</label>
                                                    <input type="text" class="form-control pontoRef" name="pontoRef" placeholder="Dê mais detalhes sobre a localização.">
                                                </div>
                                            @endif
                                            @endif

                                            @if(isset($exist[0]) && !isset($pendings))
                                                @if($exist[0]->deliverWay == 'Entrega em domicílio')
                                                    @if(isset($exist[0]))
                                                        <div class="col-12 col-lg-6 local-entrega">
                                                            <label class="font-weight-bold text-muted" style="font-size: 18px">Será entregue em</label>
                                                            <input type="text" autocomplete="off" class="form-control end-entrega" name="localEntrega" required value="{{ $exist[0]->address }}" placeholder="Insira o local a ser entregue.">
                                                        </div>
                                                    @else
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

                                                    @if($diffSend != null)
                                                        @if($diffSend[1] != 'dinheiro' && $diffSend[1] != null)
                                                            <div class="col-12 mt-4">
                                                                <a href="https://pt.vecteezy.com/vetor-gratis/carteira" style="cursor: initial" target="_blank"><img src="{{ asset('logo/cartao-removebg-preview.png') }}" alt="pagamento" title="Pagamento em cartão" style="width: 80px; height: 80px"></a>
                                                                <h5>Pagamento em {{ $diffSend[1] }}</h5>
                                                            </div>
                                                        @elseif($diffSend[1] != null)
                                                            <div class="col-12 mt-4">
                                                                <a href="https://pt.vecteezy.com/vetor-gratis/carteira" style="cursor: initial" target="_blank"><img src="{{ asset('logo/money-removebg-preview.png') }}" alt="pagamento" title="Pagamento em dinheiro" style="width: 80px; height: 80px"></a>
                                                                <h5>Pagamento em {{ $diffSend[1] }}, troco para {{ $diffSend[2] }}</h5>
                                                            </div>
                                                        @endif
                                                    @else
                                                        <div class="col-12 col-lg-6 mt-4 pagamento">
                                                            <label class="font-weight-bold text-muted" style="font-size: 18px;">Método de pagamento</label>
                                                            <select name="formaPagamento" style="cursor: pointer;" class="form-control forma-pagamento">
                                                                <option value="Dinheiro">Dinheiro</option>
                                                                <option value="Cartão de crédito (Elo)">Cartão de crédito (Elo)</option>
                                                                <option value="Cartão de crédito (Visa)">Cartão de crédito (Visa)</option>
                                                                <option value="Cartão de débito (Elo)">Cartão de débito (Elo)</option>
                                                                <option value="Cartão de débito (Visa)">Cartão de débito (Visa)</option>
                                                            </select>
                                                        </div>

                                                        <div class="col-12 col-lg-6 mt-4 val-entregue">
                                                            <label class="font-weight-bold text-muted" style="font-size: 18px">Valor entregue</label>
                                                            <input type="text" autocomplete="off" class="form-control troco mb-2" name="valEntregue" placeholder="Cálculo de troco" required>
                                                            <span class="text-danger font-weight-bold verifica-val-troco">O valor do troco não pode ser menor ou igual ao valor do pedido.</span>
                                                            <span class="text-primary font-weight-bold verifica-troco">Informe o valor que você pagará no ato da compra para que possamos calcular o troco (Caso necessário).</span>
                                                        </div>
                                                    @endif

                                                    <div class="col-12 col-lg-6 mt-4 mt-lg-4 bairro-entrega">
                                                        <label class="font-weight-bold text-muted" style="font-size: 18px">Bairro</label>
                                                        <select class="form-control entregaDiff" name="diffDistrict">
                                                            <option value="" selected hidden>Selecione</option>
                                                            @foreach($places as $place)
                                                                <option value="{{ $place->name }}">{{ $place->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="col-12 col-lg-6 mt-4 mt-lg-4 bairro-entrega">
                                                        <label class="font-weight-bold text-muted" style="font-size: 18px">Ponto de referência</label>
                                                        <input type="text" class="form-control pontoRef" name="pontoRef" placeholder="Dê mais detalhes sobre a localização.">
                                                    </div>
                                                @endif
                                            @endif

                                                @if(isset($separated))
                                                @if($separated == 0)

{{--                                                Verificando se o cupom foi inserido em um local diferente.    --}}
                                                @if($diffSend != null)
                                                    <div class="col-12 col-lg-6 local-entrega">
                                                        <label class="font-weight-bold text-muted" style="font-size: 18px">Será entregue em</label>
                                                        <input type="text" autocomplete="off" class="form-control end-entrega" name="localEntrega" required value="{{ $diffSend[0] }}" title="Local inserido junto com cupom.">
                                                    </div>

                                                    @if($diffSend[1] != 'dinheiro' && $diffSend[1] != null)
                                                      <div class="col-6 mt-4">
                                                          <a href="https://pt.vecteezy.com/vetor-gratis/carteira" style="cursor: initial" target="_blank"><img src="{{ asset('logo/cartao-removebg-preview.png') }}" alt="pagamento" title="Pagamento em cartão" style="width: 80px; height: 80px"></a>
                                                          <h5>Pagamento em {{ $diffSend[1] }}</h5>
                                                      </div>

                                                      <div class="col-6 mt-4">
                                                          <button type="button" title="Alterar local de entrega." class="btn btn-primary float-right alterar-local-cupom">Alterar local</button>
                                                      </div>
                                                    @elseif($diffSend[1] != null)
                                                      <div class="col-6 mt-4">
                                                          <a href="https://pt.vecteezy.com/vetor-gratis/carteira" style="cursor: initial" target="_blank"><img src="{{ asset('logo/money-removebg-preview.png') }}" alt="pagamento" title="Pagamento em dinheiro" style="width: 80px; height: 80px"></a>
                                                          <h5>Pagamento em {{ $diffSend[1] }}, troco para {{ $diffSend[2] }}</h5>
                                                      </div>

                                                      <div class="col-6 mt-4">
                                                          <button type="button" title="Alterar local de entrega." class="btn btn-primary float-right alterar-local-cupom">Alterar local</button>
                                                      </div>
                                                    @endif
                                                @else
                                                    <div class="col-12 col-lg-6 entrega">
                                                        <label class="font-weight-bold text-muted" style="font-size: 18px">Entregar em</label>
                                                        <br>
                                                        <input type="radio" class="entregaCasa mt-1" name="entrega" value="Entregaemcasa">
                                                        <label class="font-weight-bold text-muted"><span class="text-success">Meu endereço</span></label>
                                                        <input type="radio" class="entregaFora  ml-2" name="entrega" value="localEntregaFora">
                                                        <label class="font-weight-bold text-muted"><span class="text-danger">Outro local (Insira)</span></label><br>
                                                    </div>

                                                    <div class="col-12 col-lg-6 mt-4 mt-lg-4 local-entrega">
                                                        <label class="font-weight-bold text-muted" style="font-size: 18px">Será entregue em</label>
                                                        <input type="text" autocomplete="off" class="form-control end-entrega" name="localEntrega" required value="{{ $sendAddress }}" placeholder="Insira o local a ser entregue.">
                                                    </div>

                                                    <div class="col-12 col-lg-6 mt-4 mt-lg-4 bairro-entrega">
                                                        <label class="font-weight-bold text-muted" style="font-size: 18px">Bairro</label>
                                                        <select class="form-control entregaDiff" name="diffDistrict">
                                                            <option value="" selected hidden>Selecione</option>
                                                            @foreach($places as $place)
                                                                <option value="{{ $place->name }}">{{ $place->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="col-12 col-lg-6 mt-4 mt-lg-4 bairro-entrega">
                                                        <label class="font-weight-bold text-muted" style="font-size: 18px">Ponto de referência</label>
                                                        <input type="text" class="form-control pontoRef" name="pontoRef" placeholder="Dê mais detalhes sobre a localização.">
                                                    </div>

                                                    <div class="col-12 col-lg-6 mt-4 pagamento">
                                                        <label class="font-weight-bold text-muted" style="font-size: 18px;">Método de pagamento</label>
                                                        <select name="formaPagamento" style="cursor: pointer;" class="form-control forma-pagamento">
                                                            <option value="Dinheiro">Dinheiro</option>
                                                            <option value="Cartão de crédito (Elo)">Cartão de crédito (Elo)</option>
                                                            <option value="Cartão de crédito (Visa)">Cartão de crédito (Visa)</option>
                                                            <option value="Cartão de débito (Elo)">Cartão de débito (Elo)</option>
                                                            <option value="Cartão de débito (Visa)">Cartão de débito (Visa)</option>
                                                        </select>
                                                    </div>

                                                    <div class="col-12 col-lg-6 mt-4 mt-lg-4 val-entregue">
                                                        <label class="font-weight-bold text-muted" style="font-size: 18px">Valor entregue</label>
                                                        <input type="number" autocomplete="off" class="form-control troco mb-2" name="valEntregue" placeholder="Cálculo de troco" required>
                                                        <span class="text-danger font-weight-bold verifica-val-troco">O valor do troco não pode ser menor ou igual ao valor do pedido.</span>
                                                        <span class="text-primary font-weight-bold verifica-troco">Informe o valor que você pagará no ato da compra para que possamos calcular o troco (Caso necessário).</span>
                                                    </div>
                                                @endif
                                                    @if(isset($exist[0]))
                                                        <div class="col-12 col-lg-8 mt-4 mt-lg-4 local-entrega">
                                                            <label class="font-weight-bold text-muted" style="font-size: 18px">Será entregue em</label>
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
                                                <label class="font-weight-bold text-muted" style="font-size: 18px">Observações</label>
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
                                                        <button type="submit" class="btn btn-primary font-weight-bold cadastrar-pedido-agora">Não, pode trazer meu pedido</button>
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

                            @if(session('msg-retire'))
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
                                            title: 'Cupom não inserido, pois você tinha escolhido a opção de retirada no restaurante.'
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
                                    <h5 class="font-weight-bold text-white"><i class="fas fa-hamburger mr-2"></i>Meus itens e cupom</h5>
                                </div>
                                <div class="card-body">

                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalDeItens">
                                        <i class="fas fa-utensils mr-2"></i>Ver meus itens
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="modalDeItens" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLongTitle">Meus itens da bandeja.</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
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
                                                                                        <button class="removeItem ml-1 edit-extras-items" title="Editar itens extras" data-toggle="modal" data-target="#editarExtrasCombo"><i class="fas fa-edit text-primary" style="font-size: 16px"></i></button></li>
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

{{--                                                                    <hr>--}}
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
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-success" data-dismiss="modal">Fechar</button>
                                                </div>
                                            </div>
                                        </div>
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


                                    <form id="couponApply" action="{{ route('aplicarCupom') }}" method="post">
                                        @csrf

                                        <input name="diffEnd" class="diffEnd" hidden>
                                        <input name="newPrice" class="newPrice" hidden>
                                        <input name="refPoint" class="refPoint" hidden>
                                        <input name="district" class="district" hidden>
                                        <input name="deliverType" class="deliverType" hidden>
                                        <input name="payingMethod" class="payingMethod" hidden>
                                        <input name="payingValue" class="payingValue" hidden>
                                        <div class="col-12 div-cupom">
                                            <label class="font-weight-bold text-muted" style="font-size: 18px">Cupom de desconto

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
                                            <button type="submit"  class="btn btn-primary font-weight-bold mt-2 aplicar-cupom"
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
                            html: 'Você tem um pedido em andamento para <b style="color: red">entrega em domicílio</b>, com isso não é possível escolher outra forma de retirada.',
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

    @if(session('msg-exp') or session('msg-retire') or session('msg-coupon-used') or session('msg-troco') or session('msg-use') or session('msg-success') or session('msg-rem-cup') or session('msg') or isset($exist[0]))

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
