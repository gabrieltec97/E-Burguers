@extends('layouts.extend')

@section('title')
    Gerenciamento de cupons
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header font-weight-bold text-white" style="font-size: 25px; background: linear-gradient(90deg, rgba(40,114,148,1) 35%, rgba(0,212,255,1) 100%);">Edição de cupom</div>
                    <div class="card-body">
                        <form action="{{ route('cupons.update', $coupon->id) }}" method="post" class="form-group cupom-sub">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-lg-6 col-12">
                                    <label class="text-muted font-weight-bold">Nome do cupom</label>
                                    <input type="text" name="couponName" class="form-control novo-nome {{ ($errors->has('couponName') ? 'is-invalid' : '') }}" value="{{ $coupon->name }}">
                                    @if($errors->has('couponName'))
                                        <div class="invalid-feedback">
                                            <span class="font-weight-bold"> {{ $errors->first('couponName') }}</span>
                                        </div>
                                    @endif
                                </div>

                                <div class="col-lg-6 mt-3 mt-lg-0 col-12">
                                    <label class="text-muted font-weight-bold">Data de expiração</label>
                                    <input type="date" name="expireDate" class="form-control data-exp {{ ($errors->has('expireDate') ? 'is-invalid' : '') }}" value="{{ $coupon->expireDate }}">
                                    @if($errors->has('expireDate'))
                                        <div class="invalid-feedback">
                                            <span class="font-weight-bold"> {{ $errors->first('expireDate') }}</span>
                                        </div>
                                    @endif

                                    <label class="text-danger mt-2 font-weight-bold cupom-expire" style="font-size: 13px">Para usar este cupom hoje, coloque a expiração para amanhã ou mais.</label>
                                    <label class="text-danger mt-2 font-weight-bold cupom-expire2" style="font-size: 13px">A data de expiração não pode ser menor ou igual a data atual.</label>
                                </div>

                                <div class="col-lg-12 mt-3 mt-lg-4 col-12">
                                    <label class="text-muted font-weight-bold">Desconto a ser aplicado</label>
                                    <select class="form-control select-desconto" name="disccount">
                                        <option value="" selected hidden>Selecione</option>
                                        <option value="5% de desconto" {{ old('disccount') == '5% de desconto' ? 'selected' : '' }} {{ ($coupon->disccount == '5% de desconto')?'selected':'' }}>5% de desconto</option>
                                        <option value="10% de desconto" {{ old('disccount') == '10% de desconto' ? 'selected' : '' }} {{ ($coupon->disccount == '10% de desconto')?'selected':'' }}>10% de desconto</option>
                                        <option value="15% de desconto" {{ old('disccount') == '15% de desconto' ? 'selected' : '' }} {{ ($coupon->disccount == '15% de desconto')?'selected':'' }}>15% de desconto</option>
                                        <option value="20% de desconto" {{ old('disccount') == '20% de desconto' ? 'selected' : '' }} {{ ($coupon->disccount == '20% de desconto')?'selected':'' }}>20% de desconto</option>
                                        <option value="30% de desconto" {{ old('disccount') == '30% de desconto' ? 'selected' : '' }} {{ ($coupon->disccount == '30% de desconto')?'selected':'' }}>30% de desconto</option>
                                        <option value="50% de desconto" {{ old('disccount') == '50% de desconto' ? 'selected' : '' }} {{ ($coupon->disccount == '50% de desconto')?'selected':'' }}>50% de desconto</option>
                                        <option value="R$ 5 reais de desconto" {{ old('disccount') == 'R$ 5 reais de desconto' ? 'selected' : '' }}{{ ($coupon->disccount == 'R$ 5 reais de desconto')?'selected':'' }}>R$ 5 reais de desconto</option>
                                        <option value="R$ 7 reais de desconto" {{ old('disccount') == 'R$ 7 reais de desconto' ? 'selected' : '' }}{{ ($coupon->disccount == 'R$ 7 reais de desconto')?'selected':'' }}>R$ 7 reais de desconto</option>
                                        <option value="R$ 10 reais de desconto" {{ old('disccount') == 'R$ 10 reais de desconto' ? 'selected' : '' }}{{ ($coupon->disccount == 'R$ 10 reais de desconto')?'selected':'' }}>R$ 10 reais de desconto</option>
                                        <option value="R$ 15 reais de desconto" {{ old('disccount') == 'R$ 15 reais de desconto' ? 'selected' : '' }}{{ ($coupon->disccount == 'R$ 15 reais de desconto')?'selected':'' }}>R$ 15 reais de desconto</option>
                                        <option value="Frete Grátis" {{ old('disccount') == 'Frete Grátis' ? 'selected' : '' }} {{ ($coupon->disccount == 'Frete Grátis')?'selected':'' }}>Frete Grátis</option>
                                    </select>

                                    @if($errors->has('disccount'))
                                        <div class="invalid-feedback">
                                            <span class="font-weight-bold"> {{ $errors->first('disccount') }}</span>
                                        </div>
                                    @endif
                                </div>

                                <div class="col-lg-12 mt-4 col-12">
                                    <label class="text-muted font-weight-bold">Nas compras acima de R$:</label>
                                    <input type="text" name="disccountRule" autocomplete="off" class="form-control compras-acima {{ ($errors->has('disccountRule') ? 'is-invalid' : '') }}" value="{{ $coupon->disccountRule }}">
                                    @if($errors->has('disccountRule'))
                                        <div class="invalid-feedback">
                                            <span class="font-weight-bold"> {{ $errors->first('disccountRule') }}</span>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div>
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title font-weight-bold" id="exampleModalLongTitle" style="color: black; margin-bottom: -5px">Revise as alterações</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p class="font-weight-bold mb-2 p-mudancas text-center" style="color: black"></p>

                                                <img src="{{ asset('logo/cara.svg') }}" class="imagem-alteracao" style="width: 100px; margin-left: 40%; height: 100px" hidden>
                                                <div class="row">

                                                    <div class="col-6 div-novo-nome" hidden>
                                                        <p class="font-weight-bold text-primary text-center" style="color: black">Nome do cupom</p>
                                                        <p class="font-weight-bold text-center" style="color: black">Nome anterior: <span class="text-danger">{{ $coupon->name }}</span></p>
                                                        <p class="font-weight-bold text-center" style="color: black">Novo nome: <span class="novo-nome-cupom text-success"></span></p>
                                                    </div>

                                                    <div class="col-6 div-nova-data" hidden>
                                                        <p class="font-weight-bold text-center text-primary" style="color: black">Data de expiração</p>
                                                        <p class="font-weight-bold text-center" style="color: black">Data anterior: <span class="text-danger">{{ $coupon->expireDate }}</span></p>
                                                        <p class="font-weight-bold text-center" style="color: black">Nova data: <span class="nova-data text-success"></span></p>
                                                    </div>

                                                    <div class="col-6 mt-4 div-novo-desconto" hidden>
                                                        <p class="font-weight-bold text-center" style="color: black">Desconto aplicado</p>
                                                        <p class="font-weight-bold text-center" style="color: black">Anterior: <span class="text-danger">{{ $coupon->disccount }}</span></p>
                                                        <p class="font-weight-bold text-center" style="color: black">Novo: <span class="novo-desconto text-success"></span></p>
                                                    </div>

                                                    <div class="col-6 mt-4 div-novo-valor" hidden>
                                                        <p class="font-weight-bold text-center" style="color: black">Valor de compra mínimo</p>
                                                        <p class="font-weight-bold text-center" style="color: black">Valor compra anterior: <span class="text-danger">{{ $coupon->disccountRule }}</span></p>
                                                        <p class="font-weight-bold text-center" style="color: black">Novo valor compra: <span class="novo-valor text-success"></span></p>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-primary" data-dismiss="modal">Voltar à edição</button>
                                                <button type="submit" class="btn btn-success botao-salvar">Salvar alterações</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="col-12 ml-3 mt-5 d-flex justify-content-end">
                            <button class="btn btn-danger salvamento-alteracoes-cupom mr-2" onclick="deleteThis()">Deletar Cupom</button>
                            <button data-toggle="modal" data-target="#exampleModalCenter" class="btn btn-primary salvamento-alteracoes-cupom">Salvar alterações</button>
                        </div>
                    </div>
                </div>
            </div>


            <form id="couponDelete" action="{{ route('cupons.destroy', $coupon->id) }}" method="post">
                @csrf
                @method('DELETE')
                <!-- Modal -->
                <div class="modal fade" id="exampleModalCenterDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title font-weight-bold" id="exampleModalLongTitle">Atenção!</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <h5 class="font-weight-bold text-muted">Tem certeza que deseja excluir este cupom? E</h5>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-success" data-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-danger">Deletar cupom</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            @if(session('msg-2'))
                <script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Cupom não alterado!',
                        text: 'Já existe um cupom registrado com este nome e data, consulte a lista de cupons ativos.',
                    })
            </script>
    @endif

            <script>
               function deleteThis(){
                   Swal.fire({
                       icon: 'warning',
                       title: 'Deseja excluir este cupom?',
                       showCancelButton: false,
                       showConfirmButton: false,
                       html: '<button type="button" class="btn btn-success mt-2 fechar">Voltar</button>' +
                           '<button type="button" class="btn btn-danger mt-2 ml-4 deleteNow">Deletar cupom</button>'
                   });

                   $(".fechar").on('click', function (){
                       Swal.close()
                   })

                   $(".deleteNow").on('click', function (){
                       $(this).html('<div class="spinner-border text-light" role="status"></div>');
                       $("#couponDelete").submit();
                   })
               }
            </script>
@endsection


