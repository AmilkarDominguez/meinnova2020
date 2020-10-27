@extends('layouts.app')
@section('content')

<input id="user_id" name="user_id" value="{{ auth()->user()->id }}" type="hidden">
<div class="row">
    <div class="col-md-12">
        <div class="card border-primary shadow">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12 d-flex justify-content-center">
                        <h2 class="card-title text-primary">REGISTRAR VENTA</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-6">
        <div class="card shadow">
            <div class="card-body">
                <h4 class="card-title text-primary"><i class="icon-box"></i>Productos disponibles</h4>
                <div class="table-responsive">
                    <table id="table" class="table table-striped">
                        <thead>
                            <tr>
                                <td>Codigo</td>
                                <td>Producto</td>
                                <td>Precio</td>
                                <td>Stock</td>
                                <td>Detalle</td>
                                <td>Agregar</td>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card shadow">
            <div class="card-body">
                <h4 class="card-title text-primary"><i class="icon-id-badge"></i>Vendedor</h4>
                <div class="md-form mb-3" id="select_seller"></div>
                <hr>
                <h3 class="card-title text-primary"><i class="icon-user"></i>Cliente:&nbsp;<b><span id="name_client" class="text-success"></span></b></h3>
                <div class="table-responsive">
                    <table id="table_clients" class="table table-striped">
                        <thead>
                            <tr>
                                <td>Nombre</td>
                                <td>NIT</td>
                                <td>Seleccionar</td>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>   
</div>
<br>
<div class="row">

    <div class="col-md-12">
        <div class="card border-danger shadow">
            <div class="card-body">
                <h3 class="card-title text-danger"><i class="icon-basket"></i>Carrito</h3>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table id="table-basket" class="table table-striped">
                                <thead>
                                    <tr>
                                        <td>Producto</td>
                                        <td>Precio</td>
                                        <td>Subtotal</td>
                                        <td>Catidad</td>
                                        <td>Quitar</td>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <h2 class="card-title text-danger">TOTAL SIN DESCUENTO <b id="total_s">0</b> Bs.</h2>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-sm-6">
                        <label class="text-warning"><b>Descuento:</b></label>
                        <select class="form-control border-warning text-warning" onchange="ShowTotal();" name="select_discount" id="select_discount">
                            <option selected value="0">0 %</option> 
                            <option value="0.05">5 %</option> 
                            <option value="0.1">10 %</option> 
                            <option value="0.15">15 %</option> 
                            <option value="0.2">20 %</option>
                            <option value="0.25">25 %</option>
                            <option value="0.3">30 %</option>
                            <option value="0.35">35 %</option>
                            <option value="0.4">40 %</option>
                            <option value="0.45">45 %</option>
                            <option value="0.5">50 %</option>
                            <option value="0.55">55 %</option>
                            <option value="0.6">60 %</option>
                            <option value="0.65">65 %</option>
                            <option value="0.7">70 %</option>
                            <option value="0.75">75 %</option>
                            <option value="0.8">80 %</option>
                            <option value="0.85">85 %</option>
                            <option value="0.9">90 %</option>
                        </select>
                    </div>
                    <div class="col-sm-6">
                        <label class="text-warning"><b>Fecha de vencimiento de descuento:</b></label>
                        <div class="input-group date" id="datetimepicker1" data-target-input="nearest">
                            <input type="text" id="expiration_discount" name="expiration_discount" class="form-control text-warning datetimepicker-input border-warning" data-target="#datetimepicker1" required/>
                            <div class="input-group-append" data-target="#datetimepicker1" data-toggle="datetimepicker">
                                <div class="input-group-text bg-warning border-warning text-white"><i class="icon-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-sm-6">
                        <h2 class="card-title text-warning">TOTAL CON DESCUENTO <b id="total_c">0</b> Bs.</h2>
                    </div>
                    <div class="col-sm-6 d-flex justify-content-end">
                        @can('shop.store')
                        <a id="btn_save_sale" class="btn btn-success text-white" onclick="SaveSale();">
                            <i class="icon-floppy"></i> Registrar Venta
                        </a>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--Modal detalle-->

<div class="modal fade bd-example-modal-lg" id="modal_detalle" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <center>
                    <h5 class="modal-title" id="title-modal-detalle"></h5>
                </center>

                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="content_detalle">
    
            </div>
            <div class="modal-footer">
                    <button class="btn btn-primary" onclick="printDetails();">Imprimir<i class="icon-print"></i></button>
                <button class="btn btn-danger" data-dismiss="modal">Cancelar<i class="icon-cancel"></i></button>
            </div>
            
        </div>
    </div>
</div>




<!-- modal_sale_susscess-->
<div class="modal fade bd-example-modal-lg" id="modal_sale_susscess" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title">Registro exitoso</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                ¡Venta registrada correctamente!
            </div>
            <div class="modal-footer">
                <button class="btn btn-success" onclick="location.reload();">Aceptar<i class="icon-ok"></i></button>
            </div>
        </div>
    </div>
</div>

@endsection
@section('scripts')
<script src="{{ URL::asset('js/scripts/shop.js') }}"></script>
@endsection