<?php 
class Pdf extends FPDF{
  
  protected $angle = 0;
  protected $bgNeutral = "#F4FBFB";
  protected $bgPrimary = "#04A7B5";
  protected $bgPrimaryLight = "#11E6FA";
  protected $bgDark = "#4F585D";
  protected $bgWhite = "#FFFFFF";
  protected $bgSuccess = "#1EAA69";
  protected $bgDanger = "#E25865";
  protected $textWhite = "#FFFFFF";
  protected $textDark = "#4F585D";

  function Header() {
    $header_img = URLROOT . '/img/header.png';
    $watermark = URLROOT . '/img/marco_agua.png';

    $this->Image($header_img,0,0,210,25,'PNG');
    $this->Image($watermark, 0, 40, 0, 0,'PNG');

    // $mt = 35;  //margin top
    // $header = $this->Image($header_img,0,0,0,0,'PNG');

    // $this->SetFont('Helvetica','', 11);
    // $this->SetTextColor(0,0,255);
    // $this->Cell(0,$mt,$header,0,0,'C');
    // $this->Cell(0,$mt,"numero",0,1,'C');
  }

  function Footer() {
    $footer_img = URLROOT . '/img/footer.png';

    // ******* agregar solo imagen como footer
    // $this->SetY(-25);
    // $this->Image($footer_img,-3);

    // ****** agregar imagen como footer y paginacion
    $footer = $this->Image($footer_img,0,285,210,12,'PNG');
    $ml = 15;
    $mr = 10;
    $mb = 20; //margin bottom = altura de celda paginacion

    $currentWidth = floor($this->GetPageWidth() - $ml - $mr);
    $col = floor(($currentWidth/3));
    $leftMargin = $currentWidth - $col*2;
    $fecha_hoy = date("d-m-Y");

    $this->SetY(-25);
    $this->SetFont('Helvetica','', 8);
    $this->textDark();
    $this->Cell($leftMargin,10,utf8_decode(''),0,0,'C',FALSE);
    $this->Cell($col,$mb,utf8_decode('Pág. ') . $this->PageNo() .'/{nb}',0,0,'C');
    $this->Cell($col,$mb,utf8_decode('Impreso el ') . $fecha_hoy,0,0,'R');
    $this->Cell(0,$mb,$footer,0,0,'C');
    $this->AliasNbPages(); // agrega numeracion de paginas 
  }

  function insertSignature($width) {
    $signWidth = floor(($width/3));
    $leftCorner = $signWidth*2 -10;
    $firma = URLROOT . '/img/firma.png';
    $this->Image($firma,$leftCorner,null,80,35);
  }

  function bgNeutral() {
    $color = $this->bgNeutral;
    $color = ltrim($color, '#');
    $split = str_split($color, 2);

    $r = hexdec($split[0]);
    $g = hexdec($split[1]);
    $b = hexdec($split[2]);

    return $this->SetFillColor($r,$g,$b);
  }

  function bgPrimary() {
    $color = $this->bgPrimary;
    $color = ltrim($color, '#');
    $split = str_split($color, 2);

    $r = hexdec($split[0]);
    $g = hexdec($split[1]);
    $b = hexdec($split[2]);

    return $this->SetFillColor($r,$g,$b);
  }

  function bgPrimaryLight() {
    $color = $this->bgPrimaryLight;
    $color = ltrim($color, '#');
    $split = str_split($color, 2);

    $r = hexdec($split[0]);
    $g = hexdec($split[1]);
    $b = hexdec($split[2]);

    // echo $color;
    // die();

    return $this->SetFillColor($r,$g,$b);
  }

  function bgDark() {
    $color = $this->bgDark;
    $color = ltrim($color, '#');
    $split = str_split($color, 2);

    $r = hexdec($split[0]);
    $g = hexdec($split[1]);
    $b = hexdec($split[2]);

    return $this->SetFillColor($r,$g,$b);
  }

  function bgWhite() {
    $color = $this->bgWhite;
    $color = ltrim($color, '#');
    $split = str_split($color, 2);

    $r = hexdec($split[0]);
    $g = hexdec($split[1]);
    $b = hexdec($split[2]);

    return $this->SetFillColor($r,$g,$b);
  }

  function bgSuccess() {
    $color = $this->bgSuccess;
    $color = ltrim($color, '#');
    $split = str_split($color, 2);

    $r = hexdec($split[0]);
    $g = hexdec($split[1]);
    $b = hexdec($split[2]);

    return $this->SetFillColor($r,$g,$b);
  }

  function bgDanger() {
    $color = $this->bgDanger;
    $color = ltrim($color, '#');
    $split = str_split($color, 2);

    $r = hexdec($split[0]);
    $g = hexdec($split[1]);
    $b = hexdec($split[2]);

    return $this->SetFillColor($r,$g,$b);
  }

  function textWhite() {
    $color = $this->textWhite;
    $color = ltrim($color, '#');
    $split = str_split($color, 2);

    $r = hexdec($split[0]);
    $g = hexdec($split[1]);
    $b = hexdec($split[2]);

    // echo $color;
    // die();
    return $this->SetTextColor($r,$g,$b);
  }

