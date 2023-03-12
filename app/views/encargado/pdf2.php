<?php 

$pdf = new Pdf;
// setMargins (float(izq), float(arriba), float(der)) medidas en milimetros
$mt = 30; // margin top
$ml = 15; // margin left- right
$mr = 10;
$currentWidth = floor($pdf->GetPageWidth() - 2*$ml); // actual width after use margin left-right
$blockSpace = 8;
$signatureSpace = 15;
$itemsBlockSpace = 3;

$pdf->SetMargins($ml,$mt,$mr);
$pdf->AddPage();

// ******* seccion TITULO de documento
$pdf->SetFont('Helvetica','',15);

$w_os = floor($currentWidth/5);
$w_os_type = $currentWidth - $w_os*6;

$border_os = FALSE;
$fill_os = TRUE;

$pdf->bgPrimary();
$pdf->textDark();
$pdf->Cell($w_os/3.5,8,utf8_decode(''), 0,0,'C');
$pdf->Cell($w_os,8,utf8_decode('ORDEN DE SERVICIO N° 30'), 'B',0,'C');
$pdf->Cell($w_os/6,8,utf8_decode(''), 'B',0,'C');

$pdf->bgPrimary();
$pdf->textWhite();
$pdf->Cell($w_os_type,8,utf8_decode('FONDOS'), 'B',1,'C', $fill_os);
$pdf->Ln($blockSpace);

// ******* seccion detalles de ORden de servicio
$pdf->SetFont('Helvetica','',9);

	$w_title = floor($currentWidth/5);
	$w_details = $currentWidth - $w_title*3.5;
	$border_detalles = FALSE;
	$fill_detalles = TRUE;

$pdf->bgPrimary();
$pdf->textWhite();
$pdf->Cell($w_title,6,utf8_decode('  Solicitante'), $border_detalles,0,'L',$fill_detalles);
$pdf->bgNeutral();
$pdf->textDark();
$pdf->Cell($w_details,6,utf8_decode($data->mina), $border_detalles,0,'C',$fill_detalles);

$pdf->bgPrimary();
$pdf->textWhite();
$pdf->Cell($w_title,6,utf8_decode('  Estado'), $border_detalles,0,'L',$fill_detalles);
$pdf->bgNeutral();
$pdf->textDark();
$pdf->Cell($w_details,6,utf8_decode($data->estado), $border_detalles,1,'C',$fill_detalles);

$pdf->Ln(1);

$pdf->bgPrimary();
$pdf->textWhite();
$pdf->Cell($w_title,6,utf8_decode('  Centro de costo'), $border_detalles,0,'L',$fill_detalles);
$pdf->bgNeutral();
$pdf->textDark();
$pdf->Cell($w_details,6,utf8_decode($data->mina), $border_detalles,0,'C',$fill_detalles);

$pdf->bgPrimary();
$pdf->textWhite();
$pdf->Cell($w_title,6,utf8_decode('  Categoria'), $border_detalles,0,'L',$fill_detalles);
$pdf->SetFillColor(244,251,251);
$pdf->textDark();
$pdf->Cell($w_details,6,utf8_decode($data->categoria), $border_detalles,1,'C',$fill_detalles);

$pdf->Ln(1);

$pdf->bgPrimary();
$pdf->textWhite();
$pdf->Cell($w_title,6,utf8_decode('  Fecha Creacion'), $border_detalles,0,'L',$fill_detalles);
$pdf->bgNeutral();
$pdf->textDark();
$pdf->Cell($w_details,6,utf8_decode(fixedFecha($data->creado)), $border_detalles,0,'C',$fill_detalles);

$pdf->bgPrimary();
$pdf->textWhite();
$pdf->Cell($w_title,6,utf8_decode('  Fecha Actualizacion'), $border_detalles,0,'L',$fill_detalles);
$pdf->bgNeutral();
$pdf->textDark();
$pdf->Cell($w_details,6,utf8_decode(fixedFecha($data->acttualizado)), $border_detalles,1,'C',$fill_detalles);
$pdf->Ln(1);

$filename = 'OS_n°_' . $data->num_os;

$pdf->Ln($itemsBlockSpace);


// ******* seccion items de Orden de servicio
	$headerTableHeight = 8;
	$rowTableHeight = 7;

