var table;
var count = 0;

$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    ListDatatablePayments();
   
});

function ListDatatablePayments() {
    table = $('#tablepayment').DataTable({
        dom: 'lfrtip',
        processing: true,
        serverSide: true,
        "paging": true,
        language: {
            "url": "/js/assets/Spanish.json"
        },
        ajax: {
            url: 'charge'

        },
        columns: [{
                data: 'sale_id'
            },
            {
                data: 'collector_name'
            },
            {
                data: 'receipt_number'
            },
            {
                data: 'payment'
            },
            {
                data: 'entry_date'
            },
            {
                data: 'Eliminar',
                orderable: false,
                searchable: false
            },
        ]
    });
};

//funcion para eliminar valor seleccionado
var id=0;
function Delete(id_) {
    id= id_;
    $('#modal_eliminar').modal('show');
}
$("#btn_delete").click(function () {
    $.ajax({
        url: "charge/{charge}",
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
