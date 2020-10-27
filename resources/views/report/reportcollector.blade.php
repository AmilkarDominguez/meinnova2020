@extends('layouts.app')
@section('content')

<input id="user_id" name="user_id" value="{{ auth()->user()->id }}" type="hidden">
<div class="row">
    <div class="col-md-12">
        <div class="card border-primary shadow">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12 d-flex justify-content-center">
                        <h2 class="card-title text-primary">REPORTE POR COBRADOR</h2>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <label class="text-primary" for=" "><b>Cobrador:</b></label>
                <div class="md-form mb-3" id="select_collector"></div>
            </div>
            <div class="col-md-4">
                <label class="text-primary" for="expiration-date"><b>Fecha Mínima:</b></label>
                <div class="input-group date" id="datetimepicker1" data-target-input="nearest">
                    <input type="text" id="minimum_date" name="minimum_date" class="form-control datetimepicker-input border-primary" data-target="#datetimepicker2" required/>
                    <div class="input-group-append" data-target="#datetimepicker1" data-toggle="datetimepicker">
                        <div class="input-group-text bg-primary text-white"><i class="icon-minus"></i><i class="icon-calendar"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <label class="text-primary" for="expiration-date"><b>Fecha Máxima:</b></label>
                <div class="input-group date" id="datetimepicker2" data-target-input="nearest">
                    <input type="text" id="maximum_date" name="maximum_date" class="form-control datetimepicker-input border-primary" data-target="#datetimepicker2" required/>
                    <div class="input-group-append" data-target="#datetimepicker2" data-toggle="datetimepicker">
                        <div class="input-group-text bg-primary text-white"><i class="icon-plus"></i><i class="icon-calendar"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-4 offset-md-8 d-flex justify-content-end">
                <button class="btn btn-outline-success btn-block" id="btn-agregar"onclick="Generate();">
                    <i class="icon-play-circled"></i>Generar
                </button>
            </div>
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-body">
                <hr>
                <h4 class="card-title text-primary"><i class="icon-box"></i>Cobros</h4>
                <div class="table-responsive">
                    <table id="table" class="table table-striped">
                        <thead>
                            <tr>
                                <td>Cod. Venta</td>
                                <td>Fecha</td>
                                <td>Recibo</td>
                                <td>Cliente</td>
                                <td>Cantidad Cobrada</td>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
    


@endsection
@section('scripts')
<script src="{{ URL::asset('js/scripts/reportcollector.js') }}"></script>
@endsection