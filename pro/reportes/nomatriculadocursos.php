<?php
include_once '../../includes/db_connect.php';
include_once '../../includes/functions.php';
include_once "../lib/PHPExcel/PHPExcel.php";
include '../lib/PHPExcel/PHPExcel/Writer/Excel2007.php';
sec_session_start();
if (login_check($mysqli) == true ) {
	if ($_SESSION['permiso'] == 'A'){

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


    	$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:M1');
        $objPHPExcel->getActiveSheet()->setCellValue('A1', "Reporte de no matriculados en ningun curso");
        $objPHPExcel->getActiveSheet()->getStyle("A1")->getFont()->setBold(true);

        $objPHPExcel->getActiveSheet()->getStyle('A2:M2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $objPHPExcel->getActiveSheet()->getStyle('A2:M2')->getFill()->getStartColor()->setRGB('#0C6380');
        // Add some data
        $objPHPExcel->getActiveSheet()->getStyle("A2:M2")->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('A2:M2')->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);


        $objPHPExcel->setActiveSheetIndex(0);


        $style = array(
	        'alignment' => array(
	            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
	        )
	    );

	    $objPHPExcel->getActiveSheet()->getStyle("A1:M1")->applyFromArray($style);
	    $objPHPExcel->getActiveSheet()->getStyle("A1:M1")->getFont()->setSize(25);

	    $objPHPExcel->getActiveSheet()->getRowDimension(1)->setRowHeight(35);
        $objPHPExcel->getActiveSheet()->getRowDimension(2)->setRowHeight(35);



		//$objPHPExcel->getActiveSheet()->getColumnDimension('A')->etWidth(100);
		foreach(range('A','M') as $columnID) {
		    $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)
		        ->setAutoSize(true);
		}

	   	
		$objPHPExcel->getActiveSheet()->SetCellValue('A2', 'ID_USUARIO');
	    $objPHPExcel->getActiveSheet()->SetCellValue('B2', 'APELLIDO PATERNO'); 
	    $objPHPExcel->getActiveSheet()->SetCellValue('C2', 'APELLIDO MATERNO'); 
	    $objPHPExcel->getActiveSheet()->SetCellValue('D2', 'NOMBRES'); 
	    $objPHPExcel->getActiveSheet()->SetCellValue('E2', 'EMAIL'); 
	    $objPHPExcel->getActiveSheet()->SetCellValue('F2', 'NACIMIENTO'); 
	    $objPHPExcel->getActiveSheet()->SetCellValue('G2', 'EDAD'); 
	    $objPHPExcel->getActiveSheet()->SetCellValue('H2', 'SEXO'); 
	    $objPHPExcel->getActiveSheet()->SetCellValue('I2', 'TELEFONO'); 
	    $objPHPExcel->getActiveSheet()->SetCellValue('J2', 'OPERADOR'); 
	    $objPHPExcel->getActiveSheet()->SetCellValue('K2', 'DIRECCION'); 
	    $objPHPExcel->getActiveSheet()->SetCellValue('L2', 'PAIS');
	    $objPHPExcel->getActiveSheet()->SetCellValue('M2', 'CIUDAD'); 
		$rowCount = 3;

		$sql = "SELECT us.id_usuario, apell_p_usuario, apell_m_usuario, nom_usuario, email_usuario, naci_usuario, sexo_usuario, tel1_usuario, tel1_opera_usuario, direc_usuario, pais_usuario, ciudad_usuario FROM usuario us LEFT JOIN matricula mat ON us.id_usuario = mat.id_usuario WHERE mat.id_matricula IS NULL" ;

				if ($stmt = $mysqli->prepare($sql)) 
				{
					$stmt->execute();
					/* vincular variables a la sentencia preparada */
					$stmt->bind_result($xid,$apellido_paterno, $apellido_materno, $nombres, $email , $nacimiento, $sexo, $telefono, $operador, $direccion, $pais ,$ciudad);
					while ($stmt->fetch()) {

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


                    	$from = new DateTime($nacimiento);
						$to   = new DateTime('today');
						$edad = $from->diff($to)->y;


					    $objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, $xid); 
					    $objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, $apellido_paterno); 
					    $objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount, $apellido_materno); 
					    $objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowCount, $nombres); 
					    $objPHPExcel->getActiveSheet()->SetCellValue('E'.$rowCount, $email); 
					    $objPHPExcel->getActiveSheet()->SetCellValue('F'.$rowCount, $nacimiento); 
					    $objPHPExcel->getActiveSheet()->SetCellValue('G'.$rowCount, $edad); 
					    $objPHPExcel->getActiveSheet()->SetCellValue('H'.$rowCount, $sexo); 
					    $objPHPExcel->getActiveSheet()->SetCellValue('I'.$rowCount, $telefono); 
					    $objPHPExcel->getActiveSheet()->SetCellValue('J'.$rowCount, $operador); 
					    $objPHPExcel->getActiveSheet()->SetCellValue('K'.$rowCount, $direccion); 
					    $objPHPExcel->getActiveSheet()->SetCellValue('L'.$rowCount, $pais); 
					    $objPHPExcel->getActiveSheet()->SetCellValue('M'.$rowCount, $ciudad); 

			            $objPHPExcel->getActiveSheet()->getRowDimension($rowCount)->setRowHeight(15);

					    // Increment the Excel row counter
					    $rowCount++; 
					}
				}
				// Instantiate a Writer to create an OfficeOpenXML Excel .xlsx file
				$objPHPExcel->getActiveSheet()->setTitle('Reporte de no matriculados');
				$objPHPExcel->setActiveSheetIndex(0);
				header('Content-Type: application/vnd.ms-excel');
				header('Content-Disposition: attachment;filename="reportedenomatriculados'.$xfecha.'.xls"');
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