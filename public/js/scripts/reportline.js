$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
   
    SelectLine();
});






function Generate() {
    //Limpiar DataTable
    $("#table").dataTable().fnDestroy();

    if($("#line_id").val()== null){
        toastr.warning("Debe Seleccionar una Linea de Producto.");
    }
    else{
        ListDataTable();
    }
}

function ListDataTable(){
    var d = new Date();
    var currenDate = d.getFullYear() + "-" + (d.getMonth()+1) + "-" + d.getDate();
    table = $('#table').DataTable({
        dom: 'lfBrtip',
        processing: true,
        serverSide: true,
        "paging": true,
        language: {
            "url": "/js/assets/Spanish.json"
        },
        ajax: {
            url: '/getreportlines',
            data: function (obj) {
                obj.line_id = $("#line_id").val();
            }
        },
        columns: [{
                data: 'id'
            },
            {
                data: 'code'
            },
            {
                data: 'product_name'
            },
            {
                data: 'initial_stock'
            },
            {
                data: 'stock'
            },
            {
                data: 'wholesaler_price'
            },
            {
                data: 'total_stock_price'
            },
            {
                data: 'batch_price'
            },
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
                    columns: [0, 1, 2,3,4,5,6,7]
                    
                }
            },
            {
                text: '<i class="icon-download"></i><i class="icon-file-pdf"></i> ',
                className: 'rounded btn-dark m-2',
                titleAttr: 'PDF',
                extend: 'pdf',
                exportOptions: {
                    columns: [0, 1, 2,3,4,5,6,7]
                }
            },
            {
                text: '<i class="icon-download"></i><i class="icon-print"></i> ',
                className: 'rounded btn-dark m-2',
                titleAttr: 'Imprimir',
                extend: 'print',
                messageTop: 'INVENTARIO AL <br>'+currenDate.toString()+'<br>Laboratorio: '+$("#line_id option:selected").text(),
                footer: true,
                exportOptions: {
                    columns: [0, 1, 2,3,4,5,6,7]
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
                .column( 6 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
    
            // Total over this page
            pageTotal = api
                .column( 6, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
    
            // Update footer
            $( api.column( 6 ).footer() ).html(
                'Total: '+pageTotal.toFixed(2)
            );

        }
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
            code += '<label class="text-primary" for="line-product"><b>Linea de Producto:</b></label>';
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