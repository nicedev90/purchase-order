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
	$w_os = floor($currentWidth/4);
	$border_os = FALSE;
	$fill_os = TRUE;

$pdf->SetFont('Helvetica','UB',15);
$pdf->bgPrimary();
$pdf->textDark();
$pdf->Cell($w_os-10,8,utf8_decode(''), 0,0,'C');
$pdf->Cell($w_os+10,8,utf8_decode('Reporte :  ') . strtoupper($data['reporte'][0]->mina_nom) . ' - ' .  fixedMes($data['reporte'][0]->actualizado) . date(" Y"), 0,0,'C');
$pdf->Cell(20,8,utf8_decode(''), 0,0,'C');

$pdf->SetFont('Helvetica','',12);
$pdf->bgPrimary();
$pdf->textWhite();
$pdf->Cell($w_os/2,7,'', 0,0,'C', FALSE);
$pdf->Cell($w_os,7,strtoupper($pdf->setNameOs(strtoupper($data['reporte'][0]->tipo))), 0,1,'C', $fill_os);
$pdf->Ln($blockSpace);



// ******* seccion items de Orden de servicio
	$headerTableHeight = 8;

	if (strtoupper($data['reporte'][0]->tipo) == "COMPRA") {
		$pdf->SetFont('Helvetica','',9);
		$pdf->bgPrimary();
		$pdf->textWhite();
		$pdf->Cell(8,$headerTableHeight,utf8_decode('N°'), 1,0,'C',true);
		$pdf->Cell(10,$headerTableHeight,utf8_decode('Und.'), 1,0,'C',true);
		$pdf->Cell(10,$headerTableHeight,utf8_decode('Cant.'), 1,0,'C',true);
		$pdf->Cell(97,$headerTableHeight,utf8_decode('Descripcion'), 1,0,'C',true);
		$pdf->Cell(30,$headerTableHeight,utf8_decode('Proveedor'), 1,0,'C',true);
		$pdf->Cell(30,$headerTableHeight,utf8_decode('Valor Ref.'), 1,1,'C',true);

		$pdf->displayItemsReporteCompra($data['reporte']);
	} else {
		$pdf->SetFont('Helvetica','',9);
		$pdf->bgPrimary();
		$pdf->textWhite();
		$pdf->Cell(8,$headerTableHeight,utf8_decode('N°'), 1,0,'C',true);
		$pdf->Cell(55,$headerTableHeight,utf8_decode('Categoria'), 1,0,'C',true);
		$pdf->Cell(35,$headerTableHeight,utf8_decode('Creado por'), 1,0,'C',true);
		$pdf->Cell(25,$headerTableHeight,utf8_decode('Estado'), 1,0,'C',true);
		$pdf->Cell(25,$headerTableHeight,utf8_decode('Fecha'), 1,0,'C',true);
		$pdf->Cell(37,$headerTableHeight,utf8_decode('Monto'), 1,1,'C',true);

		$pdf->displayItemsReporteFondos($data['reporte']);

		$suma_fondos = $pdf->sumReporteFunds($data['reporte']);

		$pdf->Cell(8,$headerTableHeight,utf8_decode(''), 'T',0,'C');
		$pdf->Cell(55,$headerTableHeight,utf8_decode(''), 'T',0,'C');
		$pdf->Cell(35,$headerTableHeight,utf8_decode(''), 'T',0,'C');
		$pdf->Cell(25,$headerTableHeight,utf8_decode(''), 'T',0,'C');

		$pdf->SetFont('Helvetica','',8);
		$pdf->bgPrimary();
		$pdf->textWhite();
		$pdf->Cell(25,$headerTableHeight,utf8_decode('TOTAL'), 1,0,'C',true);

		$pdf->SetFont('Helvetica','',8);
		$pdf->bgWhite();
		$pdf->textDark();
		$pdf->Cell(37,$headerTableHeight,$suma_fondos . ' ', 1,1,'R',true);
	}

$pdf->Ln($osBlockSpace);



$filename = 'Reporte_' . $data['reporte'][0]->mina_nom;
// $pdf->Output('D', $filename . '.pdf', true);
$pdf->Output();
?>