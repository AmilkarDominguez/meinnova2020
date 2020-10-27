@extends('layouts.app')
@section('content')

<input id="user_id" name="user_id" value="{{ auth()->user()->id }}" type="hidden">
<div class="row">
    <div class="col-md-12">
        <div class="card border-primary shadow">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12 d-flex justify-content-center">
                        <h2 class="card-title text-primary">REGISTRO DE COBRANZAS</h2>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-body">
                <h3 class="text-primary"><i></i>Cobrador Seleccionado:&nbsp;<b><span id="name_collector" class="text-success"></span></b></h3>
                <br>
                <h3 class="text-primary"><i></i>Venta Seleccionada:&nbsp;<b><span id="code_sale" class="text-success"></span></b></h3>
                <br>
                <div class="row">
                        <div class="col-md-2">
                            <h3 class="text-primary">Monto de Pago:&nbsp;</h3>
                        </div>
                        <div class="col-md-4">
                            <input type="text" min="0" value="0" step="any" id="payment" class="form-control" placeholder="Pago" 
                            required>
                            <div class="invalid-feedback">
                                    Dato necesario.
                            </div>
                        </div>       
                </div>
                <br>
                <div class="row">
                        <div class="col-md-2">
                                <h3 class="text-primary">Nro de Boleta:&nbsp;</h3>
                        </div>
                        <div class="col-md-2">
                            <input type="text" id="receipt_number" class="form-control" placeholder="Nro de Boleta" 
                            required>
                            <div class="invalid-feedback">
                                Dato necesario.
                            </div>
                        </div>
                </div>

                <hr>
                <h4 class="card-title text-primary"><i class="icon-id-badge"></i>Cobradores</h4>
                <div class="md-form mb-3" id="select_collector"></div>
                <hr>

                <div class="col-sm-12 d-flex justify-content-end"> 
                    @can('payment.store')
                    <button class="btn btn-outline-success" onclick="Save();">
                        <i class="icon-floppy"></i>&nbsp;Asignar
                    </button>
                    @endcan
                </div>
                <h4 class="card-title text-primary"><i class="icon-box"></i>Ventas</h4>
                <div class="table-responsive">
                    <table id="table" class="table table-striped">
                        <thead>
                            <tr>
                                <td>Cod. Venta</td>
                                <td>Cliente</td>
                                <td>Total</td>
                                <td>Total con descuento</td>
                                <td>Descuento</td>
                                <td>Monto Cobrado</td>
                                <td>Fecha</td>
                                <td>Agregar</td>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>    

@endsection
@section('scripts')
<script src="{{ URL::asset('js/scripts/payment.js') }}"></script>
@endsection