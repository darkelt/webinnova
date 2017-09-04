<?php
header("Content-Type: text/html;charset=utf-8");
if ($_POST["generar_factura"] == "true")
{
  function leerParam($param, $default) {
     if ( isset($_POST["$param"] ) ){
        return $_POST["$param"];
     }   
     if ( isset($_GET["$param"] ) ){
        return $_GET["$param"];
    }else{
     return $default; 
    }
  }
			$xnomcomple = leerParam("pnom","");
			$xuser = leerParam("puser","");
			$xcurso = leerParam("pcurso","");
			$pagom = leerParam("ppagon","");
			$pagom_dolar = leerParam("ppagon_dolar","");
			$xmoda = leerParam("pmoda","");
			$xfini = leerParam("pfini","");
			$xfecha =leerParam("pfecha",""); 
			$xlocal = leerParam("xlocal","");
			$idgrupo = leerParam("idgrupo","");
		//variable que guarda el nombre del archivo PDF
		$archivo="ORDEN-PAGO-INNOVA.pdf";

		//Llama	    $cuenta = da al script fpdf

	    

	    if($idgrupo == 345 || $idgrupo == 346){

	    	$cuenta = "215-22953949002 (Ramiro Ayala)";
	    }else{
	    	$cuenta = "215-2269160-0-24";

	    }


		require('fpdf181/fpdf.php');
				
				
			class PDF extends FPDF
			{
				// Page header
				function Header()
				{
					// Logo
					$this->Image('../images/logon.jpg',10,6,50);
					// Arial bold 15
					$this->SetFont('Arial','B',15);
					// Move to the right
					$this->Cell(80);
					// Title
					$this->Cell(50,10,'ORDEN DE PAGO',1,0,'C');
					// Line break
					$this->Ln(20);
					
				}
		
			}

			if($xlocal=="local"){
				 $monto = "S/.".$pagom; 
			}else {
			 	$monto = "$.".$pagom_dolar;
			} 
			
			// Instanciation of inherited class
			$pdf = new PDF();
			$pdf->AliasNbPages();
			$pdf->AddPage('L','A5');
			
			$pdf->SetFont('Arial','B',20);
			$pdf->Cell(190, 10, $xnomcomple, 0, 2, "C");
			$pdf->SetFont('Arial','',10);
			$pdf->MultiCell(190,5, "Fecha: $xfecha", 0, "C", false);
			$pdf->SetFont('Arial','B',20);
			$pdf->Ln(1);
			$pdf->Cell(190, 10, $xuser, 0, 2, "C");
			$pdf->Ln(1);
			
			$top_datos = 51;
			
			$y1=$top_datos;
			$x1=10;
			$top_sig = 10;
			$tamanon = 12;
			$tamanob = 13;
			$pdf->SetXY($x1,$top_datos);
			$pdf->SetFont('Arial','B',$tamanon);
			if ($xlocal == "nolocal" ){ $pdf->Cell(250, 15, "ENVIO:",0, "J", false); }
			else{ $pdf->Cell(250, 15, "CUENTA BCP:",0, "J", false);}
			$y1= $y1+15;
			$pdf->SetXY($x1,$y1);
			$pdf->SetFont('Arial','B',$tamanon);
			$pdf->Cell(250, 15, "MONTO:",0, "J", false);
			$y1= $y1 +15;
			$pdf->SetXY($x1,$y1);
			$pdf->SetFont('Arial','B',$tamanon);
			$pdf->Cell(250, 15, "COD. DE MATRICULA:",0, "J", false);
		
			// -----------------------------------------------------
			
			$y1=$top_datos;
			$x1=55;
			$top_sig = 10;
			$tamanon = 12;
			$tamanob = 13;
			$pdf->SetXY($x1,$top_datos);
			$pdf->SetFont('Arial','',$tamanon);
			if($xlocal=="nolocal"){$pdf->Cell(250, 15, "Western U./Money G",0, "J", false);}
			else{$pdf->Cell(250, 15, $cuenta,0, "J", false);}
			$pdf->Cell(250, 15, $cuenta,0, "J", false);
			$y1= $y1+15;
			$pdf->SetXY($x1,$y1);
			$pdf->SetFont('Arial','',$tamanon);
			$pdf->Cell(250, 15, $monto ,0, "J", false);
			$y1= $y1 +15;
			$pdf->SetXY($x1,$y1);
			$pdf->SetFont('Arial','',$tamanon);
			$pdf->Cell(250, 15, "    ".$xuser,0, "J", false);
			
			
			$y1=$top_datos;
			$x1=100;
			$top_sig = 10;
			$tamanon = 12;
			$tamanob = 13;
			$pdf->SetXY($x1,$top_datos);
			$pdf->SetFont('Arial','B',$tamanon);
			$pdf->Cell(250, 15, "CURSO:",0, "J", false);
			$y1= $y1+15;
			$pdf->SetXY($x1,$y1);
			$pdf->SetFont('Arial','B',$tamanon);
			$pdf->Cell(250, 15, "MODALIDAD: ",0, "J", false);
			$y1= $y1 +15;
			$pdf->SetXY($x1,$y1);
			$pdf->SetFont('Arial','B',$tamanon);
			$pdf->Cell(250, 15, "INICIO:",0, "J", false);
			
			 
			 
			$y1=$top_datos;
			$x1=130;
			$top_sig = 10;
			$tamanon = 12;
			$tamanob = 13;
			$pdf->SetXY($x1,$top_datos);
			$pdf->SetFont('Arial','',$tamanon);
			$pdf->Cell(0, 15, $xcurso,0, 'L', false);
			$y1= $y1+15;
			$pdf->SetXY($x1,$y1);
			$pdf->SetFont('Arial','',$tamanon);
			$pdf->Cell(50, 15, $xmoda,0, "J", false);
			$y1= $y1 +15;
			$pdf->SetXY($x1,$y1);
			$pdf->SetFont('Arial','',$tamanon);
			$pdf->Cell(50, 15, $xfini,0, "J", false);
			
			
			if ($xlocal == "nolocal"){
				
				
			$texto11 = utf8_decode("El depósito se hará a una persona natural.");
			$texto12 = utf8_decode("DATOS: Nombre: Cynthia Lizbeth Vilca Llerena (Asesora de Capacitación)/  DNI: 73076089 .");
			$texto13 = utf8_decode("DIRECCIÓN: Nombre: Calle Ibáñez 102, Urbanización María Isabel Cercado- Arequipa - Perú/  Telefono: 993655595 .");
			$texto1 = utf8_decode("Recuerde seguir los siguientes pasos para confirmar su matrícula:");
			$texto2 = utf8_decode("1. Enviar su boucher de pago escaneado al correo: cursos@innovatrainingperu.com, indicando su código de matrícula y datos personales.");
			$texto3 = utf8_decode("2. Recibirá un correo de confirmación de matricula.");
			$texto4 = utf8_decode("* Debe realizar el pago de su matrícula en las 24 horas siguientes, caso contrario se anulara su pre-matricula .");
			
			
			
			$y1= $y1 +13;
			$pdf->SetXY(10,$y1);
			$pdf->SetFont('Arial','B',9);
			$pdf->Cell(500, 5, $texto11,0, "J", false);
			$y1= $y1 +5;
			$pdf->SetXY(10,$y1);
			$pdf->SetFont('Arial','',9);
			$pdf->Cell(500, 5, $texto12,0, "J", false);
			$y1= $y1 +5;
			$pdf->SetXY(10,$y1);
			$pdf->SetFont('Arial','',9);
			$pdf->Cell(500, 5, $texto13,0, "J", false);
			$y1= $y1 +5;
			$pdf->SetXY(10,$y1);
			$pdf->SetFont('Arial','',8);
			$pdf->Cell(500, 5, $texto1,0, "J", false);
			$y1= $y1 +4;
			$pdf->SetXY(10,$y1);
			$pdf->SetFont('Arial','',8);
			$pdf->Cell(500, 5,$texto2 ,0, "J", false);
			$y1= $y1 +4;
			$pdf->SetXY(10,$y1);
			$pdf->SetFont('Arial','',8);
			$pdf->Cell(500, 5,$texto3,0, "J", false);
			$y1= $y1 +4;
			$pdf->SetXY(10,$y1);
			$pdf->SetFont('Arial','I',8);
			$pdf->Cell(500, 5,$texto4,0, "J", false);
			
			}else{
				
			$texto1 = utf8_decode("Recuerde seguir los siguientes pasos para confirmar su matrícula:");
			$texto2 = utf8_decode("1. Enviar su boucher de pago escaneado al correo: cursos@innovatrainingperu.com, indicando su código de matrícula y datos personales.");
			$texto3 = utf8_decode("2. Recibirá un correo de confirmación de matricula.");
			$texto4 = utf8_decode("* Debe realizar el pago de su matrícula en las 24 horas siguientes, caso contrario se anulara su pre-matricula .");
			
			
			
			$y1= $y1 +18;
			$pdf->SetXY(10,$y1);
			$pdf->SetFont('Arial','B',8);
			$pdf->Cell(500, 5, $texto1,0, "J", false);
			$y1= $y1 +5;
			$pdf->SetXY(10,$y1);
			$pdf->SetFont('Arial','',8);
			$pdf->Cell(500, 5,$texto2 ,0, "J", false);
			$y1= $y1 +5;
			$pdf->SetXY(10,$y1);
			$pdf->SetFont('Arial','',8);
			$pdf->Cell(500, 5,$texto3,0, "J", false);
			$y1= $y1 +5;
			$pdf->SetXY(10,$y1);
			$pdf->SetFont('Arial','I',8);
			$pdf->Cell(500, 5,$texto4,0, "J", false);
			}
			
			$pdf->Output('orden-pago-innova.pdf','D');
		//$pdf->Output(	);

}
?>