$pdf->SetFont('Helvetica','',10);
$pdf->bgPrimary();
$pdf->textWhite();
$pdf->Cell(8,$headerTableHeight,utf8_decode('N°'), 1,0,'C',true);
$pdf->Cell(15,$headerTableHeight,utf8_decode('Unidad'), 1,0,'C',true);
$pdf->Cell(102,$headerTableHeight,utf8_decode('Descripcion'), 1,0,'C',true);
$pdf->Cell(30,$headerTableHeight,utf8_decode('Proveedor'), 1,0,'C',true);
$pdf->Cell(25,$headerTableHeight,utf8_decode('Valor Refer.'), 1,1,'C',true);

$pdf->SetFont('Helvetica','',9);
$pdf->bgWhite();
$pdf->textDark();
$pdf->Cell(8,$rowTableHeight,utf8_decode('Item'), 1,0,'C',true);
$pdf->Cell(15,$rowTableHeight,utf8_decode('Unidad'), 1,0,'C',true);
$pdf->Cell(102,$rowTableHeight,utf8_decode('Descripcion'), 1,0,'C',true);
$pdf->Cell(30,$rowTableHeight,utf8_decode('Proveedor'), 1,0,'C',true);
$pdf->Cell(25,$rowTableHeight,utf8_decode('Valor Refer.'), 1,1,'C',true);

$pdf->bgWhite();
$pdf->textDark();
$pdf->Cell(8,$rowTableHeight,utf8_decode('Item'), 1,0,'C',true);
$pdf->Cell(15,$rowTableHeight,utf8_decode('Unidad'), 1,0,'C',true);
$pdf->Cell(102,$rowTableHeight,utf8_decode('Descripcion'), 1,0,'C',true);
$pdf->Cell(30,$rowTableHeight,utf8_decode('Proveedor'), 1,0,'C',true);
$pdf->Cell(25,$rowTableHeight,utf8_decode('Valor Refer.'), 1,1,'C',true);
$pdf->bgWhite();
$pdf->textDark();
$pdf->Cell(8,$rowTableHeight,utf8_decode('Item'), 1,0,'C',true);
$pdf->Cell(15,$rowTableHeight,utf8_decode('Unidad'), 1,0,'C',true);
$pdf->Cell(102,$rowTableHeight,utf8_decode('Descripcion'), 1,0,'C',true);
$pdf->Cell(30,$rowTableHeight,utf8_decode('Proveedor'), 1,0,'C',true);
$pdf->Cell(25,$rowTableHeight,utf8_decode('Valor Refer.'), 1,1,'C',true);
$pdf->bgWhite();
$pdf->textDark();
$pdf->Cell(8,$rowTableHeight,utf8_decode('Item'), 1,0,'C',true);
$pdf->Cell(15,$rowTableHeight,utf8_decode('Unidad'), 1,0,'C',true);
$pdf->Cell(102,$rowTableHeight,utf8_decode('Descripcion'), 1,0,'C',true);
$pdf->Cell(30,$rowTableHeight,utf8_decode('Proveedor'), 1,0,'C',true);
$pdf->Cell(25,$rowTableHeight,utf8_decode('Valor Refer.'), 1,1,'C',true);


$pdf->Ln($itemsBlockSpace);


	$row_title = floor($currentWidth/3.5);
	$row_details = $currentWidth - $row_title;
	$border_obs = TRUE;
	$fill_obs = TRUE;

$pdf->bgPrimary();
$pdf->textWhite();
$pdf->Cell($row_title,7,utf8_decode('Enlace Referencia: '), $border_obs,0,'C',$fill_obs);
$pdf->bgWhite();
$pdf->textDark();
$pdf->Cell($row_details,7,utf8_decode('  Monto '), $border_obs,1,'L',$fill_obs);

// $pdf->Ln(2);

$pdf->bgPrimary();
$pdf->textWhite();
$pdf->Cell($row_title,7,utf8_decode('Archivos Adjuntos: '), $border_obs,0,'C',$fill_obs);
$pdf->bgWhite();
$pdf->textDark();
$pdf->Cell($row_details,7,utf8_decode('  Monto '), $border_obs,1,'L',$fill_obs);

$pdf->Ln($blockSpace);


$txt = "mi txto lorem Lorem, ipsum dolor
 sit amet consectetur adipisicing elit.
  Quam adipisci sunt id consectetur voluptatum sequi
     Praesentium, ipsam, optio atque non impedit veritati
     s soluta quam repellendus quod rerum commodi eo
     s molestiae.";

