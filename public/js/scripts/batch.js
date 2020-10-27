var table;
var id = 0;
var stock = 0;
var title_modal_data = "Registrar Nuevo Lote";
$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    ListDatatable();
    SelectProduct();
    SelectLine();
    SelectIndustry();
    SelectPaymentStatus();
    SelectProvider();
    SelectStorage();
    SelectPaymentType();
    dateEntry();
    dateExpiration();
    catch_parameters();
});
// datatable catalogos
function ListDatatable() {
    table = $('#table').DataTable({
        dom: 'lfBrtip',
        processing: true,
        serverSide: true,
        "paging": true,
        language: {
            "url": "/js/assets/Spanish.json"
        },
        ajax: {
            url: 'batch'

        },
        columns: [{
                data: 'id'
            },
            {
                data: 'code'
            },
            {
                data: 'sanitary_registration'
            },
            {
                data: 'product_name'
            },
            {
                data: 'wholesaler_price'
            },
            {
                data: 'stock'
            },
            { data: 'state',
            "render": function (data, type, row) {
                    if (row.state === 'ACTIVO') {
                        return '<center><p class="bg-success text-white"><b>ACTIVO</b></p></center>';
                    }
                    else if (row.state === 'INACTIVO') {          
                        return '<center><p class="bg-warning text-white"><b>INACTIVO</b></p></center>';
                    }
                    else if (row.state === 'ELIMINADO') {          
                        return '<center><p class="bg-danger text-white"><b>ELIMINADO</b></p></center>';
                    }
                }
            },
            {
                data: 'Detalle',
                orderable: false,
                searchable: false
            },
            {
                data: 'Editar',
                orderable: false,
                searchable: false
            },
            {
                data: 'Eliminar',
                orderable: false,
                searchable: false
            },
        ],
        buttons: [{
                text: '<i class="icon-eye"></i> ',
                className: 'rounded btn-dark m-2',
                titleAttr: 'Columnas',
                extend: 'colvis'
            },
            {
                text: '<i class="icon-download"></i><i class="icon-file-excel"></i>',
                className: 'rounded btn-dark m-2',
                titleAttr: 'Excel',
                extend: 'excel',
                exportOptions: {
                    columns: [0, 1, 2,3,4,5,6]
                }
            },
            {
                text: '<i class="icon-download"></i><i class="icon-file-pdf"></i> ',
                className: 'rounded btn-dark m-2',
                titleAttr: 'PDF',
                extend: 'pdf',
                exportOptions: {
                    columns: [0, 1, 2,3,4,5,6]
                }
            },
            {
                text: '<i class="icon-download"></i><i class="icon-print"></i> ',
                className: 'rounded btn-dark m-2',
                titleAttr: 'Imprimir',
                footer: true,
                extend: 'print',
                exportOptions: {
                    columns: [0, 1, 2,3,4,5,6]
                }
            },
            //btn Refresh
            {
                text: '<i class="icon-arrows-cw"></i>',
                className: 'rounded btn-info m-2',
                action: function () {
                    table.ajax.reload();
                }
            }
        ],

        //Metodo para Sumar todos los stock
        "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
 
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
 
            // Total over all pages
            total = api
                .column( 5 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Total over this page
            pageTotal = api
                .column( 5, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 5 ).footer() ).html(
                pageTotal +' ( '+ total +' total)'
            );
        }
    });
};
// guarda los datos nuevos
function Save() {
    var data_save = catch_parameters();
    data_save += "&stock=" + $("#initial_stock").val();
    $.ajax({
        url: "batch",
        method: 'post',
        data: data_save,
        success: function (result) {
            if (result.success) {
                toastr.success(result.msg);

            } else {
                toastr.warning(result.msg);
            }
        },
        error: function (result) {
            console.log(result.responseJSON.message);
            toastr.error("CONTACTE A SU PROVEEDOR POR FAVOR.");
        },
    });
    table.ajax.reload();
}
// detalle de lote
function Detail(id) {
    //console.log(id);
    $.ajax({
        url: "batch/{batch}",
        method: 'get',
        data: {
            id: id
        },
        success: function (result) {
            console.log("resultado");
            //console.log(result);
            //console.log(result[0]);
            show_detail(result[0]);
        },
        error: function (result) {
            toastr.error(result + 'CONTACTE A SU PROVEEDOR POR FAVOR.');
            //console.log(result);
        },

    });
};
//muestra el detalle
function show_detail(obj) {
    //console.log(obj);
    var string = "";
    //console.log(obj);
    //DATOS DE PRODUCTO
    string += "<p><h5><b>USUARIO</b></h5></p>";
    string += "<p><b>Registrado por:</b>&nbsp;" + obj.user.name + "</p>";
    string += "<hr>";
    string += "<p><h5><b>DATOS DE PRODUCTO</b></h5></p>";
    string += "<p><b>Código de lote:</b>&nbsp;" + obj.code + "</p>";
    string += "<p><b>Producto:</b>&nbsp;" + obj.product.name + "</p>";
    string += "<p><b>Stock:</b>&nbsp;" + obj.stock + "</p>";
    string += "<p><b>Línea:</b>&nbsp;" + obj.line.name + "</p>";
    string += "<p><b>Registro sanitario:</b>&nbsp;" + obj.sanitary_registration + "</p>";
    string += "<p><b>Fecha de expiración:</b>&nbsp;" + obj.expiration_date + "</p>";
    string += "<p><b>Industria:</b>&nbsp;" + obj.industry.name + "</p>";
    string += "<p><b>Proveedor:</b>&nbsp;" + obj.provider.name + "</p>";
    string += "<p><b>Estado:</b>&nbsp;" + obj.state + "</p>";
    if (obj.description!=null) {
        string += "<p><b>Descripción:</b>&nbsp;" + obj.description + "</p>";
    }
    else {
        string += "<p><b>Descripción:</p>";
    }
    string += "<hr>";
    //DATOS DE COMPRA
    string += "<p><h5><b>DATOS DE COMPRA</b></h5></p>";
    string += "<p><b>Estado de pago:</b>&nbsp;" + obj.payment_status.name + "</p>";
    string += "<p><b>Tipo de pago:</b>&nbsp;" + obj.payment_type.name + "</p>";
    string += "<p><b>Precio de compra del lote:</b>&nbsp;" + obj.batch_price + "</p>";
    string += "<p><b>Stock iniciaaal:</b>&nbsp;" + obj.initial_stock + "</p>";
    string += "<p><b>Fecha de entrada:</b>&nbsp;" + obj.entry_date + "</p>";
    string += "<hr>";
    //DATOS DE INVENTARIO
    string += "<p><h5><b>DATOS DE INVENTARIO</b></h5></p>";
    string += "<p><b>Almacén:</b>&nbsp;" + obj.storage.name + "</p>";
    string += "<p><b>Precio de veta:</b>&nbsp;" + obj.wholesaler_price + "</p>";
    $("#title-modal-detalle").html("Detalle de Lote");
    $('#content_detalle').html(string);
    $('#modal_detalle').modal('show');
};


