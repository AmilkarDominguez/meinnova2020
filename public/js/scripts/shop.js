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
    ListDatatableClients();
    SelectSeller();
    DateTimePicker();
    catch_parameters();
});

function SelectSeller() {
    $.ajax({
        url: "listseller",
        method: 'get',
        data: {
            by: "all"
        },
        success: function (result) {
            var code = '<select class="form-control border-primary" name="seller_id" id="seller_id" required>';
            $.each(result, function (key, value) {
                code += '<option selected value="' + value.id + '">' + value.name + '</option>';
            });
            code += '</select>';
            $("#select_seller").html(code);
        },
        error: function (result) {
            toastr.error(result.msg + ' CONTACTE A SU PROVEEDOR POR FAVOR.');
            console.log(result);
        },

    });
}
// datatable catalogos
function ListDatatable() {
    table = $('#table').DataTable({
        dom: 'lfrtip',
        processing: true,
        serverSide: true,
        "paging": true,
        language: {
            "url": "/js/assets/Spanish.json"
        },
        ajax: {
            url: 'shop'

        },
        columns: [{
                data: 'code'
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
            {
                data: 'Detalle',
                orderable: false,
                searchable: false
            },
            {
                data: 'Shop',
                orderable: false,
                searchable: false
            },
        ]
    });
};
// datatable dt_clients
function ListDatatableClients() {
    table = $('#table_clients').DataTable({
        dom: 'lfrtip',
        processing: true,
        serverSide: true,
        "paging": true,
        language: {
            "url": "/js/assets/Spanish.json"
        },
        ajax: {
            url: 'dt_clients'

        },
        columns: [{
                data: 'name'
            },
            {
                data: 'nit'
            },
            {
                data: 'SelectClient',
                orderable: false,
                searchable: false
            },
        ]
    });
};

// detalle de lote
function Detail(id) {
    $.ajax({
        url: "batch/{batch}",
        method: 'get',
        data: {
            id: id
        },
        success: function (result) {
            //console.log(result);
            show_detail(result[0]);
            //show_detail(result);
        },
        error: function (result) {
            toastr.error(result + ' CONTACTE A SU PROVEEDOR POR FAVOR.');
            console.log(result);
        },

    });
};
//muestra el detalle
function show_detail(obj) {
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
    if (obj.description != null) {
        string += "<p><b>Descripción:</b>&nbsp;" + obj.description + "</p>";
    } else {
        string += "<p><b>Descripción:</p>";
    }
    string += "<hr>";
    //DATOS DE INVENTARIO
    string += "<p><h5><b>DATOS DE INVENTARIO</b></h5></p>";
    string += "<p><b>Almacén:</b>&nbsp;" + obj.storage.name + "</p>";
    string += "<p><b>Stock inicial:</b>&nbsp;" + obj.initial_stock + "</p>";
    string += "<p><b>Precio de venta:</b>&nbsp;" + obj.wholesaler_price + "</p>";
    $("#title-modal-detalle").html("Detalle de Lote");
    $('#content_detalle').html(string);
    $('#modal_detalle').modal('show');
};

////////////////////////////////////////
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

function printDetails() {
    var divToPrint = document.getElementById("content_detalle");
    newWin = window.open("");
    newWin.document.write(divToPrint.outerHTML);
    newWin.print();
    newWin.close();
}
///////////////////////
//For basket
//////////////////////
var Basket = [];
var row_index = 1;
var total = 0;
var total_d = 0;
var id_client = 0;
//fecha de expiracion
function DateTimePicker() {
    $('#datetimepicker1').datetimepicker({
        format: 'YYYY-MM-DD',
        daysOfWeekDisabled: [0, 7]
    });
}

function GenerateSelectDiscount() {
    var code = '<select class="form-control border-primary" name="seller_id" id="seller_id" required>';
    code += '<option selected value=""></option>';
    code += '</select>';
    $("#select_seller").html(code);
    return
}

function AddBasket(id, name, price, stock) {
    //console.log(price);
    var index = Basket.findIndex(item => item.id === id);
    if (index == -1) {
        var product = {
            "id": id,
            "name": name,
            "price": price,
            "subtotal": 1 * price,
            "amount": 1,
            "stock" : stock
        };
        Basket.push(product);
        var code = '<tr id="tr' + row_index + '">';
        code += '<td>' + product.name + '</td>';
        code += '<td>' + product.price + '</td>';
        code += '<td id="td_subtotal' + row_index + '" class="text-danger"><b>' + product.subtotal + '</b></b>';
        code += '<td><input id="amount' + row_index + '" type="number" onchange="AmountChange(' + row_index + ',' + product.id + ',\'' + product.name + '\');" class="form-control" min="1" max="'+product.stock+'" value="1" onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57"></td>';


        code += '<td><a class="btn btn-xs btn-danger text-white" onclick="RemoveBasket(' + row_index + ',' + product.id + ')"><i class="icon-cart-arrow-down"></i></a></td>';
        code += '</tr>'
        $('#table-basket').append(code);
        row_index++;
        ShowTotal();
    } else {
        toastr.warning('El producto ya se encuentra agregado.');
    }
}


function AmountChange(row_index, id) {
    var idinput = "#amount" + row_index;
    //Busca indice (index) del item en el array mediante el ID
    var index = Basket.findIndex(item => item.id === id);
    var val_imput =  parseInt($(idinput).val());
    //console.log("valor input: "+val_imput);
    //console.log("valor stock en carrito: "+Basket[index].stock);
    //console.log(Basket);
    if (Basket[index].stock>=val_imput){     
        Basket[index].amount = val_imput;
        Basket[index].subtotal = Basket[index].price * Basket[index].amount;
        $('#td_subtotal' + row_index).html('<b>' + Basket[index].subtotal.toFixed(2) + '</b>');
        ShowTotal();
    } 
    else{
        toastr.error('La cantidad no puede sobre pasar el stock del producto: '+Basket[index].stock);
        $(idinput).val(Basket[index].stock);
        AmountChange(row_index, id);
    }
    //console.log(Basket);
}


function RemoveBasket(row_i, id) {
    $("#tr" + row_i).remove();
    var index = Basket.findIndex(item => item.id === id)
    Basket.splice(index, 1);
    ShowTotal();

    //console.log(Basket);
}


function SelectClient(id, name) {
    id_client = id;
    $("#name_client").html(name);;
}

function ShowTotal() {
    total = 0;
    total_d = 0;
    for (let index = 0; index < Basket.length; index++) {
        total += Basket[index].subtotal;
    }
    total = total.toFixed(2);
    total_d = total - (total * $('#select_discount').val());
    total_d = total_d.toFixed(2);
    $('#total_c').html(total_d);
    $('#total_s').html(total);
}

function SaveSale() {
    if(Basket.length == 0){
        toastr.warning("Debe seleccionar almenos un productos antes de registrar la venta.");
    }
    else if (id_client != 0){
        var d = new Date();
        var currenDate = d.getFullYear() + "-" + (d.getMonth()+1) + "-" + d.getDate();
        var data = {
            'date' : currenDate.toString(),
            'total' : total,
            'client_id' : id_client,
            'seller_id' : $('#seller_id').val(),
            'user_id' : $('#user_id').val(),
            'discount' : $('#select_discount').val(),
            'expiration_discount' : $('#expiration_discount').val(),
            'total_discount' : total_d,
            'payment_status_id' : 5, //5 PENDIENTE | 6 EN CURSO | 7 CANCELADO
            'state' : 'ACTIVO',
            'receive': 0,
        };
        //console.log(data);
        $.ajax({
            url: "sale",
            method: 'post',
            data: data,
            success: function (result) {
                if (result.success) {
                    SaveDetails(result.sale_id);
                    //toastr.success(result.msg);
                    //console.log("ID VENTA REGISTRADA "+result.sale_id);
    
                } else {
                    toastr.warning(result.msg);
                }
            },
            error: function (result) {
                console.log(result.responseJSON.message);
                toastr.error("CONTACTE A SU PROVEEDOR POR FAVOR.");
            },
        });
    }
    else {
        toastr.warning("Debe seleccionar un cliente antes de registrar la venta.");
    }

}

function SaveDetails(sale_id){

    for (let index = 0; index < Basket.length; index++) {
        var data = {
            'name_product':Basket[index].name,	
            'amount':Basket[index].amount,	
            'subtotal':Basket[index].subtotal.toFixed(2),		
            'sale_id':sale_id,
            'batch_id':Basket[index].id,
            'state':'ACTIVO',
        };
        //console.log(data);
        $.ajax({
            url: "detail",
            method: 'post',
            data: data,
            success: function (result) {
                if (result.success) {
                    console.log("registros de detalles guardados correctamente..");
                    //
                    //toastr.success(result.msg);
    
                } else {
                    toastr.warning(result.msg);
                }
            },
            error: function (result) {
                console.log(result.responseJSON.message);
                toastr.error("CONTACTE A SU PROVEEDOR POR FAVOR.");
            },
        });
    }
    SuccessSale()
    //location.reload();
}

function SuccessSale(){
    $("#btn_save_sale").hide();
    $("#btn_save_sale").addClass("disabled");
    $("#modal_sale_susscess").modal("show");
}