  function textDark() {
    $color = $this->textDark;
    $color = ltrim($color, '#');
    $split = str_split($color, 2);

    $r = hexdec($split[0]);
    $g = hexdec($split[1]);
    $b = hexdec($split[2]);
    // echo $color;
    // die();

    return $this->SetTextColor($r,$g,$b);
  }


// Image(Imagen.png, esquina_izq(eje X), ordenada_esq_izq(eje Y), ancho imagen( 0 = automatico), alto imagen(0 = automatic), tipo imagen) medidas en milimetros float

// colocar imagen de fondo / marco en toda  la pagina
// Image($watermark, 0, 0, $this->w, $this->h, 'PNG');


  function displayItems($data) {
    $rowTableHeight = 7;

    foreach($data as $row) {
      $this->SetFont('Helvetica','',8);
      $this->bgWhite();
      $this->textDark();
      $this->Cell(8,$rowTableHeight,$row->item, 1,0,'C',true);
      $this->Cell(10,$rowTableHeight,$row->unidad, 1,0,'C',true);
      $this->Cell(10,$rowTableHeight,$row->cantidad, 1,0,'C',true);
      $this->Cell(107,$rowTableHeight,'Viatico por 10 dias no imponible viaje a Peru ' . $row->descripcion, 1,0,'L',true);
      $this->Cell(30,$rowTableHeight,$row->proveedor, 1,0,'C',true);
      $this->Cell(20,$rowTableHeight,number_format($row->valor, 2, '.', ' ') . ' ', 1,1,'R',true);
    }
  }

  function displayFiles($data,$width) {
    $row_title = floor($width/5);
    $row_details = $width - $row_title;
    $border_obs = TRUE;
    $fill_obs = TRUE;

    foreach($data as $row) {
      $file = explode('/', $row->archivo);
      $file = '  ' . $file[4] . '   [click para ver archivo]';

      $this->SetFont('Helvetica','',9);
      $this->bgPrimary();
      $this->textWhite();
      $this->Cell($row_title,7,utf8_decode('Archivo Adjunto: '), $border_obs,0,'C',$fill_obs);

      $this->SetFont('Helvetica','',8);
      $this->bgWhite();
      $this->SetTextColor(0,0,255);
      $this->Cell($row_details,7,$file, $border_obs,1,'L',$fill_obs, URLROOT . $row->archivo);
    }
  }

  function displayLinks($data,$width) {
    $row_title = floor($width/5);
    $row_details = $width - $row_title;
    $border_obs = TRUE;
    $fill_obs = TRUE;

    foreach($data as $row) {
      $link = '  ' . $row;

      $this->SetFont('Helvetica','',9);
      $this->bgPrimary();
      $this->textWhite();
      $this->Cell($row_title,7,utf8_decode('Enlace Referencia: '), $border_obs,0,'C',$fill_obs);

      $this->SetFont('Helvetica','',8);
      $this->bgWhite();
      $this->SetTextColor(0,0,255);
      $this->Cell($row_details,7,$link, $border_obs,1,'L',$fill_obs, $row);
    }
  }

  function checkPurchase($data,$width) {
      $signatureSpace = 10;
      $numero_col = 2;
      $margin_r = 14;
      $col = floor(($width/3));
      $leftMargin = $width - $col*$numero_col + $margin_r;
      $align_text_aprob = "C";
      $border_firmas = 1;
      $fill_firmas = TRUE;

      // *********** COL 1
      $status_rev1 = $data->aprob_1;

      if($status_rev1 == "Aprobado") {
        $this->bgSuccess();
      } else {
        $this->bgDanger();
      }
    $this->SetFont('Helvetica','B',11);
    $this->textWhite();
    $this->Cell($leftMargin,10,utf8_decode(''),0,0,$align_text_aprob,FALSE);
    $this->Cell($col-10,10,$data->aprob_1, $border_firmas,0,$align_text_aprob,$fill_firmas);

      // ********* COL 2
      $status_rev2 = $data->aprob_2;

      if($status_rev2 == "Aprobado") {
        $this->bgSuccess();
      } else {
        $this->bgDanger();
      }

    $this->SetFont('Helvetica','B',12);
    $this->textWhite();
    $this->Cell($col-10,10,$data->aprob_2, $border_firmas,1,'C',$fill_firmas);


    // row1 AREA DE APROBACIONES
    $this->SetFont('Helvetica','B',11);
    $this->bgPrimary();
    $this->textWhite();
    $this->Cell($leftMargin,7,utf8_decode(''),0,0,'C',FALSE);
    $this->Cell($col-10,7,utf8_decode('Area Tecnica: '), $border_firmas,0,'C',$fill_firmas);
    $this->Cell($col-10,7,utf8_decode('Area Adquisiciones: '), $border_firmas,1,'C',$fill_firmas);

    // row 2 NOMBRE DE APROBACIONES
    $this->SetFont('Helvetica','',10);
    $this->bgWhite();
    $this->textDark();
    $this->Cell($leftMargin,10,utf8_decode(''),0,0,'C',FALSE);
    $this->Cell($col-10,10,$data->revisor_1, $border_firmas,0,$align_text_aprob,$fill_firmas);
    $this->Cell($col-10,10,$data->revisor_2, $border_firmas,1,$align_text_aprob,$fill_firmas);

    // row 3 FECHA DE APROB
    $this->SetFont('Helvetica','',8);
    $this->bgWhite();
    $this->textDark();
    $this->Cell($leftMargin,10,utf8_decode(''),0,0,'C',FALSE);
    $this->Cell($col-10,7,date("d-m-Y _ G:i", strtotime($data->fecha_aprob_1)), $border_firmas,0,$align_text_aprob,$fill_firmas);
    $this->Cell($col-10,7,date("d-m-Y _ G:i", strtotime($data->fecha_aprob_2)), $border_firmas,1,$align_text_aprob,$fill_firmas);

    $this->Ln($signatureSpace);
  }