// captura los datos para editar
function Edit(id) {
    $.ajax({
        url: "batch/{batch}/edit",
        method: 'get',
        data: {
            id: id
        },
        success: function (result) {
            show_data(result);
        },
        error: function (result) {
            //console.log(result);
            toastr.error(result + ' CONTACTE A SU PROVEEDOR POR FAVOR.');
        },

    });
};

/// muestra la vista con los datos capturados
var data_old;

function show_data(obj) {
    ClearInputs();
    obj = JSON.parse(obj);
    //console.log(obj);
    id = obj.id;
    stock = obj.stock;
    $("#user_id").val(obj.user_id);
    $("#product_id").val(obj.product_id);
    $("#line_id").val(obj.line_id);
    $("#provider_id").val(obj.provider_id);
    $("#industry_id").val(obj.industry_id);
    $("#code").val(obj.code);
    $("#expiration_date").val(obj.expiration_date);
    if (obj.state == "ACTIVO") {
        $('#estado_activo').prop('checked', true);
    }
    if (obj.state == "INACTIVO") {
        $('#estado_inactivo').prop('checked', true);
    }
    $("#description").val(obj.description);
    $("#sanitary_registration").val(obj.sanitary_registration);
    $("#payment_status_id").val(obj.payment_status_id);
    $("#payment_type_id").val(obj.payment_type_id);
    $("#batch_price").val(obj.batch_price);
    $("#initial_stock").val(obj.initial_stock);
    $("#entry_date").val(obj.entry_date);
    $("#storage_id").val(obj.storage_id);
    $("#wholesaler_price").val(obj.wholesaler_price);
    $("#title-modal").html("Editar Registro");
    data_old = catch_parameters();;
    data_old += "&stock=" + stock;
    $('#modal_datos').modal('show');
};

// actualiza los datos
function Update() {
    var data_new = catch_parameters();;
    data_new += "&stock=" + stock;
    if (data_old != data_new) {
        $.ajax({
            url: "batch/{batch}",
            method: 'put',
            data: data_new,
            success: function (result) {
                if (result.success) {
                    toastr.success(result.msg);
    
                } else {
                    toastr.warning(result.msg);
                }
            },
            error: function (result) {
                console.log(result.responseJSON.message);
                toastr.error("CONTACTE A SU PROVEEDOR POR FAVOR.");
            },       
        });
        table.ajax.reload();
    }
}

