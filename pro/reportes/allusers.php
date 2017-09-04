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
	        ->setKeywords("usuarios phpexcel")
	        ->setCategory("reportes");

	    $objPHPExcel->setActiveSheetIndex(0);
		$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'APLL PATERNO');
	    $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'APLL MATERNO'); 
	    $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'NOMBRES'); 
	    $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'EMAIL'); 
	    $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'FECHA DE NACI'); 
	    $objPHPExcel->getActiveSheet()->SetCellValue('F1', 'SEXO'); 
	    $objPHPExcel->getActiveSheet()->SetCellValue('G1', 'TELEFONO'); 
	    $objPHPExcel->getActiveSheet()->SetCellValue('H1', 'OPERADOR'); 
	    $objPHPExcel->getActiveSheet()->SetCellValue('I1', 'DIRECCION'); 
	    $objPHPExcel->getActiveSheet()->SetCellValue('J1', 'PAIS'); 
	    $objPHPExcel->getActiveSheet()->SetCellValue('K1', 'CIUDAD'); 
	    $objPHPExcel->getActiveSheet()->SetCellValue('L1', 'PERMISO'); 
	    $objPHPExcel->getActiveSheet()->SetCellValue('M1', 'GRADO ACADEMICO'); 
	    $objPHPExcel->getActiveSheet()->SetCellValue('N1', 'CENTRO DE ESTUDIOS'); 
	    $objPHPExcel->getActiveSheet()->SetCellValue('O1', 'GMAIL'); 
	    $objPHPExcel->getActiveSheet()->SetCellValue('P1', 'DNI'); 
	    $objPHPExcel->getActiveSheet()->SetCellValue('Q1', 'ID MATRICULA'); 
	    $objPHPExcel->getActiveSheet()->SetCellValue('R1', 'CONFIRMACION'); 
	    $objPHPExcel->getActiveSheet()->SetCellValue('S1', 'FECHA DE PREMATRICULA'); 
	    $objPHPExcel->getActiveSheet()->SetCellValue('T1', 'SOLES'); 
	    $objPHPExcel->getActiveSheet()->SetCellValue('U1', 'DOLARES'); 
	    $objPHPExcel->getActiveSheet()->SetCellValue('V1', 'IDUSER'); 
	    $objPHPExcel->getActiveSheet()->SetCellValue('W1', 'ID GRUPO'); 
	    $objPHPExcel->getActiveSheet()->SetCellValue('X1', 'NOMBREDEGRUPO'); 
	    $objPHPExcel->getActiveSheet()->SetCellValue('Y1', 'ID PROFESOR'); 
	    $objPHPExcel->getActiveSheet()->SetCellValue('Z1', 'ID HORARIO'); 
	    $objPHPExcel->getActiveSheet()->SetCellValue('AA1', 'ID CURSO'); 
	    $objPHPExcel->getActiveSheet()->SetCellValue('AB1', 'PRECIO REGULAR EN SOLES'); 
	    $objPHPExcel->getActiveSheet()->SetCellValue('AC1', 'PRECIO REGULAR EN DOLARES'); 
	    $objPHPExcel->getActiveSheet()->SetCellValue('AD1', 'TIPO DE CAMBIO'); 
	    $objPHPExcel->getActiveSheet()->SetCellValue('AE1', 'FECHA INI'); 
	    $objPHPExcel->getActiveSheet()->SetCellValue('AF1', 'DURACION GRUPO'); 
	    $objPHPExcel->getActiveSheet()->SetCellValue('AG1', 'MODALIDAD'); 
	    $objPHPExcel->getActiveSheet()->SetCellValue('AH1', 'DESCUENTO'); 
	    $objPHPExcel->getActiveSheet()->SetCellValue('AI1', 'DESCRIPCION'); 
	    $objPHPExcel->getActiveSheet()->SetCellValue('AJ1', 'FECHA CONF MATRICULA'); 
		$rowCount = 2;

				if ($stmt = $mysqli->prepare("SELECT 
											    `u`.`apell_p_usuario`,
											    `u`.`apell_m_usuario`,
											    `u`.`nom_usuario`,
											    `u`.`email_usuario`,
											    `u`.`naci_usuario`,
											    `u`.`sexo_usuario`,
											    `u`.`tel1_usuario`,
											    `u`.`tel1_opera_usuario`,
											    `u`.`direc_usuario`,
											    `u`.`pais_usuario`,

											    `u`.`ciudad_usuario`,
											    `u`.`permiso_usuario`,
											    `u`.`gr_academ_usuario`,
											    `u`.`centr_estu_usuario`,
											    `u`.`gmail_usuario`,
											    `u`.`dni_usuario`,
											    `m`.`id_matricula`,
											    `m`.`confirma_matricula`,
											    `m`.`fecha_matricula`,
											    `m`.`fecha_conf_matricula`,

											    `m`.`pago_matricula`,
											    `m`.`pago_dolar_matricula`,
											    `m`.`id_usuario`,
											    `g`.`id_grupo`,
											    `g`.`nom_grupo`,
											    `g`.`id_profesor`,
											    `g`.`id_horario`,
											    `g`.`id_cursos`,
											    `g`.`precio_curso_grupo`,
											    `g`.`precio_dolar_grupo`,
											    `g`.`tipo_cambio_grupo`,
											    `g`.`fecha_ini`,
											    `g`.`duracion_grupo`,
											    `g`.`modalidad_grupo`,
											    `d`.`nom_desc`,
											    `d`.`descrip_desc`

											FROM `usuario` `u`, `matricula` `m`, `grupos` `g` ,  `descuentos` `d` WHERE  `m`.`id_usuario` = `u`.`id_usuario` AND `m`.`id_grupos` = `g`.`id_grupo` AND `m`.`id_desc` = `d`.`id_desc`;
											")) 
				{
								$stmt->execute();
								/* vincular variables a la sentencia preparada */
								$stmt->bind_result($apell_m, $apell_p, $nom, $email, $naci, $sexo, $tel, $telopera, $dire, $pais,
												   $ciudad ,$permiso ,$grado, $centro, $gmail, $dni , $id_matri, $confir, $fecha,$fecha_conf,
						  $pago , $pago_dolar, $id_user, $id_grupo, $nom_grupo, $id_profesor,$id_horario, $id_curso,$precio_soles, $precio_dolar, $tc , $fecha_ini, $dura, $moda, $desc, $desc_d);
								while ($stmt->fetch()) {

								    $objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, $apell_m); 
								    $objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, $apell_p); 
								    $objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount, $nom); 
								    $objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowCount, $email); 
								    $objPHPExcel->getActiveSheet()->SetCellValue('E'.$rowCount, $naci); 
								    $objPHPExcel->getActiveSheet()->SetCellValue('F'.$rowCount, $sexo); 
								    $objPHPExcel->getActiveSheet()->SetCellValue('G'.$rowCount, $tel); 
								    $objPHPExcel->getActiveSheet()->SetCellValue('H'.$rowCount, $telopera); 
								    $objPHPExcel->getActiveSheet()->SetCellValue('I'.$rowCount, $dire); 
								    $objPHPExcel->getActiveSheet()->SetCellValue('J'.$rowCount, $pais); 
								    $objPHPExcel->getActiveSheet()->SetCellValue('K'.$rowCount, $ciudad); 
								    $objPHPExcel->getActiveSheet()->SetCellValue('L'.$rowCount, $permiso); 
								    $objPHPExcel->getActiveSheet()->SetCellValue('M'.$rowCount, $grado); 
								    $objPHPExcel->getActiveSheet()->SetCellValue('N'.$rowCount, $centro); 
								    $objPHPExcel->getActiveSheet()->SetCellValue('O'.$rowCount, $gmail); 
								    $objPHPExcel->getActiveSheet()->SetCellValue('P'.$rowCount, $dni); 
								    $objPHPExcel->getActiveSheet()->SetCellValue('Q'.$rowCount, $id_matri); 
								    $objPHPExcel->getActiveSheet()->SetCellValue('R'.$rowCount, $confir); 
								    $objPHPExcel->getActiveSheet()->SetCellValue('S'.$rowCount, $fecha); 
								    $objPHPExcel->getActiveSheet()->SetCellValue('T'.$rowCount, $pago); 
								    $objPHPExcel->getActiveSheet()->SetCellValue('U'.$rowCount, $pago_dolar); 
								    $objPHPExcel->getActiveSheet()->SetCellValue('V'.$rowCount, $id_user); 
								    $objPHPExcel->getActiveSheet()->SetCellValue('W'.$rowCount, $id_grupo); 
								    $objPHPExcel->getActiveSheet()->SetCellValue('X'.$rowCount, $nom_grupo); 
								    $objPHPExcel->getActiveSheet()->SetCellValue('Y'.$rowCount, $id_profesor); 
								    $objPHPExcel->getActiveSheet()->SetCellValue('Z'.$rowCount, $id_horario); 
								    $objPHPExcel->getActiveSheet()->SetCellValue('AA'.$rowCount, $id_curso); 
								    $objPHPExcel->getActiveSheet()->SetCellValue('AB'.$rowCount, $precio_soles); 
								    $objPHPExcel->getActiveSheet()->SetCellValue('AC'.$rowCount, $precio_dolar); 
								    $objPHPExcel->getActiveSheet()->SetCellValue('AD'.$rowCount, $tc); 
								    $objPHPExcel->getActiveSheet()->SetCellValue('AE'.$rowCount, $fecha_ini); 
								    $objPHPExcel->getActiveSheet()->SetCellValue('AF'.$rowCount, $dura); 
								    $objPHPExcel->getActiveSheet()->SetCellValue('AG'.$rowCount, $moda); 
								    $objPHPExcel->getActiveSheet()->SetCellValue('AH'.$rowCount, $desc); 
								    $objPHPExcel->getActiveSheet()->SetCellValue('AI'.$rowCount, $desc_d); 
								    $objPHPExcel->getActiveSheet()->SetCellValue('AJ'.$rowCount, $fecha_conf); 


								    // Increment the Excel row counter
								    $rowCount++; 
								}
							
				}
						if ($stmt = $mysqli->prepare("SELECT  
											`u`.`id_usuario`,
											`u`.`apell_p_usuario`,
										    `u`.`apell_m_usuario`,
										    `u`.`nom_usuario`,
										    `u`.`email_usuario`,
										    `u`.`naci_usuario`,
										    `u`.`sexo_usuario`,
										    `u`.`tel1_usuario`,
										    `u`.`tel1_opera_usuario`,
										    `u`.`direc_usuario`,
										    `u`.`pais_usuario`,
										    `u`.`ciudad_usuario`,
										    `u`.`permiso_usuario`,
										    `u`.`gr_academ_usuario`,
										    `u`.`centr_estu_usuario`,
										    `u`.`gmail_usuario`,
										    `u`.`dni_usuario`
										    FROM `usuario` `u` WHERE  `u`.`id_usuario` NOT IN( SELECT `id_usuario` FROM `matricula`);
											")) 
								{
								$stmt->execute();
								/* vincular variables a la sentencia preparada */
								$stmt->bind_result($id_user,$apell_m, $apell_p, $nom, $email, $naci, $sexo, $tel, $telopera, $dire, $pais,
												   $ciudad ,$permiso ,$grado, $centro, $gmail, $dni);
								
								while ($stmt->fetch()) {

								    $objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, $apell_m); 
								    $objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, $apell_p); 
								    $objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount, $nom); 
								    $objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowCount, $email); 
								    $objPHPExcel->getActiveSheet()->SetCellValue('E'.$rowCount, $naci); 
								    $objPHPExcel->getActiveSheet()->SetCellValue('F'.$rowCount, $sexo); 
								    $objPHPExcel->getActiveSheet()->SetCellValue('G'.$rowCount, $tel); 
								    $objPHPExcel->getActiveSheet()->SetCellValue('H'.$rowCount, $telopera); 
								    $objPHPExcel->getActiveSheet()->SetCellValue('I'.$rowCount, $dire); 
								    $objPHPExcel->getActiveSheet()->SetCellValue('J'.$rowCount, $pais); 
								    $objPHPExcel->getActiveSheet()->SetCellValue('K'.$rowCount, $ciudad); 
								    $objPHPExcel->getActiveSheet()->SetCellValue('L'.$rowCount, $permiso); 
								    $objPHPExcel->getActiveSheet()->SetCellValue('M'.$rowCount, $grado); 
								    $objPHPExcel->getActiveSheet()->SetCellValue('N'.$rowCount, $centro); 
								    $objPHPExcel->getActiveSheet()->SetCellValue('O'.$rowCount, $gmail); 
								    $objPHPExcel->getActiveSheet()->SetCellValue('P'.$rowCount, $dni); 
								    $objPHPExcel->getActiveSheet()->SetCellValue('V'.$rowCount, $id_user);

								    // Increment the Excel row counter
								    $rowCount++; 
								}
				}
				// Instantiate a Writer to create an OfficeOpenXML Excel .xlsx file
				$objPHPExcel->getActiveSheet()->setTitle('Pre-matriculados');
				$objPHPExcel->setActiveSheetIndex(0);
				header('Content-Type: application/vnd.ms-excel');
				header('Content-Disposition: attachment;filename="allusers_'.$xfecha.'.xls"');
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