  function checkFund($data,$width) {
      $signatureSpace = 10;
      $numero_col = 3;
      $margin_r = 24;
      $col = floor(($width/3));
      $leftMargin = $width - $col*$numero_col + $margin_r;
      $align_text_aprob = "C";
      $border_firmas = 1;
      $fill_firmas = TRUE;

      // *********** COL 1
      $status_rev1 = $data->aprob_1;

      if($status_rev1 == "Aprobado") {
        $this->bgSuccess();
      } else {
        $this->bgDanger();
      }
    $this->SetFont('Helvetica','B',11);
    $this->textWhite();
    $this->Cell($leftMargin,10,utf8_decode(''),0,0,$align_text_aprob,FALSE);
    $this->Cell($col-10,10,$data->aprob_1, $border_firmas,0,$align_text_aprob,$fill_firmas);

      // ********* COL 2
     $status_rev2 = $data->aprob_2;

     if($status_rev2 == "Aprobado") {
       $this->bgSuccess();
     } else {
       $this->bgDanger();
     }

    $this->SetFont('Helvetica','B',12);
    $this->textWhite();
    $this->Cell($col-10,10,$data->aprob_2, $border_firmas,0,'C',$fill_firmas);

      // ********* COL 3
      $status_rev2 = $data->aprob_3;

      if($status_rev2 == "Aprobado") {
        $this->bgSuccess();
      } else {
        $this->bgDanger();
      }

    $this->SetFont('Helvetica','B',12);
    $this->textWhite();
    $this->Cell($col-10,10,$data->aprob_3, $border_firmas,1,'C',$fill_firmas);


    // row1 AREA DE APROBACIONES
    $this->SetFont('Helvetica','B',11);
    $this->bgPrimary();
    $this->textWhite();
    $this->Cell($leftMargin,7,utf8_decode(''),0,0,'C',FALSE);
    $this->Cell($col-10,7,utf8_decode('Area Tecnica: '), $border_firmas,0,'C',$fill_firmas);
    $this->Cell($col-10,7,utf8_decode('Area Adquisiciones: '), $border_firmas,0,'C',$fill_firmas);
    $this->Cell($col-10,7,utf8_decode('Area Adquisiciones: '), $border_firmas,1,'C',$fill_firmas);

    // row 2 NOMBRE DE APROBACIONES
    $this->SetFont('Helvetica','',10);
    $this->bgWhite();
    $this->textDark();
    $this->Cell($leftMargin,10,utf8_decode(''),0,0,'C',FALSE);
    $this->Cell($col-10,10,$data->revisor_1, $border_firmas,0,$align_text_aprob,$fill_firmas);
    $this->Cell($col-10,10,$data->revisor_2, $border_firmas,0,$align_text_aprob,$fill_firmas);
    $this->Cell($col-10,10,$data->revisor_3, $border_firmas,1,$align_text_aprob,$fill_firmas);

    // row 3 FECHA DE APROB
    $this->SetFont('Helvetica','',8);
    $this->bgWhite();
    $this->textDark();
    $this->Cell($leftMargin,10,utf8_decode(''),0,0,'C',FALSE);
    $this->Cell($col-10,7,date("d-m-Y _ G:i", strtotime($data->fecha_aprob_1)), $border_firmas,0,$align_text_aprob,$fill_firmas);
    $this->Cell($col-10,7,date("d-m-Y _ G:i", strtotime($data->fecha_aprob_2)), $border_firmas,0,$align_text_aprob,$fill_firmas);
    $this->Cell($col-10,7,date("d-m-Y _ G:i", strtotime($data->fecha_aprob_3)), $border_firmas,1,$align_text_aprob,$fill_firmas);

    $this->Ln($signatureSpace);
  }

  function sumFunds($data) {
    $suma_fondos = 0;

    foreach($data as $row) {
      $suma_fondos += floatval($row->valor);
    }

    return number_format($suma_fondos, 2, '.', ' ');
  }

  



}

?>