$pdf->SetFont('Helvetica','', 9);
$pdf->SetTextColor(0,0,255);
//  Multicell ( float(ancho), float(alto celda), "texto", border(0,1, T, B, R, L), align text( L, C, R), fill_fondo(true o false))
$pdf->MultiCell(0,5,$txt,1,'R',TRUE);
$pdf->Ln(5);


// ***********  seccion de Observaciones
$pdf->SetFont('Helvetica','',8);

$pdf->bgWhite();
$pdf->textDark();
$pdf->Cell($row_title,7,utf8_decode('   Observaciones Area Tecnica: '), $border_obs,0,'L',$fill_obs);
$pdf->Cell($row_details,7,utf8_decode(' '), $border_obs,1,'L',$fill_obs);

$pdf->Cell($row_title,7,utf8_decode('   Observaciones Area Adquisiciones: '), $border_obs,0,'L',$fill_obs);
$pdf->Cell($row_details,7,utf8_decode(' observaciones  '), $border_obs,1,'L',$fill_obs);

$pdf->Ln(20);

// ***********  seccion de aprobaciones
$pdf->SetFont('Helvetica','B',11);

	$align_text = "C";
	$border_firmas = 1;
	$fill_firmas = TRUE;
	$col = floor(($currentWidth/3));
	$leftMargin = $currentWidth - $col*2;

// // ********** Aprobacion area TECNICA
	$status_rev1 = "Aprobado";

	if($status_rev1 == "Aprobado") {
		$pdf->bgSuccess();
	} else {
		$pdf->bgDanger();
	}

$pdf->textWhite();
$pdf->Cell($leftMargin,10,utf8_decode(''),0,0,'C',FALSE);
$pdf->Cell($col,10,utf8_decode('Aprobado'), $border_firmas,0,'C',$fill_firmas);

// *********** Aprobacion area ADQUISICIONES
	$status_rev2 = "Aprobado1";

	if($status_rev2 == "Aprobado") {
		$pdf->bgSuccess();
	} else {
		$pdf->bgDanger();
	}

$pdf->textWhite();
$pdf->Cell($col,10,utf8_decode('Aprobado - Interno'), $border_firmas,1,'C',$fill_firmas);

// header TABLE AREA aprobaciones
$pdf->SetFont('Helvetica','',11);
$pdf->bgDark();
$pdf->textWhite();
$pdf->Cell($leftMargin,7,utf8_decode(''),0,0,'C',FALSE);
$pdf->Cell($col,7,utf8_decode('Rev. Area Tecnica: '), $border_firmas,0,'C',$fill_firmas);
$pdf->Cell($col,7,utf8_decode('Aprob. Area Adquisiciones: '), $border_firmas,1,'C',$fill_firmas);

// rows TABLE area aprobacioens
	$col_title = $col/3;
	$col_user = $col - $col_title;

$pdf->SetFont('Helvetica','',11);
$pdf->bgWhite();
$pdf->textDark();

$pdf->Cell($leftMargin,10,utf8_decode(''),0,0,'C',FALSE);
$pdf->Cell($col_title,10,utf8_decode('Nombre: '), $border_firmas,0,'L',$fill_firmas);
$pdf->Cell($col_user,10,utf8_decode(''), $border_firmas,0,'L',$fill_firmas);
$pdf->Cell($col_title,10,utf8_decode('Nombre: '), $border_firmas,0,'L',$fill_firmas);
$pdf->Cell($col_user,10,utf8_decode(' '), $border_firmas,1,'L',$fill_firmas);

$pdf->Cell($leftMargin,10,utf8_decode(''),0,0,'C',FALSE);
$pdf->Cell($col_title,10,utf8_decode('Fecha: '), $border_firmas,0,'L',$fill_firmas);
$pdf->Cell($col_user,10,utf8_decode(''), $border_firmas,0,'L',$fill_firmas);
$pdf->Cell($col_title,10,utf8_decode('Fecha: '), $border_firmas,0,'L',$fill_firmas);
$pdf->Cell($col_user,10,utf8_decode(' '), $border_firmas,0,'L',$fill_firmas);

$pdf->Ln($signatureSpace);



//  2do tipo de aprobaciones FILAS 

	$col = floor(($currentWidth/3));
	$leftMargin = $currentWidth - $col*2 +15;
	$align_text = "C";
	$border_firmas = 1;
	$fill_firmas = TRUE;

