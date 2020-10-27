var table;
var id = 0;
var title_modal_data = "Registrar Nuevo Cliente";
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
            url: '/sale'
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
            //{ data: 'Detalles',   orderable: false, searchable: false },
            {
                data: 'NotaVenta',
                orderable: false,
                searchable: false
            },
            {
                data: 'Eliminar',
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
    });
};

var string = "";
var details = [];
var sale;
// detalle de lote

function getSale(id) {
    //Metodo para traer datos de la venta con detalles

    $.ajax({
        url: "sale/{sale}",
        method: 'get',
        data: {
            id: id
        },
        success: function (result) {
            //console.log("llegando..");
            //console.log(result[0]);
            //console.log(result[0].details);

            sale = result[0];
            //console.log(sale);
            //DATOS DE VENTA

            string += "<div class='row card border-dark'>";
            string += "<div class='col-md-12'>";

            string += "<table class='table'>";
            string += "<tr>";
            string += "<td>";
            string += "<b>Cliente: </b>" + sale.client.name;
            string += "<br>";
            string += "<b>NIT: </b>" + sale.client.nit;
            string += "<br>";
            string += "<b>Dirección: </b>" + sale.client.address;
            string += "<br>";
            string += "<b>Telefono: </b>" + sale.client.phone;
            string += "</td>";
            string += "<td>";
            string += "<b>Nro.: </b>" + sale.id;
            string += "<br>";
            string += "<b>Fecha: </b>" + sale.date;
            string += "<br>";
            string += "<b>Vendedor: </b>" + sale.seller.name;
            string += "</td>";
            string += "</tr>";
            string += "</table>";
            string += "</div>";
            string += "</div>";


            //string += "</div>";
            //string += "<div class='col-md-6'>";

            //string += "</div>";

            //FIN DATOS DE VENTA
            //TABLA DETALLES
            string += "<br>";
            string += "<div class='row'>";
            string += "<div class='col-md-12 table-responsive'>";
            string += "<table class='table table-bordered'>";
            string += "<thead class='bg-secondary'>";
            string += "<tr>";
            string += "<td><b>Nro.</b></td>";
            string += "<td><b>Descripción</b></td>";
            string += "<td><b>Cod. Lote</b></td>";
            string += "<td><b>Nro. Lote</b></td>";
            string += "<td><b>Reg. Sanitario</b></td>";
            string += "<td><b>Vencimiento</b></td>";
            string += "<td><b>Cantidad</b></td>";
            string += "<td><b>Precio unitario</b></td>";
            string += "<td><b>Subtotal</b></td>";
            string += "</tr>";
            string += "</thead>";
            string += "<tbody>";

            getCompleteDetails(sale.details);
            //console.log(string);
            //console.log(string);
            //sale = result;
            //return result;
            //console.log(sale);
            //show_detail(result);
        },
        error: function (result) {
            toastr.error(result + ' CONTACTE A SU PROVEEDOR POR FAVOR.');
            console.log(result);
        },
    });
}

function getCompleteDetails(ArrayDetails) {
    //Metodo para traer todos todos los datos del detalle
    $.each(ArrayDetails, function (key, value) {
        //show_detail(value);
        //console.log(value);
        //Metodo para traer todos los datos de un detalle

        $.ajax({
            url: "detail/{detail}",
            method: 'get',
            data: {
                id: value.id
            },
            success: function (result) {
                //console.log(result[0]);
                //details.push(result[0]);
                //console.log(details);
                //DETALLES
                string += "<tr>";
                //NRO
                string += "<td>" + (key + 1) + "</td>";
                //NOMBRE PRODUCTO (descripcion)
                string += "<td>" + result[0].name_product + "</td>";
                //Codigo lote
                string += "<td>" + result[0].batch.code + "</td>";
                //Codigo lote
                string += "<td>" + result[0].batch.id + "</td>";
                //Registro sanitario
                string += "<td>" + result[0].batch.sanitary_registration + "</td>";
                //Vencimiento
                string += "<td>" + result[0].batch.expiration_date + "</td>";
                //Cantidad
                string += "<td>" + result[0].amount + "</td>";
                //Precio unitario
                string += "<td>" + result[0].batch.wholesaler_price + "</td>";
                //Sub total
                string += "<td>" + result[0].subtotal + "</td>";
                string += "</tr>";


                if ((key + 1) == ArrayDetails.length) {
                    string += "</tbody>";
                    string += "</table>";
                    string += "</div>";
                    string += "</div>";
                    //FIN TABLA DETALLES

                    //TOTALES VENTA
                    string += "<div class='row'>";
                    string += "<div class='col-md-12 text-right'>";
                    string += "<b></b>";
                    string += "Descuento: <b>" + sale.discount * 100 + " %</b><br>";
                    string += "Vencimiento del descuento: <b>" + sale.expiration_discount + "</b><br>";
                    string += "Total con descuento: <b>" + sale.total_discount + "</b><br>";
                    string += "<hr>";
                    string += "Total: <b>" + sale.total + "</b><br>";

                    var nl = numeroALetras(parseInt(sale.total), {
                        plural: " ",
                        singular: " ",
                        centPlural: " ",
                        centSingular: " "
                    });

                    var dec = ((sale.total - parseInt(sale.total)).toFixed(2)) * 100;
                    if (dec==0) {dec="00";}

                    string += nl + " CON " + dec + "/100 BOLIVIANOS";
                    string += "<br><br><br><br><div class='table-responsive'><table class='table table-borderless text-center'><tr><td>________________</td><td>________________</td><td>________________</td></tr><tr><td>Despachado por</td><td>Entregué conforme</td><td>Recibí conforme</td></tr></table></div>";
                    string += "</div>";
                    string += "</div>";
                    //string += "</div>";
                    //string += "</div>";
                    //FIN TOTALES VENTA
                }
                //FIN DETALLES  
                //details.push(result);
                //var detail = result;

                //console.log(result);
                //show_detail(result);
                //console.log(string);
                $("#nota_venta").html(string);


            }
        });
    });

}
var ss;