//funcion para eliminar valor seleccionado
function Delete(id_) {
    id = id_;
    $('#modal_eliminar').modal('show');
}
$("#btn_delete").click(function () {
    $.ajax({
        url: "batch/{batch}",
        method: 'delete',
        data: {
            id: id
        },
        success: function (result) {
            if (result.success) {
                toastr.success(result.msg);
            } else {
                toastr.warning(result.msg);
            }
        },
        error: function (result) {
            toastr.error(result.msg + ' CONTACTE A SU PROVEEDOR POR FAVOR.');
            console.log(result);
        },

    });
    table.ajax.reload();
    $('#modal_eliminar').modal('hide');
});




//////////////////////////////////////////////

// METODOS NECESARIOS
// funcion para volver mayusculas
function Mayus(e) {
    e.value = e.value.toUpperCase();
}

// obtiene los datos del formulario
function catch_parameters() {
    var data = $(".form-data").serialize();
    data += "&id=" + id;
    return data;

}



// muestra el modal
$("#btn-agregar").click(function () {
    ClearInputs();
    $("#title-modal").html(title_modal_data);
    $("#modal_datos").modal("show");
});



// metodo de bootstrap para validar campos

(function () {
    'use strict';
    window.addEventListener('load', function () {
        var forms = document.getElementsByClassName('form-data');
        var validation = Array.prototype.filter.call(forms, function (form) {
            form.addEventListener('submit', function (event) {
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                } else {
                    event.preventDefault();
                    event.stopPropagation();
                    if (id == 0) {
                        Save();
                    } else {
                        Update();
                    }
                    $('#modal_datos').modal('hide');
                }
                form.classList.add('was-validated');
            }, false);
        });
    }, false);
})();

/// limpi campos despues de utilizar el modal
function ClearInputs() {
    var forms = document.getElementsByClassName('form-data');
    Array.prototype.filter.call(forms, function (form) {
        form.classList.remove('was-validated');
    });
    //__Clean values of inputs
    $("#form-data")[0].reset();
    id = 0;
};

//fecha de entrada
function dateEntry() {
    $('#datetimepicker1').datetimepicker({
        format: 'YYYY-MM-DD'
    });
}

//fecha de expiracion
function dateExpiration() {
    $('#datetimepicker2').datetimepicker({
        format: 'YYYY-MM-DD'
    });
}

// seleccion de productos
function SelectProduct() {
    $.ajax({
        url: "listproduct",
        method: 'get',
        data: {
            by: "all",
        },
        success: function (result) {
            var code = '<div class="form-group">';
            code += '<label for="product"><b>Producto:</b></label>';
            code += '<select class="form-control" name="product_id" id="product_id" required>';
            code += '<option disabled value="" selected>(Seleccionar)</option>';
            $.each(result, function (key, value) {
                code += '<option value="' + value.id + '">' + value.name + '</option>';
            });
            code += '</select>';
            code += '<div class="invalid-feedback">';
            code += 'Dato necesario.';
            code += '</div>';
            code += '</div>';
            $("#select_product").html(code);
        },
        error: function (result) {
            toastr.error(result.msg + ' CONTACTE A SU PROVEEDOR POR FAVOR.');
            console.log(result);
        },

    });
}

// seleccion de proveedor
function SelectProvider() {
    $.ajax({
        url: "listprovider",
        method: 'get',
        data: {
            by: "all",
        },
        success: function (result) {
            var code = '<div class="form-group">';
            code += '<label for="provider"><b>Proveedor:</b></label>';
            code += '<select class="form-control" name="provider_id" id="provider_id" required>';
            code += '<option disabled value="" selected>(Seleccionar)</option>';
            $.each(result, function (key, value) {
                code += '<option value="' + value.id + '">' + value.name + '</option>';
            });
            code += '</select>';
            code += '<div class="invalid-feedback">';
            code += 'Dato necesario.';
            code += '</div>';
            code += '</div>';
            $("#select_provider").html(code);
        },
        error: function (result) {
            toastr.error(result.msg + ' CONTACTE A SU PROVEEDOR POR FAVOR.');
            console.log(result);
        },

    });
}


