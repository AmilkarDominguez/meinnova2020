var table;
var id=0;
var title_modal_data = "Registrar Nuevo Proveedor";
$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    ListDatatable();
    SelectZone();
    catch_parameters();
});
// datatable catalogos
function ListDatatable()
{
    table = $('#table').DataTable({
        dom: 'lfBrtip',
        processing: true,
        serverSide: true,
        "paging": true,
        language: {
            "url": "/js/assets/Spanish.json"
        },
        ajax: {
            url: 'provider'
            
        },
        columns: [
            { data: 'name'},
            { data: 'email'},
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
            { data: 'description'},
            { data: 'contact'},
            { data: 'phone'},
            { data: 'address'},
            { data: 'catalog_zone_name'},
            { data: 'Editar',   orderable: false, searchable: false },
            { data: 'Eliminar', orderable: false, searchable: false },
        ],
        buttons: [
            {
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
                    columns: [0, 1, 2,3,4]
                }
            },
            {
                text: '<i class="icon-download"></i><i class="icon-file-pdf"></i> ',
                className: 'rounded btn-dark m-2',
                titleAttr: 'PDF',
                extend: 'pdf',
                exportOptions: {
                    ccolumns: [0, 1, 2,3,4]
                }
            },
            {
                text: '<i class="icon-download"></i><i class="icon-print"></i> ',
                className: 'rounded btn-dark m-2',
                titleAttr: 'Imprimir',
                extend: 'print',
                exportOptions: {
                    columns: [0, 1, 2,3,4]
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
    });
};

// guarda los datos nuevos
function Save() {
    $.ajax({
        url: "provider",
        method: 'post',
        data: catch_parameters(),
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



// captura los datos
function Edit(id) {
    $.ajax({
        url: "provider/{provider}/edit",
        method: 'get',
        data: {
            id: id
        },
        success: function (result) {
            show_data(result);
        },
        error: function (result) {
            toastr.error(result + ' CONTACTE A SU PROVEEDOR POR FAVOR.');

            console.log(result);
        },

    });
};

/// muestra la vista con los datos capturados
var data_old;
function show_data(obj) {
    ClearInputs();
    console.log(obj)
    obj = JSON.parse(obj);
    id= obj.id;
    $("#name").val(obj.name);
    $("#email").val(obj.email);
    $("#description").val(obj.description);
    $("#contact").val(obj.contact);
    $("#phone").val(obj.phone);
    $("#address").val(obj.address);
    $("#catalog_zone_id").val(obj.catalog_zone_id);
    if (obj.state == "ACTIVO") {
        $('#estado_activo').prop('checked', true);
    }
    if (obj.state == "INACTIVO") {
        $('#estado_inactivo').prop('checked', true);
    }
    $("#title-modal").html("Editar Registro");

    data_old = $(".form-data").serialize();

    $('#modal_datos').modal('show');
};

// actualiza los datos
function Update() {
    var data_new = $(".form-data").serialize();
    if (data_old != data_new) {
        $.ajax({
            url: "provider/{provider}",
            method: 'put',
            data: catch_parameters(),
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
    id= id_;
    $('#modal_eliminar').modal('show');
}
$("#btn_delete").click(function () {
    $.ajax({
        url: "provider/{provider}",
        method: 'delete',
        data: {
            id: id
        },
        success: function (result) {
            if (result.success) {
                toastr.success(result.msg,{"progressBar": true,"closeButton": true});
            } else {
                toastr.warning(result.msg);
            }
        },
        error: function (result) {
            toastr.error(result.msg +' CONTACTE A SU PROVEEDOR POR FAVOR.');
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
function catch_parameters()
{
    var data = $(".form-data").serialize();
    data += "&id="+id;
    //console.log(data);
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
    id=0;
};

function SelectZone() {
    $.ajax({
        url: "listcatalog",
        method: 'get',
        data: {
            by: "type_catalog_id",
            type_catalog_id: 3
        },
        success: function (result) {
            var code = '<div class="form-group">';
            code += '<label for="tipo-zone"><b>Zonas:</b></label>';
            code += '<select class="form-control" name="catalog_zone_id" id="catalog_zone_id" required>';
            code += '<option disabled value="" selected>(Seleccionar)</option>';
            $.each(result, function (key, value) {
                code += '<option value="' + value.id + '">' + value.name + '</option>';
            });
            code += '</select>';
            code += '<div class="invalid-feedback">';
            code += 'Dato necesario.';
            code += '</div>';
            code += '</div>';
            $("#select_zone").html(code);
        },
        error: function (result) {
            toastr.error(result.msg +' CONTACTE A SU PROVEEDOR POR FAVOR.');
            console.log(result);
        },

    });
}