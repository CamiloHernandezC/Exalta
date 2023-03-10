@extends('layouts.profile')

@section('title')
    Mi Perfil
@endsection

@include('cliente.completeProfileClient')

@section('modals')

    <!--solicitud modal ELIMINAR-->
    <!--Solo se utiliza para clientes ya que los entrenadores pueder ir a la info de la solictud y eliminar su oferta-->
    <div class="modal fade" id="solicitudModalEliminar" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="eliminarSolicitudForm" method="post"
                      action="{{route('eliminarSolicitud', ['user'=> Auth::user()->slug])}}"
                      autocomplete="off">
                    @method('DELETE')
                    @csrf

                    <input type="hidden" name="solicitudIDEliminar" id="solicitudIDEliminar">

                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Confirmar eliminación</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>¿Está seguro que desea eliminar su solicitud?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                        <button type="button" class="btn btn-success" data-dismiss="modal"
                                aria-label="Close">Cancelar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('tipoUsuario')
    Atleta
@endsection

@section('medidasCliente')
    @if($user->cliente != null && $user->cliente->estatura())
        <p>{{number_format($user->cliente->estatura()->estatura, 2)}} {{$user->cliente->estatura()->unidadMedidaAbreviatura}}</p>
    @endif
    @if($user->cliente != null &&  $user->cliente->peso())
        <p>{{number_format($user->cliente->peso()->peso, 2)}} {{$user->cliente->peso()->unidadMedidaAbreviatura}}</p>
    @endif
@endsection

@section('card1')
    <!--include('cliente.estadisticasCliente')-->
@endsection


@section('card2')
    @if(!$visitante)
        @include('entrenamientosAgendados')
        @if(isset($reviewFor))
            @include('modalDarReviewEntrenamiento')
        @endif
        @include('proximasSesiones')
    @endif
@endsection

@push('cards')
    @include('cliente/clientPlan')
@endpush

@push('scripts')
    <!--Pop-up Review Session-->
    <script type="text/javascript">
        $(document).ready(function(){
            if({{!session('msg')}} && !sessionStorage.getItem('training-review-showed') && {{isset($reviewFor)}}) {
                sessionStorage.setItem('training-review-showed', 'true');//at the beginning, it won't be present in the session, and if we get it, it will be false
                setTimeout(function() {$('#reviewEntrenamiento').modal('show');},
                    3000);
            }
        });
    </script>
    <!--Validar completar perfil-->
    <script>
        $(document).ready(function () {
            $('.icon').click(function () {
                $('.icon').css("border-color", "");
            });
        });

        function validar() {
            if (typeof $("input[name='genero']:checked").val() === "undefined") {
                $('.radio-label').css("cssText", "color: red!important;")
            } else {
                $('.radio-label').css("color", "red")
            }
            if (typeof $("input[name='tipoCuerpo']:checked").val() === "undefined") {
                $('.icon').css("border-color", "red");
            }
        }
    </script>
@endpush
