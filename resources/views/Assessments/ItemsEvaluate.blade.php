@extends('layouts.extend-client')
<script src="{{ asset('js/jquery.js') }}"></script>
@section('title')
    Sua opinião sobre nós
@endsection

@section('content')
    <div class="container-fluid div-aval-desktop-2">
       <div class="row" style="margin-top: 200px">

           @if($rated['ordered'] != 0)
               @if(count($itensToEvaluate) == 0)
                   @if($rated['rated'] == 0)

                      <div class="container">
                          <div class="card mb-4">
                              <div class="card-header bg-dark">
                                  <span style="color: white; font-size: 17px">Faça uma avaliação sobre nós</span>
                              </div>
                              <div class="card-body">
                                  <div class="container-fluid">
                                      <div class="row">
                                          <div class="col-12 mb-3 mt-2">
                                              <form action="{{ route('enviarAvaliacao') }}" method="get">
                                                  @csrf
                                                  <div class="wrap">
                                                      <div class="stars">
                                                          <label class="rate">
                                                              <input type="radio" name="radio1" id="star1" value="1">
                                                              <div class="face"></div>
                                                              <i class="far fa-star star one-star"></i>
                                                          </label>
                                                          <label class="rate">
                                                              <input type="radio" name="radio1" id="star2" value="2">
                                                              <div class="face"></div>
                                                              <i class="far fa-star star two-star"></i>
                                                          </label>
                                                          <label class="rate">
                                                              <input type="radio" name="radio1" id="star3" value="3">
                                                              <div class="face"></div>
                                                              <i class="far fa-star star three-star"></i>
                                                          </label>
                                                          <label class="rate">
                                                              <input type="radio" name="radio1" id="star4" value="4">
                                                              <div class="face"></div>
                                                              <i class="far fa-star star four-star"></i>
                                                          </label>
                                                          <label class="rate">
                                                              <input type="radio" name="radio1" required id="star5" value="5">
                                                              <div class="face"></div>
                                                              <i class="far fa-star star five-star"></i>
                                                          </label>
                                                      </div>
                                                  </div>
                                          </div>

                                          <div class="col-12 mb-3">
                                              <textarea name="opiniao" style="resize: none;" placeholder="Faça elogios e/ou diga em que podemos melhorar :)" class="form-control" cols="30" rows="10" required></textarea>
                                          </div>

                                          <div class="col-12 mt-4">
                                              <button class="btn btn-success float-right send-asset">Enviar avaliação</button>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                       </form>
                   @else

                       <div class="container div-aval-desktop">
                           <div class="card mb-4">
                               <h5 class="card-header bg-dark" style="color: white">Minhas avaliações</h5>
                               <div class="card-body">
                                  <div class="container-fluid">
                                      <div class="row">
                                          <div class="col-12 col-lg-6 d-flex justify-content-center">
                                              <img src="{{ asset('logo/reviews.png') }}" class="img-aval" alt="">
                                          </div>

                                          <div class="col-12 col-lg-6">
                                              <h2 class="text-center">Obrigado pela sua avaliação</h2>
                                              <span class="text-center" style="font-size: 15px">Você avaliou todos os itens pedidos até o momento e também avaliou o estabelecimento. Obrigado pela ajuda!</span>
                                              <br>
                                              <button class="btn btn-primary mt-lg-1 offset-4 btn-desktop" onclick="getClick()" data-toggle="modal" data-target="#modalAvaliar"><i class="fa fa-star text-warning"></i> Avaliar novamente</button>
                                          </div>

                                          <div class="col-12 d-flex justify-content-center mt-3">
                                              <button class="btn btn-primary mt-lg-1 btn-mobile" onclick="getClick()" data-toggle="modal" data-target="#modalAvaliar"><i class="fa fa-star text-warning"></i> Avaliar novamente</button>
                                          </div>
                                      </div>
                                  </div>
                               </div>
                           </div>
                       </div>


                       <!-- Modal -->
                       <div class="modal fade" id="modalAvaliar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                           <div class="modal-dialog" role="document">
                               <div class="modal-content">
                                   <div class="modal-header bg-dark">
                                       <h5 class="modal-title" id="exampleModalLabel" style="color: white">Nova avaliação</h5>
                                       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                           <span aria-hidden="true">&times;</span>
                                       </button>
                                   </div>
                                   <div class="modal-body">
                                       <div class="container-fluid">
                                           <div class="row">
                                               <div class="col-12">
                                                   <h2 class="text-center mb-4">Faça uma avaliação sobre nós</h2>
                                               </div>

                                               <div class="col-12 mb-4">
                                                   <form action="{{ route('enviarAvaliacao') }}" method="get">
                                                       @csrf
                                                       <div class="wrap">
                                                           <div class="stars">
                                                               <label class="rate">
                                                                   <input type="radio" name="radio1" id="star1" value="1">
                                                                   <div class="face"></div>
                                                                   <i class="far fa-star star one-star"></i>
                                                               </label>
                                                               <label class="rate">
                                                                   <input type="radio" name="radio1" id="star2" value="2">
                                                                   <div class="face"></div>
                                                                   <i class="far fa-star star two-star"></i>
                                                               </label>
                                                               <label class="rate">
                                                                   <input type="radio" name="radio1" id="star3" value="3">
                                                                   <div class="face"></div>
                                                                   <i class="far fa-star star three-star"></i>
                                                               </label>
                                                               <label class="rate">
                                                                   <input type="radio" name="radio1" id="star4" value="4">
                                                                   <div class="face"></div>
                                                                   <i class="far fa-star star four-star"></i>
                                                               </label>
                                                               <label class="rate">
                                                                   <input type="radio" name="radio1" required id="star5" value="5">
                                                                   <div class="face"></div>
                                                                   <i class="far fa-star star five-star"></i>
                                                               </label>
                                                           </div>
                                                       </div>
                                               </div>

                                               <div class="col-12 mb-3">
                                                   <textarea name="opiniao" style="resize: none;" placeholder="Diga-nos o que mudou desde a ultima avaliação :)" class="form-control" cols="30" rows="10" required></textarea>
                                               </div>

                                               <div class="col-12 mt-4">
                                                   <button class="btn btn-success float-right send-asset">Enviar avaliação</button>
                                               </div>
                                               </form>
                                           </div>
                                       </div>
                                   </div>
                               </div>
                           </div>
                       </div>
                   @endif
               @endif
           @else

               <div class="container div-aval-desktop">
                   <div class="card mb-4">
                       <h5 class="card-header bg-dark" style="color: white">Minhas avaliações</h5>
                       <div class="card-body">
                           <div class="container-fluid">
                               <div class="row">
                                   <div class="col-12 d-flex justify-content-center col-lg-6">
                                       <img src="{{ asset('logo/eta.png') }}" class="img-aval" alt="">
                                   </div>

                                   <div class="col-12 col-lg-6">
                                       <hr class="hr-mobile">
                                       <h2 class="text-center">Para fazer uma avaliação, primeiro você precisa fazer um pedido.</h2>
                                       <br>
                                       <a href="{{ route('tipoPedido') }}" class="btn btn-primary mt-lg-1 offset-5 pedir-desktop">Pedir agora</a>
                                   </div>

                                   <div class="col-12 d-flex justify-content-center">
                                       <a href="{{ route('tipoPedido') }}" class="btn btn-primary pedir-mobile mt-lg-1">Pedir agora</a>
                                   </div>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
               @endif

               @if(count($itensToEvaluate ) != 0)
                   <div class="container div-aval-desktop">
                       <div class="card mb-4">
                           <h5 class="card-header bg-dark" style="color: white">Itens para você avaliar</h5>
                           <div class="card-body">
                               <div class="container-fluid">
                                   <div class="row">
                                       @foreach($itensToEvaluate as $item)
                                           <div class="col-12 col-lg-3">
                                               <img src="{{ asset($item[2]) }}" class="img-check" style="margin-left: auto; margin-right: auto; border-radius: 5px; width: 190px; height: 130px">
                                               <label for="{{ $item[1] }}" class="mt-3">{{ $item[1] }}</label><br>
                                               <button class="btn btn-primary float-right" data-toggle="modal" data-target="#modalAvaliacao{{$item[0]}}">Avaliar</button>
                                           </div>

                                           <!-- Modal -->
                                           <div class="modal fade" id="modalAvaliacao{{$item[0]}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                               <div class="modal-dialog modal-dialog-centered" role="document">
                                                   <div class="modal-content">
                                                       <div class="modal-header" style="background-color: #343a40">
                                                           <h5 class="modal-title" id="exampleModalLongTitle" style="color: white">Qual nota você daria para este item?</h5>
                                                           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                               <span aria-hidden="true">&times;</span>
                                                           </button>
                                                       </div>
                                                       <div class="modal-body">
                                                           <form action="{{ route('avaliar', $item[0]) }}" method="get">
                                                               @csrf
                                                               <div class="container-fluid mt-4">
                                                                   <div class="row">
                                                                       <div class="col-12 d-flex justify-content-center">
                                                                           <div class="wrap">
                                                                               <div class="stars">
                                                                                   <label class="rate">
                                                                                       <input type="radio" name="radio1" id="star1" value="1">
                                                                                       <div class="face"></div>
                                                                                       <i class="far fa-star star one-star"></i>
                                                                                   </label>
                                                                                   <label class="rate">
                                                                                       <input type="radio" name="radio1" id="star2" value="2">
                                                                                       <div class="face"></div>
                                                                                       <i class="far fa-star star two-star"></i>
                                                                                   </label>
                                                                                   <label class="rate">
                                                                                       <input type="radio" name="radio1" id="star3" value="3">
                                                                                       <div class="face"></div>
                                                                                       <i class="far fa-star star three-star"></i>
                                                                                   </label>
                                                                                   <label class="rate">
                                                                                       <input type="radio" name="radio1" id="star4" value="4">
                                                                                       <div class="face"></div>
                                                                                       <i class="far fa-star star four-star"></i>
                                                                                   </label>
                                                                                   <label class="rate">
                                                                                       <input type="radio" name="radio1" id="star5" value="5">
                                                                                       <div class="face"></div>
                                                                                       <i class="far fa-star star five-star"></i>
                                                                                   </label>
                                                                               </div>
                                                                           </div>
                                                                       </div>
                                                                   </div>
                                                               </div>

                                                       </div>
                                                       <div class="modal-footer">
                                                           <button type="submit" class="btn btn-success send-aval">Enviar avaliação</button>
                                                           </form>
                                                       </div>
                                                   </div>
                                               </div>
                                           </div>
                                       @endforeach

                                   </div>
                               </div>
                           </div>
                       </div>
                   </div>
               @endif
       </div>
    </div>

    <script>
        $(function() {

            $(document).on('click', '.rate', function() {
                if ( !$(this).find('.star').hasClass('rate-active') ) {
                    $(this).siblings().find('.star').addClass('far').removeClass('fas rate-active');
                    $(this).find('.star').addClass('rate-active fas').removeClass('far star-over');
                    $(this).prevAll().find('.star').addClass('fas').removeClass('far star-over');
                } else {
                    console.log('has');
                }
            });

        });
    </script>

    @if(session('msg'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Obrigado! A sua avaliação é muito importante para nós e para os outros clientes :)',
                position: 'top-end',
                toast: true,
                showConfirmButton: false,
                showCloseButton: true,
                timer: 4000,
                timerProgressBar: true
            })
        </script>
    @endif

    @if(count($order) > 0 && $rated['rated'] != 0)
        <script>

            let click = 'Nao'

            function getClick(){
                click = 'Sim';
            }
            setTimeout(function() {
                if (click == 'Nao'){
                    window.location.href = "{{ route('preparo.index') }}";
                }
            }, 3000);
        </script>
    @endif
@endsection


