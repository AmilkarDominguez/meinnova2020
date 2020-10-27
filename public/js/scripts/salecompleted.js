var table;
var id = 0;
$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    ListDatatable();
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
            url: 'salecompleted'
        },
        columns: [{
                data: 'id'
            },
            {
                data: 'user_name'
            },
            {
                data: 'client_name'
            },
            {
                data: 'seller_name'
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
                data: 'discount'
            },
            {
                data: 'receive'
            },
            {
                data: 'expiration_discount'
            },
            {
                data: 'payment_status'
            },
            {
                data: 'state',
                "render": function (data, type, row) {
                    if (row.state === 'ACTIVO') {
                        return '<center><p class="bg-success text-white"><b>ACTIVO</b></p></center>';
                    } else if (row.state === 'INACTIVO') {
                        return '<center><p class="bg-warning text-white"><b>INACTIVO</b></p></center>';
                    } else if (row.state === 'ELIMINADO') {
                        return '<center><p class="bg-danger text-white"><b>ELIMINADO</b></p></center>';
                    }
                }
            },
            {
                data: 'Concluir',
                orderable: false,
                searchable: false
            }
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
                    columns: [0, 1, 2,3,4,5,6,7,8,9,10]
                }
            },
            {
                text: '<i class="icon-download"></i><i class="icon-file-pdf"></i> ',
                className: 'rounded btn-dark m-2',
                titleAttr: 'PDF',
                extend: 'pdf',
                exportOptions: {
                    columns: [0, 1, 2,3,4,5,6,7,8,9,10]
                }
            },
            {
                text: '<i class="icon-download"></i><i class="icon-print"></i> ',
                className: 'rounded btn-dark m-2',
                titleAttr: 'Imprimir',
                extend: 'print',
                exportOptions: {
                    columns: [0, 1, 2,3,4,5,6,7,8,9,10]
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

function Completed(id_) {
        var id = id_;
        $.ajax({
            url: "salecompleted/{salecompleted}",
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
                //console.log(result.responseJSON.message);
                toastr.error("CONTACTE A SU PROVEEDOR POR FAVOR.");
            },
        });
        table.ajax.reload();
        

}