string += "<div class='container' id='nota'>";
string += "<div class='card border-primary p-2'>";
string += "<div class='row'>";
    string += "<div class='col align-self-start'>";
        string += "<h3><b>IMPORTADORA MIRANDA</b></h3>";
        string += "Av. Gran Chacho #542 - Palmarcito<br>";
        string += "Tel: 66-31611 Fax: 66-31611";
    string += "</div>";
string += "</div>";

string += "<center><h3><b>NOTA DE ENTREGA</b></h3></center>";

//DATOS DE VENTA
string += "<div class='row'>";
    string += "<div class='col-md-6'>";
        string += "<b>Cliente: </b>texto";
        string += "<br>";
        string += "<b>NIT: </b>texto";
        string += "<br>";
        string += "<b>Dirección: </b>texto";
        string += "<br>";
        string += "<b>Telefono: </b>texto";
    string += "</div>";
    string += "<div class='col-md-6'>";
        string += "<b>Nro: </b>texto";
        string += "<br>";
        string += "<b>Fecha: </b>texto";
        string += "<br>";
        string += "<b>Vendedor: </b>texto";
    string += "</div>";
string += "</div>";
//FIN DATOS DE VENTA
//TABLA DETALLES
string += "<br>";
string += "<div class='row'>";
    string += "<div class='col-md-12'>";
        string += "<table class='table'>";
            string += "<thead class='bg-secondary'>";
                string += "<tr>";
                    string += "<td><b>Nro</b></td>";
                    string += "<td><b>Descripcón</b></td>";
                    string += "<td><b>Cod. Lote</b></td>";
                    string += "<td><b>Reg. Sanitario</b></td>";
                    string += "<td><b>Vencimiento</b></td>";
                    string += "<td><b>Cantidad</b></td>";
                    string += "<td><b>Precio unitario</b></td>";
                    string += "<td><b>Subtotal</b></td>";
                string += "</tr>";   
            string += "</thead>";
            string += "<tbody>";
                //DETALLES
                string += "<tr>";
                    string += "<td>1</td>";
                    string += "<td>Aspirinias de 100 gr.</td>";
                    string += "<td>1545412</td>";
                    string += "<td>RS/264646</td>";
                    string += "<td>24/01/2019</td>";
                    string += "<td>121.00</td>";
                    string += "<td>120.00</td>";
                    string += "<td>120.00</td>";
                string += "</tr>";
                //FIN DETALLES   
                
                
            string += "</tbody>";
        string += "</table>";
    string += "</div>";
string += "</div>";
//FIN TABLA DETALLES

//TOTALES VENTA
string += "<div class='row'>";
    string += "<div class='col-md-12 text-right'>";
        string += "<b></b>";
        string += "Descuento: <b>0.5</b><br>";
        string += "Vencimiento del descuento: <b>24/08/2019</b><br>";
        string += "Total con descuento: <b>12500.00</b><br>";
        string += "<hr>";
        string += "Total: <b>12500.00</b><br>";
        string += "Doce mil quinientos 00/100 Bs.<br>";
    string += "</div>";
string += "</div>";
string += "</div>";
string += "</div>";
//FIN TOTALES VENTA














string += "<div class='container' id='nota'>";
string += "<div class='card border-primary p-2'>";
string += "<div class='row'>";
string += "<div class='col align-self-start'>";
string += "<h3><b>IMPORTADORA MIRANDA</b></h3>";
string += "Av. Gran Chacho #542 - Palmarcito<br>";
string += "Tel: 66-31611 Fax: 66-31611";
string += "</div>";
string += "</div>";

string += "<center><h3><b>NOTA DE ENTREGA</b></h3></center>";

//DATOS DE VENTA
string += "<div class='row'>";
string += "<div class='col-md-6'>";
string += "<b>Cliente: </b>" + sale.client.name;
string += "<br>";
string += "<b>NIT: </b>" + sale.client.nit;
string += "<br>";
string += "<b>Dirección: </b>" + sale.client.address;
string += "<br>";
string += "<b>Telefono: </b>" + sale.client.phone;
string += "</div>";
string += "<div class='col-md-6'>";
string += "<b>Nro.: </b>" + sale.id;
string += "<br>";
string += "<b>Fecha: </b>" + sale.date;
string += "<br>";
string += "<b>Vendedor: </b>" + sale.seller.name;
string += "</div>";
string += "</div>";
//FIN DATOS DE VENTA
//TABLA DETALLES
string += "<br>";
string += "<div class='row'>";
string += "<div class='col-md-12'>";
string += "<table class='table'>";
string += "<thead class='bg-secondary'>";
string += "<tr>";
string += "<td><b>Nro</b></td>";
string += "<td><b>Descripcón</b></td>";
string += "<td><b>Cod. Lote</b></td>";
string += "<td><b>Reg. Sanitario</b></td>";
string += "<td><b>Vencimiento</b></td>";
string += "<td><b>Cantidad</b></td>";
string += "<td><b>Precio unitario</b></td>";
string += "<td><b>Subtotal</b></td>";
string += "</tr>";
string += "</thead>";
string += "<tbody>";

//DETALLES
string += "<tr>";
//NRO
string += "<td>" + (key + 1) + "</td>";
//NOMBRE PRODUCTO (descripcion)
string += "<td>" + detail.batch.product.name + "</td>";
//Codigo lote
string += "<td>" + detail.batch.code + "</td>";
//Registro sanitario
string += "<td>" + detail.batch.sanitary_registration + "</td>";
//Vencimiento
string += "<td>" + detail.batch.expiration_date + "</td>";
//Cantidad
string += "<td>" + detail.amount + "</td>";
//Precio unitario
string += "<td>" + detail.batch.wholesaler_price + "</td>";
//Sub total
string += "<td>" + detail.subtotal + "</td>";
string += "</tr>";
//FIN DETALLES  

string += "</tbody>";
string += "</table>";
string += "</div>";
string += "</div>";
//FIN TABLA DETALLES

//TOTALES VENTA
//console.log("Totales venta")
//console.log(sale);
string += "<div class='row'>";
string += "<div class='col-md-12 text-right'>";
string += "<b></b>";
string += "Descuento: <b>"+sale.discount+"%</b><br>";
string += "Vencimiento del descuento: <b>"+sale.expiration_discount+"</b><br>";
string += "Total con descuento: <b>"+sale.total_discount+"</b><br>";
string += "<hr>";
string += "Total: <b>"+sale.total+"</b><br>";
//string += "Doce mil quinientos 00/100 Bs.<br>";
string += "</div>";
string += "</div>";
string += "</div>";
string += "</div>";
//FIN TOTALES VENTA