// row 1
	$col_title = $col/3;
	$col_user = $col - $col_title;

$pdf->SetFont('Helvetica','',9);
$pdf->bgNeutral();
$pdf->textDark();
$pdf->Cell($leftMargin,10,utf8_decode(''),0,0,'C',FALSE);
$pdf->Cell($col_title,10,utf8_decode('  Estado: '), $border_firmas,0,'L',$fill_firmas);

	// aprobacion 1
	$status_rev1 = "Aprobado";

	if($status_rev1 == "Aprobado") {
		$pdf->bgSuccess();
	} else {
		$pdf->bgDanger();
	}

$pdf->SetFont('Helvetica','',11);
$pdf->textWhite();
$pdf->Cell($col_user,10,utf8_decode('Aprobado'), $border_firmas,0,$align_text,$fill_firmas);
	
	// aprobacion 2
	$status_rev2 = "Aprobado1";

	if($status_rev2 == "Aprobado") {
		$pdf->bgSuccess();
	} else {
		$pdf->bgDanger();
	}
	
$pdf->SetFont('Helvetica','',11);
$pdf->textWhite();
$pdf->Cell($col_user,10,utf8_decode('Aprobado Interno'), $border_firmas,1,$align_text,$fill_firmas);

// row 2
$pdf->SetFont('Helvetica','',9);
$pdf->bgNeutral();
$pdf->textDark();
$pdf->Cell($leftMargin,8,utf8_decode(''),0,0,'C',FALSE);
$pdf->Cell($col_title,8,utf8_decode('  Revisado: '), $border_firmas,0,'L',$fill_firmas);

$pdf->bgWhite();
$pdf->textDark();
$pdf->Cell($col_user,8,utf8_decode(' Juan carlos'), $border_firmas,0,$align_text,$fill_firmas);
$pdf->Cell($col_user,8,utf8_decode(' Patricia Perez '), $border_firmas,1,$align_text,$fill_firmas);

// row 3
$pdf->bgNeutral();
$pdf->textDark();
$pdf->Cell($leftMargin,8,utf8_decode(''),0,0,'C',FALSE);
$pdf->Cell($col_title,8,utf8_decode('  Area: '), $border_firmas,0,'L',$fill_firmas);

$pdf->bgWhite();
$pdf->textDark();
$pdf->Cell($col_user,8,utf8_decode(' Tecnica'), $border_firmas,0,$align_text,$fill_firmas);
$pdf->Cell($col_user,8,utf8_decode(' Contabilidad'), $border_firmas,1,$align_text,$fill_firmas);

$pdf->Ln($signatureSpace);


// ******** seccion de la firma Gerente
	$signWidth = floor(($currentWidth/3));
	$leftMarginSign = $currentWidth - $signWidth;
	$signature = $pdf->insertSignature($currentWidth);

$pdf->Cell($leftMarginSign,null,$signature,0,1,'C', FALSE);
$pdf->Ln(10);


// Títulos de las columnas
$header = array('País', 'Capital', 'Superficie (km2)', 'Pobl. (en miles)');
// Carga de datos
$data = array('País', 'Capital', 'Superficie (km2)', 'Pobl. (en miles)');

$pdf->AddPage();
$pdf->BasicTable($header,$data);


// SetFont('Courier','',11);
// SetFillColor(224,51,71);
// SetTextColor(80, 150, 200);
// cell (float(ancho), float(alto), "texto", int(border 0 o 1) , linea sgte(0,1,2), text_align(L,C,R), fill_fondo_celda(true o false), string(enlace))
// Ln( float(altura)) medida en milimetros

$pdf->SetFont('Helvetica','B',16);
$pdf->SetFillColor(30,170,105);
$pdf->SetTextColor(255, 255, 255);
$pdf->Cell(72,10,'Ejemplo funcion Cell -',0,1,'L', TRUE);
$pdf->Ln(5);

// SetFont('Courier','',11);
// SetTextColor(80, 150, 200);
// Write ( float(alto de linea 0 = automatic), string (texto), string(enlace - opcional))
// Ln( float(altura)) medida en milimetros

$pdf->SetFont('Courier','',11);
$pdf->SetTextColor(0, 150, 200);
$pdf->Write(0,'ejemplo funcion Write - www.fpdf.org');
$pdf->Ln(5);

// $pdf->Output('D', $filename . '.pdf', true);
$pdf->Output();
?>