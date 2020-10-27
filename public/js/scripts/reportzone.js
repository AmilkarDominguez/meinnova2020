$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    dateEntry();
    SelectZone();
});

function Generate() {
    //Limpiar DataTable
    $("#table").dataTable().fnDestroy();
    if ($("#catalog_zone_id").val() == null) {
        toastr.warning("Debe Seleccionar una Zona.");
    } else if ($("#minimum_date").val() == 0) {
        toastr.warning("Debe Seleccionar una Fecha minima.");
    } else if ($("#maximum_date").val() == 0) {
        toastr.warning("Debe seleccionar una Fecha Maxima.");
    } else {
        ListDataTable();
    }

}

function ListDataTable() {
    var d = new Date();
    table = $('#table').DataTable({
        dom: 'lfBrtip',
        processing: true,
        serverSide: true,
        "paging": true,
        language: {
            "url": "/js/assets/Spanish.json"
        },
        ajax: {
            url: '/getreporzones',

            data: function (obj) {
                //console.log(obj);
                obj.catalog_zone_id = $("#catalog_zone_id").val();
                obj.minimum_date = $("#minimum_date").val();
                obj.maximum_date = $("#maximum_date").val();
            }
        },
        /*
            <td>Cod. Venta</td>
            <td>Cliente</td>
            <td>Fecha de Venta</td>
            <td>Total a Pagar</td>
            <td>Total a con descuento</td>
            <td>Exp. Descuento</td>
            <td>Cantidad Cobrada</td>
            <td>Saldo</td>
        */
        columns: [{
                data: 'id'
            },
            {
                data: 'client_name'
            },
            {
                data: 'zone'
            },
            {
                data: 'date'
            },
            {
                data: 'total'
            },
            {
                data: 'total_discount'
            },
            {
                data: 'expiration_discount'
            },
            {
                data: 'receive'
            },
            {
                data: 'residue'
            },
            {
                data: 'residue_discount'
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
                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]
                }
            },
            {
                text: '<i class="icon-download"></i><i class="icon-file-pdf"></i> ',
                className: 'rounded btn-dark m-2',
                titleAttr: 'PDF',
                extend: 'pdf',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]
                }
            },
            {
                text: '<i class="icon-download"></i><i class="icon-print"></i> ',
                className: 'rounded btn-dark m-2',
                titleAttr: 'Imprimir',
                extend: 'print',
                messageTop: 'VENTAS POR COBRAR.<br>Fechas: ' + $("#minimum_date").val() + ' - ' + $("#maximum_date").val(),
                footer: true,
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]
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
        "footerCallback": function (row, data, start, end, display) {
            var api = this.api(),
                data;

            // Remove the formatting to get integer data for summation
            var intVal = function (i) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '') * 1 :
                    typeof i === 'number' ?
                    i : 0;
            };

            // Total over all pages
            total = api
                .column(7)
                .data()
                .reduce(function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0);

            // Total over this page
            pageTotal = api
                .column(7, {
                    page: 'current'
                })
                .data()
                .reduce(function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0);

            // Update footer
            $(api.column(7).footer()).html(
                'Total: ' + pageTotal.toFixed(2)
            );
            //Another
            // Total over all pages
            total = api
                .column(8)
                .data()
                .reduce(function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0);

            // Total over this page
            pageTotal = api
                .column(8, {
                    page: 'current'
                })
                .data()
                .reduce(function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0);

            // Update footer
            $(api.column(8).footer()).html(
                'Total: ' + pageTotal.toFixed(2)
            );

        }
    });
}

//fecha de entrada
function dateEntry() {
    $('#datetimepicker1').datetimepicker({
        format: 'YYYY-MM-DD'
    });
    $('#datetimepicker2').datetimepicker({
        format: 'YYYY-MM-DD'
    });
    $('#datetimepicker1').datetimepicker();
    $('#datetimepicker2').datetimepicker({
        useCurrent: false
    });
    $("#datetimepicker1").on("change.datetimepicker", function (e) {
        $('#datetimepicker2').datetimepicker('minDate', e.date);
    });
    $("#datetimepicker2").on("change.datetimepicker", function (e) {
        $('#datetimepicker1').datetimepicker('maxDate', e.date);
    });
}

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
            toastr.error(result.msg + ' CONTACTE A SU PROVEEDOR POR FAVOR.');
            //console.log(result);
        },

    });
}
