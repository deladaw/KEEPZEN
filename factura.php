<?php
//Esta es una página de Factura en formato PDF descargable hecha con la librería TCPDF.
//He dejado los comentarios de la plantilla original.
// Include the main TCPDF library (search for installation path).
require_once('./TCPDF/tcpdf.php');
include('./Controller/getUsuario.php');
include('./Controller/seguridad.php');
include('./Controller/seguridad_admin.php');

verificar_permisos();

$usuarioId = $_SESSION['id_usuario'];

$datosCliente = getUsuario($conexion, $usuarioId);

  
$resultado= $conexion->prepare("SELECT * FROM factura WHERE usuario_id = ? ");
$resultado->execute([$usuarioId]);
$datos = $resultado->fetch(PDO::FETCH_OBJ);


// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set default header data
$pdf->SetHeaderData(
    'Logotipo_keepzen.png',                
    45,           
    'Factura de compra',                
    'THEME PACK',         
    array(89, 137, 172),         
    array(0, 0, 0)         
);
$pdf->setFooterData(array(0,64,0), array(0,64,128));

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/es.php')) {
    require_once(dirname(__FILE__).'/lang/es.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set default font subsetting mode
$pdf->setFontSubsetting(true);

// Set font
// dejavusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.
$pdf->SetFont('helvetica', '', 13, '', true);

// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage();

// Set some content to print
$tableStyle = 'style="width: 100%;"'; // Estilo para la tabla principal

$logoStyle = 'style="width: 100px;"'; // Estilo para el logotipo

if($datosCliente){
    
    $fechaCompra = $datos->fecha_compra;
    $precio = $datos->precio;
    $fechaFormateada = date('d/m/Y', strtotime($fechaCompra));
    $email = $datos->email_compra;

    $clienteNombre = $datosCliente[0]->nombre;
    $clienteEmail = $datosCliente[0]->email;

    $html = <<<EOD
    <style>
        .invoice-table {
            width: 100%;
            margin-bottom: 20px;
        }
    
        .invoice-table th {
            background-color: #f2f2f2;
            padding: 8px;
        }
    
        .invoice-table td {
            padding: 8px;
        }
    
        .invoice-table td.key {
            font-weight: bold;
        }

        .separator {
            border-bottom: 1px solid #f2f2f2;
            margin-top: 40px;
            margin-bottom: 40px;
        }
    </style>
    
    <h1>Factura de compra</h1>
    
    <table class="invoice-table" $tableStyle>
        <tr>
            <th colspan="2">Datos de la empresa</th>
        </tr>
        <tr>
            <td class="key">Nombre de la empresa:</td>
            <td>KEEPZEN</td>
        </tr>
        <tr>
            <td class="key">Dirección de tu empresa:</td>
            <td>AVD de Alicante 21, Elche</td>
        </tr>
        <tr>
            <td class="key">Email:</td>
            <td>keepzen@info.com</td>
        </tr>
    </table>
    <br><br>
    <table class="invoice-table" $tableStyle>
        <tr>
            <th colspan="2">Datos del cliente</th>
        </tr>
        <tr>
            <td class="key">Nombre del cliente:</td>
            <td>$clienteNombre</td>
        </tr>
        <tr>
            <td class="key">Email:</td>
            <td>$email</td>
        </tr>
    </table>

    <div class="separator"></div>
    
    <p>Detalles de la compra:</p>
    <p><strong>Fecha:</strong> $fechaFormateada</p>
    <p><strong>Producto:</strong> Theme Pack - 1,99€</p>
    <p><strong>Precio:</strong> $precio €</p>
    EOD;
    


} else {

    echo "No se encontraron datos del cliente";
}



// Replace placeholders with actual data


// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('factura_themes_keepzen.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+