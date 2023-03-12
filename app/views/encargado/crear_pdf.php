<?php 
$pdf = new Pdf;

	$mt = 30;
	$ml = 15; 
	$mr = 10;
	$currentWidth = floor($pdf->GetPageWidth() - $ml - $mr);
	$blockSpace = 8;
	$osBlockSpace = 3;

$pdf->SetMargins($ml,$mt,$mr);
$pdf->AddPage();

// ******* seccion TITULO de documento
	$w_os = floor($currentWidth/3);
	$w_os_type = $w_os/2;
	$border_os = FALSE;
	$fill_os = TRUE;

$pdf->SetFont('Helvetica','UB',15);
$pdf->bgPrimary();
$pdf->textDark();
$pdf->Cell($w_os,8,utf8_decode(''), 0,0,'C');
$pdf->Cell($w_os,8,utf8_decode('ORDEN DE SERVICIO N° 00') . $data['items'][0]->num_os . date(" - Y"), 0,0,'C');
$pdf->Cell(20,8,utf8_decode(''), 0,0,'C');

$pdf->SetFont('Helvetica','',12);
$pdf->bgPrimary();
$pdf->textWhite();
$pdf->Cell($w_os_type,7,utf8_decode('FONDOS'), 0,1,'C', $fill_os);
$pdf->Ln($blockSpace);

// ******* seccion detalles de ORden de servicio
	$w_title = floor($currentWidth/5);
	$w_details = $currentWidth - $w_title*3.5;
	$border_detalles = FALSE;
	$fill_detalles = TRUE;

$pdf->SetFont('Helvetica','',9);
$pdf->bgPrimary();
$pdf->textWhite();
$pdf->Cell($w_title,6,utf8_decode('  Solicitante'), $border_detalles,0,'L',$fill_detalles);
$pdf->bgNeutral();
$pdf->textDark();
$pdf->Cell($w_details,6,utf8_decode($data['items'][0]->nombre_user), $border_detalles,0,'C',$fill_detalles);

$pdf->bgPrimary();
$pdf->textWhite();
$pdf->Cell($w_title,6,utf8_decode('  Estado'), $border_detalles,0,'L',$fill_detalles);
$pdf->bgNeutral();
$pdf->textDark();
$pdf->Cell($w_details,6,utf8_decode($data['items'][0]->estado), $border_detalles,1,'C',$fill_detalles);

$pdf->Ln(1);

$pdf->bgPrimary();
$pdf->textWhite();
$pdf->Cell($w_title,6,utf8_decode('  Centro de costo'), $border_detalles,0,'L',$fill_detalles);
$pdf->bgNeutral();
$pdf->textDark();
$pdf->Cell($w_details,6,utf8_decode($data['items'][0]->nombre_mina), $border_detalles,0,'C',$fill_detalles);

$pdf->bgPrimary();
$pdf->textWhite();
$pdf->Cell($w_title,6,utf8_decode('  Categoria'), $border_detalles,0,'L',$fill_detalles);
$pdf->SetFillColor(244,251,251);
$pdf->textDark();
$pdf->Cell($w_details,6,$data['items'][0]->categ, $border_detalles,1,'C',$fill_detalles);

$pdf->Ln(1);

$pdf->bgPrimary();
$pdf->textWhite();
$pdf->Cell($w_title,6,utf8_decode('  Fecha Creacion'), $border_detalles,0,'L',$fill_detalles);
$pdf->bgNeutral();
$pdf->textDark();
$pdf->Cell($w_details,6,utf8_decode(fixedFecha($data['items'][0]->creado)), $border_detalles,0,'C',$fill_detalles);

$pdf->bgPrimary();
$pdf->textWhite();
$pdf->Cell($w_title,6,utf8_decode('  Fecha Actualizacion'), $border_detalles,0,'L',$fill_detalles);
$pdf->bgNeutral();
$pdf->textDark();
$pdf->Cell($w_details,6,utf8_decode(fixedFecha($data['items'][0]->acttualizado)), $border_detalles,1,'C',$fill_detalles);
$pdf->Ln(1);

