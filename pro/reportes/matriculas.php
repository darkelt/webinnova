<?php
include_once '../../includes/db_connect.php';
include_once '../../includes/functions.php';
include_once "../lib/PHPExcel/PHPExcel.php";
include '../lib/PHPExcel/PHPExcel/Writer/Excel2007.php';
sec_session_start();
if (login_check($mysqli) == true ) {
	if ($_SESSION['permiso'] == 'A'){

		$periodo = $_REQUEST['periodo'];
		$filtrarfecha = isset($_REQUEST['filtrarfecha']) ? $_REQUEST['filtrarfecha']  : false;
		if ($periodo=="0") {
			if ($filtrarfecha=="1" or $filtrarfecha==true) {
				$fechainicio = $_REQUEST['fechainicio'];
				$fechafin = $_REQUEST['fechafin'];
			}
		}
		$confirma_matricula = $_REQUEST['confirma_matricula'];
		$estado_matricula = $_REQUEST['estado_matricula'];
		$id_grupo = $_REQUEST['id_grupo'];
		$ciudad = $_REQUEST['ciudad'];

		//																								echo $ciudad;

		//return;

		//echo $confirma_matricula;
		//return;

		$xfecha = date("Y-m-d");
		$objPHPExcel = new PHPExcel();
		// Set properties
		$objPHPExcel->
	    getProperties()
	        ->setCreator("innovatrainingperu.com")
	        ->setLastModifiedBy("innovatrainingperu.com")
	        ->setTitle("Reportes Innova")
	        ->setSubject("Documento")
	        ->setDescription("Documento generado con PHPExcel")
	        ->setKeywords("Matriculas phpexcel")
	        ->setCategory("reportes");


    	$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:N1');
        $objPHPExcel->getActiveSheet()->setCellValue('A1', "Reporte de Matriculas");
        $objPHPExcel->getActiveSheet()->getStyle("A1")->getFont()->setBold(true);

        $objPHPExcel->getActiveSheet()->getStyle('A2:N2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $objPHPExcel->getActiveSheet()->getStyle('A2:N2')->getFill()->getStartColor()->setRGB('#0C6380');
        // Add some data
        $objPHPExcel->getActiveSheet()->getStyle("A2:N2")->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('A2:N2')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);


        $objPHPExcel->setActiveSheetIndex(0);


        $style = array(
	        'alignment' => array(
	            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
	        )
	    );

	    $objPHPExcel->getActiveSheet()->getStyle("A1:N1")->applyFromArray($style);
	    $objPHPExcel->getActiveSheet()->getStyle("A1:N1")->getFont()->setSize(25);

	    $objPHPExcel->getActiveSheet()->getRowDimension(1)->setRowHeight(35);
        $objPHPExcel->getActiveSheet()->getRowDimension(2)->setRowHeight(35);



		//$objPHPExcel->getActiveSheet()->getColumnDimension('A')->etWidth(100);
		foreach(range('A','O') as $columnID) {
		    $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)
		        ->setAutoSize(true);
		}

	   	
		$objPHPExcel->getActiveSheet()->SetCellValue('A2', 'ID_USUARIO');
	    $objPHPExcel->getActiveSheet()->SetCellValue('B2', 'CONFIRMACIÓN'); 
	    $objPHPExcel->getActiveSheet()->SetCellValue('C2', 'FECHA'); 
	    $objPHPExcel->getActiveSheet()->SetCellValue('D2', 'S/.SOLES'); 
	    $objPHPExcel->getActiveSheet()->SetCellValue('E2', '$ DOLARES'); 
	    $objPHPExcel->getActiveSheet()->SetCellValue('F2', 'NOMBRES'); 
	    $objPHPExcel->getActiveSheet()->SetCellValue('G2', 'EDAD'); 
	    $objPHPExcel->getActiveSheet()->SetCellValue('H2', 'EMAIL'); 
	    $objPHPExcel->getActiveSheet()->SetCellValue('I2', 'TELEFONO'); 
	    $objPHPExcel->getActiveSheet()->SetCellValue('J2', 'OPERADOR'); 
	    $objPHPExcel->getActiveSheet()->SetCellValue('K2', 'NOM DE GRUPO'); 
	    $objPHPExcel->getActiveSheet()->SetCellValue('L2', 'LOCALIDAD');
	    $objPHPExcel->getActiveSheet()->SetCellValue('M2', 'PACK'); 
	    $objPHPExcel->getActiveSheet()->SetCellValue('N2', 'DESCUENTO'); 
	    $objPHPExcel->getActiveSheet()->SetCellValue('O2', 'NUMERO DE OPERACION'); 
		$rowCount = 3;

		$sql = "SELECT 
					`m`.`id_matricula`,
					`m`.`confirma_matricula`,
					`m`.`fecha_matricula`,
					`m`.`pago_matricula`,
					`m`.`pago_dolar_matricula`,
					`m`.`id_usuario`,
					`u`.`apell_p_usuario`,
					`u`.`apell_m_usuario`,
					`u`.`nom_usuario`,
					`u`.`naci_usuario`,
					`u`.`email_usuario`,
					`u`.`tel1_usuario`,
					`u`.`tel1_opera_usuario`,
					`m`.`id_grupos`,
					`g`.`nom_grupo`,
                    `p`.`id_pack`,
                    `p`.`nom_pack`,
                     d.nom_desc,
					 d.descrip_desc,
					 d.factor_desc,
                    `g`.`localidad`,
                    `m`.`operacion_matricula`

                    FROM  matricula m
				LEFT JOIN grupos g
				ON  m.id_grupos = g.id_grupo
				LEFT JOIN pack p
				ON m.id_pack = p.id_pack
				LEFT JOIN descuentos d
				ON m.id_desc = d.id_desc 
				JOIN usuario u
				WHERE m.id_usuario =  u.id_usuario " ;

        if ($confirma_matricula=="all"){
        	
        } else if ($confirma_matricula == "M") {
        	$sql .= " AND confirma_matricula='M' ";
        } else if ($confirma_matricula == "x") {
        	$sql .= " AND confirma_matricula='x' ";
        }

        if ($estado_matricula=="all"){
        } else if ($estado_matricula == "a") {
        	$sql .= " AND estado_matricula='a' ";
        } else if ($estado_matricula == "x") {
        	$sql .= " AND estado_matricula='x' ";
        }

		if ($periodo!="0"){
        	$sql .= " AND MONTH(fecha_matricula)= $periodo ";
        } else {
        	if ($filtrarfecha=="1" or $filtrarfecha==true){
        		$sql .= " AND fecha_matricula BETWEEN '$fechainicio' AND '$fechafin' ";
        	}
        }

        if ($id_grupo!="all"){
        	$sql .= " AND id_grupos = $id_grupo ";	
        }

        if ($ciudad!="all"){
        	$sql .= " AND ciudad_usuario = '$ciudad' ";	
        } 


		if ($stmt = $mysqli->prepare($sql)) 
		{
			$stmt->execute();
			/* vincular variables a la sentencia preparada */
			$stmt->bind_result($xid,$confir, $xfehora, $xprecio, $xprecio_dolar , $xiduser, $xuser, $xuser_m, $xuser_nom, $xuser_naci, $xuser_email ,$xuser_tel ,$xuser_telopera, $xidgrupo, $xgrupo, $id_pack , $nom_pack,$nom_desc, $descrip_desc, $factor_desc, $localidad,$operacion);
			while ($stmt->fetch()) {

				$completo = $xuser_nom." ".$xuser." ".$xuser_m;
				$completo =strtoupper($completo);


				$objPHPExcel->getActiveSheet()->getStyle('A'.$rowCount.'')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $objPHPExcel->getActiveSheet()->getStyle('B'.$rowCount.'')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $objPHPExcel->getActiveSheet()->getStyle('C'.$rowCount.'')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $objPHPExcel->getActiveSheet()->getStyle('D'.$rowCount.'')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $objPHPExcel->getActiveSheet()->getStyle('E'.$rowCount.'')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $objPHPExcel->getActiveSheet()->getStyle('F'.$rowCount.'')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $objPHPExcel->getActiveSheet()->getStyle('G'.$rowCount.'')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $objPHPExcel->getActiveSheet()->getStyle('H'.$rowCount.'')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $objPHPExcel->getActiveSheet()->getStyle('I'.$rowCount.'')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $objPHPExcel->getActiveSheet()->getStyle('J'.$rowCount.'')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $objPHPExcel->getActiveSheet()->getStyle('K'.$rowCount.'')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $objPHPExcel->getActiveSheet()->getStyle('L'.$rowCount.'')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $objPHPExcel->getActiveSheet()->getStyle('M'.$rowCount.'')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
            $objPHPExcel->getActiveSheet()->getStyle('N'.$rowCount.'')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
             $objPHPExcel->getActiveSheet()->getStyle('O'.$rowCount.'')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

			    $objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, $xiduser); 
			    $objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, $confir=="x" ? 'Prematricula' : 'Matriculado' ); 
			    $objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount, $xfehora); 
			    $objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowCount, $xprecio); 
			    $objPHPExcel->getActiveSheet()->SetCellValue('E'.$rowCount, $xprecio_dolar); 
			    $objPHPExcel->getActiveSheet()->SetCellValue('F'.$rowCount, $completo); 
			    $objPHPExcel->getActiveSheet()->SetCellValue('G'.$rowCount, $xuser_naci); 
			    $objPHPExcel->getActiveSheet()->SetCellValue('H'.$rowCount, $xuser_email); 
			    $objPHPExcel->getActiveSheet()->SetCellValue('I'.$rowCount, $xuser_tel); 
			    $objPHPExcel->getActiveSheet()->SetCellValue('J'.$rowCount, $xuser_telopera); 
			    $objPHPExcel->getActiveSheet()->SetCellValue('K'.$rowCount, $xgrupo); 
			    $objPHPExcel->getActiveSheet()->SetCellValue('L'.$rowCount, $localidad); 
			    $objPHPExcel->getActiveSheet()->SetCellValue('M'.$rowCount, $id_pack.":".$nom_pack); 
			    $objPHPExcel->getActiveSheet()->SetCellValue('N'.$rowCount, $nom_desc.":".$factor_desc); 
			    $objPHPExcel->getActiveSheet()->SetCellValue('O'.$rowCount, $operacion);
	            $objPHPExcel->getActiveSheet()->getRowDimension($rowCount)->setRowHeight(15);

			    // Increment the Excel row counter
			    $rowCount++; 
			}
		}
		// Instantiate a Writer to create an OfficeOpenXML Excel .xlsx file
		$objPHPExcel->getActiveSheet()->setTitle('Reporte de matriculas');
		$objPHPExcel->setActiveSheetIndex(0);
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="reportedematriculas_'.$xfecha.'.xls"');
		header('Cache-Control: max-age=0');
		 
		$objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel5');
		$objWriter->save('php://output');
		exit;
		

	/* cerrar la sentencia */
		$stmt->close();
		$mysqli->close();
	}
}								
?>