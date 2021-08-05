@extends('layouts.extend-client')
<script src="{{ asset('js/jquery.js') }}"></script>
@section('title')
    Sua opinião sobre nós
@endsection

@section('content')
    <div class="container w-75 mt-5">
       <div class="row mt-5">

           @if($rated['ordered'] != 0)
               @if(count($itensToEvaluate) == 0)
                   @if($rated['rated'] == 0)
                       <div class="col-12">
                           <h2 class="text-center mt-5 mb-5">Faça uma avaliação sobre nós</h2>
                       </div>

                       <div class="col-12 mb-5">
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
                           <textarea name="opiniao" style="resize: none;" placeholder="Diga em que podemos melhorar :)" class="form-control" cols="30" rows="10" required></textarea>
                       </div>

                       <div class="col-12 mt-4">
                           <button class="btn btn-success float-right">Enviar avaliação</button>
                       </div>
                       </form>

                   @else
                       Obrigado pela sua avaliação!

                       <button class="btn btn-primary" data-toggle="modal" data-target="#modalAvaliar">Avaliar novamente</button>

                       <!-- Modal -->
                       <div class="modal fade" id="modalAvaliar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                           <div class="modal-dialog" role="document">
                               <div class="modal-content">
                                   <div class="modal-header">
                                       <h5 class="modal-title" id="exampleModalLabel">Nova avaliação</h5>
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
                                                   <button class="btn btn-success float-right">Enviar avaliação</button>
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
               Para fazer uma avaliação, primeiro você precisa fazer um pedido.
               @endif

           @foreach($itensToEvaluate as $item)
               <div class="col-5 col-md-4 mt-5">
                   <img src="{{ asset($item[2]) }}" alt="" style="width: 200px; height: 150px">
                   <label for="{{ $item[1] }}" class="mt-4 mt-md-0 d-flex justify-content-center">{{ $item[1] }}</label><br>
                   <button class="btn btn-primary offset-4" data-toggle="modal" data-target="#modalAvaliacao{{$item[0]}}">Avaliar</button>

                   <!-- Modal -->
                   <div class="modal fade" id="modalAvaliacao{{$item[0]}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                       <div class="modal-dialog modal-dialog-centered" role="document">
                           <div class="modal-content">
                               <div class="modal-header">
                                   <h5 class="modal-title" id="exampleModalLongTitle">Conte para nós como estava o lanche</h5>
                                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                       <span aria-hidden="true">&times;</span>
                                   </button>
                               </div>
                               <div class="modal-body">
                                   <form action="{{ route('avaliar', $item[0]) }}" method="get">
                                       @csrf
                                        <div class="container-fluid">
                                            <div class="row">
                                                <div class="col-12">
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
                                   <button type="submit" class="btn btn-success">Enviar avaliação</button>
                                   </form>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
           @endforeach
       </div>
    </div>

    <script>
        $(function() {

            // $(document).on({
            //     mouseover: function(event) {
            //         $(this).find('.far').addClass('star-over');
            //         $(this).prevAll().find('.far').addClass('star-over');
            //     },
            //     mouseleave: function(event) {
            //         $(this).find('.far').removeClass('star-over');
            //         $(this).prevAll().find('.far').removeClass('star-over');
            //     }
            // }, '.rate');


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
            $.toast({
                text: '<b style="font-size: 14px;">A sua avaliação é muito importante para nós e para os outros clientes :)</b>',
                heading: '<b style="font-size: 17px">Muito obrigado!</b>',
                showHideTransition: 'slide',
                bgColor : '#38C172',
                position : 'top-right',
                hideAfter: 9000
            })
        </script>
    @endif
@endsection


