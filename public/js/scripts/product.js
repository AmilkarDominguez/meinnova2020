var table;
var id = 0;
var title_modal_data = "Registrar Nuevo Producto";
$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    ListDatatable();
    SelectTypeProduct();
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
            url: 'product'

        },
        columns: [
            {
                data: 'Imagen',
                orderable: false,
                searchable: false
            },
            { data: 'name' },
            {
                data: 'state',
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
            { data: 'description' },
            { data: 'catalog_product_id' },
            { data: 'QR', orderable: false, searchable: false },
            { data: 'Editar', orderable: false, searchable: false },
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
                    columns: [0, 1]
                }
            },
            {
                text: '<i class="icon-download"></i><i class="icon-file-pdf"></i> ',
                className: 'rounded btn-dark m-2',
                titleAttr: 'PDF',
                extend: 'pdf',
                exportOptions: {
                    columns: [0, 1]
                }
            },
            {
                text: '<i class="icon-download"></i><i class="icon-print"></i> ',
                className: 'rounded btn-dark m-2',
                titleAttr: 'Imprimir',
                extend: 'print',
                exportOptions: {
                    columns: [0, 1]
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
        url: "product",
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
        url: "product/{product}/edit",
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
    //console.log(obj)
    obj = JSON.parse(obj);
    id = obj.id;
    $("#name").val(obj.name);
    $("#description").val(obj.description);
    $('#image').attr('src', obj.photo);
    $('#label_image').html(obj.photo);
    $("#catalog_product_id").val(obj.catalog_product_id);
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
    if (true) {
        // if (data_old != data_new) {
        $.ajax({
            url: "product/{product}",
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
    id = id_;
    $('#modal_eliminar').modal('show');
}
$("#btn_delete").click(function () {
    $.ajax({
        url: "product/{product}",
        method: 'delete',
        data: {
            id: id
        },
        success: function (result) {
            if (result.success) {
                toastr.success(result.msg, { "progressBar": true, "closeButton": true });
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
    data += "&extension_image=" + extension_image;
    data += "&image=" + reader.result;
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
    $('#label_image').html("");
    $('#image').attr('src', '');
    $("#form-data")[0].reset();
    id = 0;
};

function SelectTypeProduct() {
    $.ajax({
        url: "listcatalog",
        method: 'get',
        data: {
            by: "type_catalog_id",
            type_catalog_id: 1
        },
        success: function (result) {
            var code = '<div class="form-group">';
            code += '<label for="tipo-product"><b>Tipo de Producto:</b></label>';
            code += '<select class="form-control" name="catalog_product_id" id="catalog_product_id" required>';
            code += '<option disabled value="" selected>(Seleccionar)</option>';
            $.each(result, function (key, value) {
                code += '<option value="' + value.id + '">' + value.name + '</option>';
            });
            code += '</select>';
            code += '<div class="invalid-feedback">';
            code += 'Dato necesario.';
            code += '</div>';
            code += '</div>';
            $("#select_type_product").html(code);
        },
        error: function (result) {
            toastr.error(result.msg + ' CONTACTE A SU PROVEEDOR POR FAVOR.');
            console.log(result);
        },

    });
}

//QR CODE
function Gen_QR(text) {
    console.log();
    $('#qrcode').html("");
    var qrcode = new QRCode(document.getElementById("qrcode"), {
        colorDark: "#000000",
        colorLight: "#ffffff",
        width: 512,
        height: 512,
        text: text,
        //logo: "images/logo.jpg",
        logoBackgroundColor: '#ffffff',
        logoBackgroundTransparent: false
    });
    $('#modal_qr').modal('show');
}

//Metodos para imagen
var reader = new FileReader();
var extension_image = "";
$("#photo").change(function (e) {
    ImgPreview(this);
    $fileName = e.target.files[0].name;
    extension_image = $fileName.replace(/^.*\./, '');
    $('#label_image').html($fileName);
    //console.log(extension_image);
});

function ImgPreview(input) {
    if (input.files && input.files[0]) {
        reader.onload = function (e) {
            //console.log(e);
            $('#image').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}