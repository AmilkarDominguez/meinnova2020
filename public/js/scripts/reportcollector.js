$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
   
    SelectCollector();
    dateEntry();
});



function Generate() {
    //Limpiar DataTable
    $("#table").dataTable().fnDestroy();

    if($("#collector_id").val()== null){
        toastr.warning("Debe Seleccionar un Cobrador.");
    }
    else if($("#minimum_date").val()==0){
        toastr.warning("Debe Seleccionar una Fecha minima.");
    }
     else if($("#maximum_date").val()==0){
        toastr.warning("Debe seleccionar una Fecha Maxima.");
    }
    else{
        ListDataTable();
    }
}

function ListDataTable(){
    
    table = $('#table').DataTable({
        dom: 'lfBrtip',
        processing: true,
        serverSide: true,
        "paging": true,
        language: {
            "url": "/js/assets/Spanish.json"
        },
        ajax: {
            url: '/getreportcollectors',
            data: function (obj) {
                obj.collector_id = $("#collector_id").val();
                obj.minimum_date = $("#minimum_date").val();
                obj.maximum_date = $("#maximum_date").val();
               
            }
        },
        columns: [{
                data: 'sale_id'
            },
            {
                data: 'entry_date'
            },
            {
                data: 'receipt_number'
            },
            {
                data: 'client_name'
            },
            {
                data: 'payment'
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
                    columns: [0, 1, 2,3,4]
                }
            },
            {
                text: '<i class="icon-download"></i><i class="icon-file-pdf"></i> ',
                className: 'rounded btn-dark m-2',
                titleAttr: 'PDF',
                extend: 'pdf',
                exportOptions: {
                    columns: [0, 1, 2,3,4]
                }
            },
            {
                text: '<i class="icon-download"></i><i class="icon-print"></i> ',
                className: 'rounded btn-dark m-2',
                titleAttr: 'Imprimir',
                extend: 'print',
                messageTop: 'COBROS REALIZADOS DE VENTAS POR VENDEDOR <br>Nombre cobrador: '+$("#collector_id option:selected").text()+'<br>Fechas: '+$("#minimum_date").val()+' - '+$("#maximum_date").val(),
                footer: true,
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
                .column( 4 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
    
            // Total over this page
            pageTotal = api
                .column( 4, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
    
            // Update footer
            $( api.column( 4 ).footer() ).html(
                'Total: '+pageTotal.toFixed(2)
            );

        }
    });
}

//seleccionar cobrador

function SelectCollector() {
    $.ajax({
        url: "listcollector",
        method: 'get',
        data: {
            by: "all"
        },
        success: function (result) {
            var code = '<select class="form-control border-primary" name="collector_id" id="collector_id" required>';
            $.each(result, function (key, value) {
                code += '<option selected value="' + value.id + '">' + value.name + '</option>';
                code += '<option disabled value="" selected>(Seleccionar)</option>';
            });
            code += '</select>';
            $("#select_collector").html(code);     
        },
        error: function (result) {
            toastr.error(result.msg + ' CONTACTE A SU PROVEEDOR POR FAVOR.');
            console.log(result);
        },

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