//seleccion de linea de producto
function SelectLine() {
    $.ajax({
        url: "listcatalog",
        method: 'get',
        data: {
            by: "type_catalog_id",
            type_catalog_id: 4
        },
        success: function (result) {
            var code = '<div class="form-group">';
            code += '<label for="line-product"><b>Linea de Producto:</b></label>';
            code += '<select class="form-control" name="line_id" id="line_id" required>';
            code += '<option disabled value="" selected>(Seleccionar)</option>';
            $.each(result, function (key, value) {
                code += '<option value="' + value.id + '">' + value.name + '</option>';
            });
            code += '</select>';
            code += '<div class="invalid-feedback">';
            code += 'Dato necesario.';
            code += '</div>';
            code += '</div>';
            $("#select_line").html(code);
        },
        error: function (result) {
            toastr.error(result.msg + ' CONTACTE A SU PROVEEDOR POR FAVOR.');
            console.log(result);
        },

    });
}
// seleccionar industria
function SelectIndustry() {
    $.ajax({
        url: "listcatalog",
        method: 'get',
        data: {
            by: "type_catalog_id",
            type_catalog_id: 6
        },
        success: function (result) {
            var code = '<div class="form-group">';
            code += '<label for="industry-product"><b>Industria de Producto:</b></label>';
            code += '<select class="form-control" name="industry_id" id="industry_id">';
            code += '<option disabled value="" selected>(Seleccionar)</option>';
            $.each(result, function (key, value) {
                code += '<option value="' + value.id + '">' + value.name + '</option>';
            });
            code += '</select>';
            code += '<div class="invalid-feedback">';
            code += 'Dato necesario.';
            code += '</div>';
            code += '</div>';
            $("#select_industry").html(code);
        },
        error: function (result) {
            toastr.error(result.msg + ' CONTACTE A SU PROVEEDOR POR FAVOR.');
            console.log(result);
        },

    });
}

//seleccionar almacen
function SelectStorage() {
    $.ajax({
        url: "listcatalog",
        method: 'get',
        data: {
            by: "type_catalog_id",
            type_catalog_id: 2
        },
        success: function (result) {
            var code = '<div class="form-group">';
            code += '<label for="storage"><b>Almacen:</b></label>';
            code += '<select class="form-control" name="storage_id" id="storage_id" required>';
            code += '<option disabled value="" selected>(Seleccionar)</option>';
            $.each(result, function (key, value) {
                code += '<option value="' + value.id + '">' + value.name + '</option>';
            });
            code += '</select>';
            code += '<div class="invalid-feedback">';
            code += 'Dato necesario.';
            code += '</div>';
            code += '</div>';
            $("#select_storage").html(code);
        },
        error: function (result) {
            toastr.error(result.msg + ' CONTACTE A SU PROVEEDOR POR FAVOR.');
            console.log(result);
        },

    });
}

//seleccionar  estado de pago
function SelectPaymentStatus() {
    $.ajax({
        url: "listcatalog",
        method: 'get',
        data: {
            by: "type_catalog_id",
            type_catalog_id: 7
        },
        success: function (result) {
            var code = '<div class="form-group">';
            code += '<label for="payment-status"><b>Estado de Pago:</b></label>';
            code += '<select class="form-control" name="payment_status_id" id="payment_status_id" required>';
            code += '<option disabled value="" selected>(Seleccionar)</option>';
            $.each(result, function (key, value) {
                code += '<option value="' + value.id + '">' + value.name + '</option>';
            });
            code += '</select>';
            code += '<div class="invalid-feedback">';
            code += 'Dato necesario.';
            code += '</div>';
            code += '</div>';
            $("#select_payment_status").html(code);
        },
        error: function (result) {
            toastr.error(result.msg + ' CONTACTE A SU PROVEEDOR POR FAVOR.');
            console.log(result);
        },

    });
}

//seleccionar tipo de pago
function SelectPaymentType() {
    $.ajax({
        url: "listcatalog",
        method: 'get',
        data: {
            by: "type_catalog_id",
            type_catalog_id: 8
        },
        success: function (result) {
            var code = '<div class="form-group">';
            code += '<label for="payment-type"><b>Tipo de Pago:</b></label>';
            code += '<select class="form-control" name="payment_type_id" id="payment_type_id" required>';
            code += '<option disabled value="" selected>(Seleccionar)</option>';
            $.each(result, function (key, value) {
                code += '<option value="' + value.id + '">' + value.name + '</option>';
            });
            code += '</select>';
            code += '<div class="invalid-feedback">';
            code += 'Dato necesario.';
            code += '</div>';
            code += '</div>';
            $("#select_payment_type").html(code);
        },
        error: function (result) {
            toastr.error(result.msg + ' CONTACTE A SU PROVEEDOR POR FAVOR.');
            console.log(result);
        },

    });
}


function printDetails() {
    var divToPrint = document.getElementById("content_detalle");
    newWin = window.open("");
    newWin.document.write(divToPrint.outerHTML);
    newWin.print();
    newWin.close();
}