function SaleNote(id) {
    details = [];
    sale = null;
    string = "";
    //string += "<div class='container'>";
    //string += "<div class='p-2'>";
    string += "<div class='row p-4'>";
    string += "<div class='col-md-12 align-self-start'>";
    string += "<h3><b>Distribuidora Miranda</b></h3>";
    //string += "<img src='http://ibpipuc.org/wp-content/uploads/2017/05/logoibp-smart.png' alt='...' class='img-fluid'><br>";
    string += "Av. Gran Chaco #542 - Palmarcito<br>";
    string += "Tel: 66-31611 Cel: 74536670<br>";
    string += "Correo electrónico: mirandaehijos1@gmail.com";
    string += "</div>";
    string += "</div>";

    string += "<center><h3><b>NOTA DE ENTREGA</b></h3></center>";



    getSale(id);

    //printNote();
    //console.log(sale);
    //getDetails(id);
    //printNote();
};


//funcion para eliminar valor seleccionado
function Delete(id_) {
    id = id_;
    $('#modal_eliminar').modal('show');
}
$("#btn_delete").click(function () {
    $.ajax({
        url: "sale/{sale}",
        method: 'delete',
        data: {
            id: id
        },
        success: function (result) {
            //console.log(result);
            if (result.success) {
                toastr.success(result.msg, {
                    "progressBar": true,
                    "closeButton": true
                });
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

function printNote() {
    var frame1 = $('<iframe />');
    frame1[0].name = "frame1";
    frame1.css({
        "position": "absolute",
        "top": "-1000000px"
    });
    $("body").append(frame1);
    var frameDoc = frame1[0].contentWindow ? frame1[0].contentWindow : frame1[0].contentDocument.document ? frame1[0].contentDocument.document : frame1[0].contentDocument;
    frameDoc.document.open();
    //Create a new HTML document.
    frameDoc.document.write('<html><head><title>Distribuidora Miranda</title>');
    frameDoc.document.write('</head><body>');
    //Append the external CSS file.
    frameDoc.document.write('<link href="css/theme.css" rel="stylesheet" type="text/css" />');

    var source = 'bootstrap.min.js';
    var script = document.createElement('script');
    script.setAttribute('type', 'text/javascript');
    script.setAttribute('src', source);
    //Append the DIV contents.
    frameDoc.document.write(string);
    frameDoc.document.write('</body></html>');
    frameDoc.document.close();
    setTimeout(function () {
        window.frames["frame1"].focus();
        window.frames["frame1"].print();
        frame1.remove();
    }, 500);
}




//Numero A Letras
var numeroALetras = (function () {
    // Código basado en el comentario de @sapienman
    // Código basado en https://gist.github.com/alfchee/e563340276f89b22042a
    function Unidades(num) {

        switch (num) {
            case 1:
                return 'UN';
            case 2:
                return 'DOS';
            case 3:
                return 'TRES';
            case 4:
                return 'CUATRO';
            case 5:
                return 'CINCO';
            case 6:
                return 'SEIS';
            case 7:
                return 'SIETE';
            case 8:
                return 'OCHO';
            case 9:
                return 'NUEVE';
        }

        return '';
    } //Unidades()

    function Decenas(num) {

        let decena = Math.floor(num / 10);
        let unidad = num - (decena * 10);

        switch (decena) {
            case 1:
                switch (unidad) {
                    case 0:
                        return 'DIEZ';
                    case 1:
                        return 'ONCE';
                    case 2:
                        return 'DOCE';
                    case 3:
                        return 'TRECE';
                    case 4:
                        return 'CATORCE';
                    case 5:
                        return 'QUINCE';
                    default:
                        return 'DIECI' + Unidades(unidad);
                }
                case 2:
                    switch (unidad) {
                        case 0:
                            return 'VEINTE';
                        default:
                            return 'VEINTI' + Unidades(unidad);
                    }
                    case 3:
                        return DecenasY('TREINTA', unidad);
                    case 4:
                        return DecenasY('CUARENTA', unidad);
                    case 5:
                        return DecenasY('CINCUENTA', unidad);
                    case 6:
                        return DecenasY('SESENTA', unidad);
                    case 7:
                        return DecenasY('SETENTA', unidad);
                    case 8:
                        return DecenasY('OCHENTA', unidad);
                    case 9:
                        return DecenasY('NOVENTA', unidad);
                    case 0:
                        return Unidades(unidad);
        }
    } //Unidades()

    function DecenasY(strSin, numUnidades) {
        if (numUnidades > 0)
            return strSin + ' Y ' + Unidades(numUnidades)

        return strSin;
    } //DecenasY()

    function Centenas(num) {
        let centenas = Math.floor(num / 100);
        let decenas = num - (centenas * 100);

        switch (centenas) {
            case 1:
                if (decenas > 0)
                    return 'CIENTO ' + Decenas(decenas);
                return 'CIEN';
            case 2:
                return 'DOSCIENTOS ' + Decenas(decenas);
            case 3:
                return 'TRESCIENTOS ' + Decenas(decenas);
            case 4:
                return 'CUATROCIENTOS ' + Decenas(decenas);
            case 5:
                return 'QUINIENTOS ' + Decenas(decenas);
            case 6:
                return 'SEISCIENTOS ' + Decenas(decenas);
            case 7:
                return 'SETECIENTOS ' + Decenas(decenas);
            case 8:
                return 'OCHOCIENTOS ' + Decenas(decenas);
            case 9:
                return 'NOVECIENTOS ' + Decenas(decenas);
        }

        return Decenas(decenas);
    } //Centenas()

    function Seccion(num, divisor, strSingular, strPlural) {
        let cientos = Math.floor(num / divisor)
        let resto = num - (cientos * divisor)

        let letras = '';

        if (cientos > 0)
            if (cientos > 1)
                letras = Centenas(cientos) + ' ' + strPlural;
            else
                letras = strSingular;

        if (resto > 0)
            letras += '';

        return letras;
    } //Seccion()

    function Miles(num) {
        let divisor = 1000;
        let cientos = Math.floor(num / divisor)
        let resto = num - (cientos * divisor)

        let strMiles = Seccion(num, divisor, 'UN MIL', 'MIL');
        let strCentenas = Centenas(resto);

        if (strMiles == '')
            return strCentenas;

        return strMiles + ' ' + strCentenas;
    } //Miles()

    function Millones(num) {
        let divisor = 1000000;
        let cientos = Math.floor(num / divisor)
        let resto = num - (cientos * divisor)

        let strMillones = Seccion(num, divisor, 'UN MILLON DE', 'MILLONES DE');
        let strMiles = Miles(resto);

        if (strMillones == '')
            return strMiles;

        return strMillones + ' ' + strMiles;
    } //Millones()

    return function NumeroALetras(num, currency) {
        currency = currency || {};
        let data = {
            numero: num,
            enteros: Math.floor(num),
            centavos: (((Math.round(num * 100)) - (Math.floor(num) * 100))),
            letrasCentavos: '',
            letrasMonedaPlural: currency.plural || 'PESOS CHILENOS', //'PESOS', 'Dólares', 'Bolívares', 'etcs'
            letrasMonedaSingular: currency.singular || 'PESO CHILENO', //'PESO', 'Dólar', 'Bolivar', 'etc'
            letrasMonedaCentavoPlural: currency.centPlural || 'CHIQUI PESOS CHILENOS',
            letrasMonedaCentavoSingular: currency.centSingular || 'CHIQUI PESO CHILENO'
        };

        if (data.centavos > 0) {
            data.letrasCentavos = 'CON ' + (function () {
                if (data.centavos == 1)
                    return Millones(data.centavos) + ' ' + data.letrasMonedaCentavoSingular;
                else
                    return Millones(data.centavos) + ' ' + data.letrasMonedaCentavoPlural;
            })();
        };

        if (data.enteros == 0)
            return 'CERO ' + data.letrasMonedaPlural + ' ' + data.letrasCentavos;
        if (data.enteros == 1)
            return Millones(data.enteros) + ' ' + data.letrasMonedaSingular + ' ' + data.letrasCentavos;
        else
            return Millones(data.enteros) + ' ' + data.letrasMonedaPlural + ' ' + data.letrasCentavos;
    };

})();
