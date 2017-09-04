<?php
include_once '../../includes/db_connect.php';
include_once '../../includes/functions.php';
include_once "../lib/PHPExcel/PHPExcel.php";
include '../lib/PHPExcel/PHPExcel/Writer/Excel2007.php';
sec_session_start();
if (login_check($mysqli) == true ) {
	if ($_SESSION['permiso'] == 'A'){

		$id_pack = $_REQUEST['id_pack'];
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


    	$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:L1');
        $objPHPExcel->getActiveSheet()->setCellValue('A1', "Reporte de Matriculas");
        $objPHPExcel->getActiveSheet()->getStyle("A1")->getFont()->setBold(true);

        $objPHPExcel->getActiveSheet()->getStyle('A2:L2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $objPHPExcel->getActiveSheet()->getStyle('A2:L2')->getFill()->getStartColor()->setRGB('#0C6380');
        // Add some data
        $objPHPExcel->getActiveSheet()->getStyle("A2:L2")->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('A2:L2')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);


        $objPHPExcel->setActiveSheetIndex(0);


        $style = array(
	        'alignment' => array(
	            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
	        )
	    );

	    $objPHPExcel->getActiveSheet()->getStyle("A1:L1")->applyFromArray($style);
	    $objPHPExcel->getActiveSheet()->getStyle("A1:L1")->getFont()->setSize(25);

	    $objPHPExcel->getActiveSheet()->getRowDimension(1)->setRowHeight(35);
        $objPHPExcel->getActiveSheet()->getRowDimension(2)->setRowHeight(35);



		//$objPHPExcel->getActiveSheet()->getColumnDimension('A')->etWidth(100);
		foreach(range('A','L') as $columnID) {
		    $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)
		        ->setAutoSize(true);
		}

	   	
	   	$objPHPExcel->getActiveSheet()->SetCellValue('A2', 'PACK'); 
	   	$objPHPExcel->getActiveSheet()->SetCellValue('B2', 'MODALIDAD'); 
		$objPHPExcel->getActiveSheet()->SetCellValue('C2', 'ID_USUARIO');
	    $objPHPExcel->getActiveSheet()->SetCellValue('D2', 'CONFIRMACIÓN'); 
	    $objPHPExcel->getActiveSheet()->SetCellValue('E2', 'FECHA'); 
	    $objPHPExcel->getActiveSheet()->SetCellValue('F2', 'S/.SOLES'); 
	    $objPHPExcel->getActiveSheet()->SetCellValue('G2', '$ DOLARES'); 
	    $objPHPExcel->getActiveSheet()->SetCellValue('H2', 'NOMBRES'); 
	    $objPHPExcel->getActiveSheet()->SetCellValue('I2', 'EDAD'); 
	    $objPHPExcel->getActiveSheet()->SetCellValue('J2', 'EMAIL'); 
	    $objPHPExcel->getActiveSheet()->SetCellValue('K2', 'TELEFONO'); 
	    $objPHPExcel->getActiveSheet()->SetCellValue('L2', 'OPERADOR'); 
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
                     p.id_pack,
                     p.nom_pack,
                     p.fecha_ini,
                     p.modalidad,
                     p.factor_pack,
                     p.estado

                    FROM  matricula m
				LEFT JOIN grupos g
				ON  m.id_grupos = g.id_grupo
				LEFT JOIN pack p
				ON m.id_pack = p.id_pack
				LEFT JOIN descuentos d
				ON m.id_desc = d.id_desc 
				JOIN usuario u
				ON m.id_usuario =  u.id_usuario WHERE m.id_pack = $id_pack" ;

		if ($stmt = $mysqli->prepare($sql)) 
		{
			$stmt->execute();
			/* vincular variables a la sentencia preparada */
			$stmt->bind_result($xid,$confir, $xfehora, $xprecio, $xprecio_dolar , $xiduser, $xuser, $xuser_m, $xuser_nom, $xuser_naci, $xuser_email ,$xuser_tel ,$xuser_telopera, $id_pack , $nom_pack, $fecha_ini, $modalidad, $factor_pack, $estado);
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

            	$objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, $id_pack.":".$nom_pack.' ('.$fecha_ini.')'); 
            	$objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, $modalidad); 
			    $objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount, $xiduser); 
			    $objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowCount, $confir=="x" ? 'Prematricula' : 'Matriculado' ); 
			    $objPHPExcel->getActiveSheet()->SetCellValue('E'.$rowCount, $xfehora); 
			    $objPHPExcel->getActiveSheet()->SetCellValue('F'.$rowCount, $xprecio); 
			    $objPHPExcel->getActiveSheet()->SetCellValue('G'.$rowCount, $xprecio_dolar); 
			    $objPHPExcel->getActiveSheet()->SetCellValue('H'.$rowCount, $completo); 
			    $objPHPExcel->getActiveSheet()->SetCellValue('I'.$rowCount, $xuser_naci); 
			    $objPHPExcel->getActiveSheet()->SetCellValue('J'.$rowCount, $xuser_email); 
			    $objPHPExcel->getActiveSheet()->SetCellValue('K'.$rowCount, $xuser_tel); 
			    $objPHPExcel->getActiveSheet()->SetCellValue('L'.$rowCount, $xuser_telopera); 

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