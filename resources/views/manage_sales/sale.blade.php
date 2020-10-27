@extends('layouts.app')
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6">
                        <h2 class="card-title text-primary">Lista de Ventas</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="table" class="table table-striped ">
                        <thead>
                            <tr>
                                <td>Cod. Venta</td>
                                <td>Usuario</td>
                                <td>Cliente</td>
                                <td>Vendedor</td>
                                <td>Fecha</td>
                                <td>Total</td>
                                <td>Total con descuento</td>
                                <td>Descuento</td>
                                <td>Fecha exp. Descuento</td>
                                <td>Estado de pago</td>
                                <td>Estado</td>
                                <td>Nota de venta / Detalles</td>
                                <td>Eliminar</td>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="container p-2">
        <div class="card">
            <div class="card-body">
                <div class="col-md-12" id="nota_venta">
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12 p-4 text-right">
        <div class="container">
            <a class="btn btn-info" onclick="printNote();" id="btn-agregar">
                <i class="icon-print"></i> Imprimir
            </a>
        </div>  
    </div>
        </div>  
        <div class="col-md-12" hidden>
            <div class="container" id="nota">
                <div class="card border-primary p-2">
                    <div class="row">
                        <div class="col align-self-start">
                            <h3><b>IMPORTADORA MIRANDA</b></h3>
                            Av. Gran Chacho #542 - Palmarcito<br>
                            Tel: 66-31611 Fax: 66-31611
                        </div>
                    </div>
    
                    <center><h3><b>NOTA DE ENTREGA</b></h3></center>
    
                    <div class="row">
                        <div class="col-md-6">
                            <br>
                            <b>Cliente: </b>texto texto texto texto texto texto
                            <br>
                            <b>Dirección: </b>texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto texto
                            <br>
                            <b>Telefono: </b>texto textotexto texto texto texto
                        </div>
                        <div class="col-md-6">
                            <br>
                            <b>Nro: </b>texto texto texto texto
                            <br>
                            <b>Fecha: </b> Farmacia nombre texto texto texto texto
                            <br>
                            <b>Vendedor: </b> Farmacia nombre texto texto texto texto
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table">
                                <thead class="bg-secondary">
                                    <tr>
                                        <td><b>Nro</b></td>
                                        <td><b>Descripcón</b></td>
                                        <td><b>Cod. Lote</b></td>
                                        <td><b>Reg. Sanitario</b></td>
                                        <td><b>Vencimiento</b></td>
                                        <td><b>Cantidad</b></td>
                                        <td><b>Precio unitario</b></td>
                                        <td><b>Subtotal</b></td>
                                    </tr>   
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Aspirinias de 100 gr.</td>
                                        <td>1545412</td>
                                        <td>RS/264646</td>
                                        <td>24/01/2019</td>
                                        <td>121.00</td>
                                        <td>120.00</td>
                                        <td>120.00</td>
                                    </tr>                          
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <b></b>
                            Descuento: <b>0.5</b><br>
                            Vencimiento del descuento: <b>24/08/2019</b><br>
                            Total con descuento: <b>12500.00</b><br>
                            <hr>
                            Total: <b>12500.00</b><br>
                            Doce mil quinientos 00/100 Bs.<br>
                        </div>
                    </div>
                </div>
            </div>
    
        </div>
</div>
<!-- Modals-->
<!-- Modal Datos -->

<div class="modal fade bd-example-modal-lg" id="modal_datos" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <center>
                    <h5 class="modal-title" id="title-modal"></h5>
                </center>

                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-data" id="form-data" novalidate>
                <div class="modal-body">
                        <div class="modal-body">
                            <div class="md-form mb-3">
                                <label for="nombre"><b>Nombre:</b></label>
                                <input type="text" class="form-control" onkeyup="Mayus(this);" id="name" name="name" placeholder="Nombre"
                                    required>
                                <div class="invalid-feedback">
                                    Dato necesario.
                                </div>
                            </div>
                            <div class="md-form mb-3">
                                <label for="nombre"><b>Contacto:</b></label>
                                <input type="text" class="form-control" onkeyup="Mayus(this);" id="contact" name="contact" placeholder="Contacto"
                                    required>
                                <div class="invalid-feedback">
                                    Dato necesario.
                                </div>
                            </div>   
                            <div class="md-form mb-3">
                                <label for="nombre"><b>Nit:</b></label>
                                <input type="text" class="form-control" onkeyup="Mayus(this);" id="nit" name="nit" placeholder="Nit"
                                    required>
                                <div class="invalid-feedback">
                                    Dato necesario.
                                </div>
                            </div>
                            
                            <div class="md-form mb-3">
                                <label for="nombre"><b>Descripción:</b></label>
                                <textarea  type="text" class="form-control" onkeyup="Mayus(this);" rows="4" id="description" name="description" ></textarea>  
                            </div>

                            <div class="md-form mb-3">
                                <label for="nombre"><b>Teléfono:</b></label>
                                <input type="text" class="form-control" onkeyup="Mayus(this);" id="phone" name="phone" placeholder="Teléfono"
                                    required>
                                <div class="invalid-feedback">
                                    Dato necesario.
                                </div>   
                            </div> 
                            
                            <div class="md-form mb-3">
                                <label for="nombre"><b>Dirección:</b></label>
                                <input type="text" class="form-control" onkeyup="Mayus(this);" id="address" name="address" placeholder="Dirección">   
                            </div>
                            <div class="md-form mb-3" id="select_zone"></div>  
                            <div class="md-form mb-3">
                                    <label for="state"><b>Estado:</b></label>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="estado_activo" name="state" class="custom-control-input bg-danger"
                                        value="ACTIVO" checked>
                                    <label class="custom-control-label" for="estado_activo">Activo</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="estado_inactivo" name="state" class="custom-control-input"
                                        value="INACTIVO">
                                    <label class="custom-control-label" for="estado_inactivo">Inactivo</label>
                                </div>
                            </div>

                        </div>
                </div>
                <div class="modal-footer bg-dark">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar<i class="icon-cancel"></i></button>
                    <button class="btn btn-success" type="submit">Aceptar<i class="icon-ok"></i></button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Eliminar -->
<div class="modal fade bd-example-modal-lg" id="modal_eliminar" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title">Eliminar</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <h2>¿Está seguro que desea eliminar el registro?</h2>
            </div>
            <div class="modal-footer bg-dark">
                <button class="btn btn-danger" data-dismiss="modal">Cancelar<i class="icon-cancel"></i></button>
                <button class="btn btn-success" id="btn_delete">Aceptar<i class="icon-ok"></i></button>
            </div>
        </div>
    </div>
</div>

@endsection
@section('scripts')
<script src="{{ URL::asset('js/scripts/sale.js') }}"></script>
@endsection