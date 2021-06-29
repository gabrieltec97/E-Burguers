@extends('layouts.extend')

@section('title')
    Gerenciamento de cupons
@endsection

@section('content')

    <div class="container">
        @if(session('msg'))
            <div class="alert alert-success alerta-sucesso-user alert-dismissible fade show" role="alert">
                <span class="font-weight-bold text-muted">{{ session('msg') }} </span>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

            @if(session('msg-2'))
                <div class="alert alert-danger alerta-sucesso-user alert-dismissible fade show" role="alert">
                    <span class="font-weight-bold text-muted">{{ session('msg-2') }}</span>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
        <div class="row">
            <div class="col-lg-8 col-sm-12 mb-5">
                <div class="card">
                    <div class="card-header font-weight-bold text-white bg-danger" style="font-size: 25px;">Cadastrar cupom</div>
                    <div class="card-body">
                        <form action="{{ route('cupons.store') }}" method="post" class="form-group">
                            @csrf
                           <div class="row">
                               <div class="col-lg-6 col-12">
                                   <label class="text-muted font-weight-bold">Nome do cupom</label>
                                   <input type="text" name="couponName" class="form-control nome-cupom {{ ($errors->has('couponName') ? 'is-invalid' : '') }}" value="{{ old('couponName') }}" required>
                                   @if($errors->has('couponName'))
                                       <div class="invalid-feedback">
                                          <span class="font-weight-bold"> {{ $errors->first('couponName') }}</span>
                                       </div>
                                   @endif

                               </div>

                               <div class="col-lg-6 mt-3 mt-lg-0 col-12">
                                   <label class="text-muted font-weight-bold">Data de expiração</label>
                                   <input type="date" name="expireDate" class="form-control data-exp-cupom {{ ($errors->has('expireDate') ? 'is-invalid' : '') }}" value="{{ old('expireDate') }}" required>
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
                                   <select class="form-control select-desconto {{ ($errors->has('disccount') ? 'is-invalid' : '') }}" name="disccount" required>
                                       <option value="" selected hidden>Selecione</option>
                                       <option value="5% de desconto"{{ old('disccount') == '5% de desconto' ? 'selected' : '' }}>5% de desconto</option>
                                       <option value="10% de desconto" {{ old('disccount') == '10% de desconto' ? 'selected' : '' }}>10% de desconto</option>
                                       <option value="15% de desconto" {{ old('disccount') == '15% de desconto' ? 'selected' : '' }}>15% de desconto</option>
                                       <option value="20% de desconto" {{ old('disccount') == '20% de desconto' ? 'selected' : '' }}>20% de desconto</option>
                                       <option value="30% de desconto" {{ old('disccount') == '30% de desconto' ? 'selected' : '' }}>30% de desconto</option>
                                       <option value="50% de desconto" {{ old('disccount') == '50% de desconto' ? 'selected' : '' }}>50% de desconto</option>
                                       <option value="R$ 5 reais de desconto" {{ old('disccount') == 'R$ 5 reais de desconto' ? 'selected' : '' }}>R$ 5 reais de desconto</option>
                                       <option value="R$ 7 reais de desconto" {{ old('disccount') == 'R$ 7 reais de desconto' ? 'selected' : '' }}>R$ 7 reais de desconto</option>
                                       <option value="R$ 10 reais de desconto" {{ old('disccount') == 'R$ 10 reais de desconto' ? 'selected' : '' }}>R$ 10 reais de desconto</option>
                                       <option value="R$ 15 reais de desconto" {{ old('disccount') == 'R$ 15 reais de desconto' ? 'selected' : '' }}>R$ 15 reais de desconto</option>
                                       <option value="Frete Grátis" {{ old('disccount') == 'Frete Grátis' ? 'selected' : '' }}>Frete Grátis</option>
                                   </select>

                                   @if($errors->has('disccount'))
                                       <div class="invalid-feedback">
                                           <span class="font-weight-bold"> {{ $errors->first('disccount') }}</span>
                                       </div>
                                   @endif
                               </div>

                               <div class="col-lg-12 mt-4 col-12">
                                   <label class="text-muted font-weight-bold">Nas compras acima de R$:</label>
                                   <input type="text" name="disccountRule" autocomplete="off" class="form-control compras-acima {{ ($errors->has('disccountRule') ? 'is-invalid' : '') }}" value="{{ old('disccountRule') }}" required>
                                   @if($errors->has('disccountRule'))
                                       <div class="invalid-feedback">
                                           <span class="font-weight-bold"> {{ $errors->first('disccountRule') }}</span>
                                       </div>
                                   @endif
                               </div>

                               <div class="col-12 mt-5 d-flex justify-content-end">
                                   <button type="submit" class="btn btn-primary cadatrar-cupom">Cadastrar cupom</button>
                               </div>
                           </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-sm-12 mt-3 mb-5 mt-md-0">
                <div class="card">
                    <div class="card-header font-weight-bold text-black-50" style="font-size: 18px; background-color: #00FA9A">Cupons ativos</div>

                    <div class="card-body">
                        <table class="table table-responsive table-bordered">
                            <thead>
                            <tr>
                                <th scope="col">Cupom</th>
                                <th scope="col">Desconto</th>
                                <th scope="col">Expiração</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($coupons as $coupon)
                                    <tr>
                                        <td><a href="{{ route('cupons.edit', $coupon->id) }}" class="font-weight-bold" style="text-decoration: none" title="Clique para gerenciar este cupom">{{ $coupon->name }}</a></td>
                                        <td><a href="{{ route('cupons.edit', $coupon->id) }}" class="font-weight-bold" style="text-decoration: none" title="Clique para gerenciar este cupom">{{ $coupon->disccount }}</a></td>
                                        <td><a href="{{ route('cupons.edit', $coupon->id) }}" class="font-weight-bold" style="text-decoration: none" title="Clique para gerenciar este cupom">{{ $coupon->expireDate }}</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <select class="diaAtual" hidden>
        <option value="{{ $date }}"></option>
    </select>
@endsection