$pdf->Ln($osBlockSpace);

// ******* seccion items de Orden de servicio
	$headerTableHeight = 8;

$pdf->SetFont('Helvetica','',9);
$pdf->bgPrimary();
$pdf->textWhite();
$pdf->Cell(8,$headerTableHeight,utf8_decode('N°'), 1,0,'C',true);
$pdf->Cell(10,$headerTableHeight,utf8_decode('Und.'), 1,0,'C',true);
$pdf->Cell(10,$headerTableHeight,utf8_decode('Cant.'), 1,0,'C',true);
$pdf->Cell(107,$headerTableHeight,utf8_decode('Descripcion'), 1,0,'C',true);
$pdf->Cell(30,$headerTableHeight,utf8_decode('Proveedor'), 1,0,'C',true);
$pdf->Cell(20,$headerTableHeight,utf8_decode('Valor Ref.'), 1,1,'C',true);

$pdf->displayItems($data['items']);

	if ($data['items'][0]->tipo == "Fondos") {

		$suma_fondos = $pdf->sumFunds($data['items']);

		$pdf->Cell(8,$headerTableHeight,utf8_decode(''), 'T',0,'C');
		$pdf->Cell(10,$headerTableHeight,utf8_decode(''), 'T',0,'C');
		$pdf->Cell(10,$headerTableHeight,utf8_decode(''), 'T',0,'C');
		$pdf->Cell(107,$headerTableHeight,utf8_decode(''), 'T',0,'C');

		$pdf->SetFont('Helvetica','',8);
		$pdf->bgPrimary();
		$pdf->textWhite();
		$pdf->Cell(30,$headerTableHeight,utf8_decode('TOTAL'), 1,0,'C',true);

		$pdf->SetFont('Helvetica','',8);
		$pdf->bgWhite();
		$pdf->textDark();
		$pdf->Cell(20,$headerTableHeight,$suma_fondos . ' ', 1,1,'R',true);
	}

$pdf->Ln($osBlockSpace);
	
	$refe = array('https://nicedev90.pro ', 'https://sodimac.com.pe/sodimac-pe/product/1163906/lana-de-vidrio-aislanglass-50mm/1163906/');

	if (count($refe) > 0) {
		$pdf->displayLinks($refe,$currentWidth);
	}

	if (count($data['adjuntos']) > 0) {
		$pdf->displayFiles($data['adjuntos'],$currentWidth);
	}

	$row_title = floor($currentWidth/3.5);
	$row_details = $currentWidth - $row_title;
	$border_obs = TRUE;
	$fill_obs = TRUE;

$pdf->Ln($blockSpace);

// ***********  seccion de Observaciones
$pdf->SetFont('Helvetica','',8);
$pdf->bgWhite();
$pdf->textDark();
$pdf->Cell($row_title,7,utf8_decode('   Observaciones Area Tecnica: '), $border_obs,0,'L',$fill_obs);
$pdf->Cell($row_details,7,utf8_decode(' '), $border_obs,1,'L',$fill_obs);

$pdf->Cell($row_title,7,utf8_decode('   Observaciones Area Adquisiciones: '), $border_obs,0,'L',$fill_obs);
$pdf->Cell($row_details,7,utf8_decode(' observaciones  '), $border_obs,1,'L',$fill_obs);

$pdf->Ln(15);

// ***********  seccion de aprobaciones
	if ($data['items'][0]->tipo == "Compra") {
		$pdf->checkPurchase($data['revision'][0],$currentWidth);
	} else {
		// Si el tipo es FONDO
		$pdf->checkFund($data['revision'][0],$currentWidth);
	}

// ******** seccion de la firma Gerente
	$signWidth = floor(($currentWidth/3));
	$leftMarginSign = $currentWidth - $signWidth*2;
	$signature = $pdf->insertSignature($currentWidth);

$pdf->Cell($leftMarginSign,null,$signature,0,1,'C', FALSE);

$filename = 'OS_n°_' . $data['items'][0]->num_os;
// $pdf->Output('D', $filename . '.pdf', true);
$pdf->Output();
?>