<?php
    include_once '../includes/db_connect.php';
	include_once '../includes/functions.php';
 	include_once "lib/PHPExcel/PHPExcel.php";
 	include 'lib/PHPExcel/PHPExcel/Writer/Excel2007.php';
	sec_session_start();
	$xcod = leerParam("xcod","");

	$objPHPExcel = new PHPExcel();
	// Set properties
	$objPHPExcel->
    getProperties()
        ->setCreator("TEDnologia.com")
        ->setLastModifiedBy("TEDnologia.com")
        ->setTitle("Exportar Excel con PHP")
        ->setSubject("Documento de prueba")
        ->setDescription("Documento generado con PHPExcel")
        ->setKeywords("usuarios phpexcel")
        ->setCategory("reportes");

    $objPHPExcel->setActiveSheetIndex(0);
	$rowCount = 1;
	if ($stmt = $mysqli->prepare("SELECT	`m`.`id_matricula`,
																	`m`.`confirma_matricula`,
																	`m`.`fecha_matricula`,
																	`m`.`fecha_conf_matricula`,
																	`m`.`pago_matricula`,
																	`m`.`id_usuario`,
																	`u`.`nom_usuario`,
																	`u`.`apell_p_usuario`,
																	`u`.`apell_m_usuario`,
																	`u`.`email_usuario`,
																	`u`.`gmail_usuario`,
																	`d`.`nom_desc`,
																	`m`.`estado_matricula`,
																	`m`.`operacion_matricula`
															FROM `matricula` `m`, `usuario` `u`,  `grupos` `g`, `descuentos` `d`
															WHERE  `m`.`id_usuario`=`u`.`id_usuario` AND `m`.`id_grupos`=`g`.`id_grupo` AND `m`.`id_desc`=`d`.`id_desc` AND `id_grupos`= ? AND `confirma_matricula` = 'M';")) {
										$stmt->bind_param('i', $xcod);
										$stmt->execute();
										/* vincular variables a la sentencia preparada */
										$stmt->bind_result($xid, $confir,  $xfehora, $confir_matri, $xprecio , $xiduser, $xuser, $xuser_p , $xuser_m, $email, $gmail, $xdes, $xesta , $opera);
													
									while ($stmt->fetch()) {
										
										$xuser_p = strtoupper($xuser_p);
										$letra =substr($xuser_p,0,1);
										$temp = strlen($xuser_p);
										$temp = $xiduser*$temp;
										$temp = $letra.$temp;
										$passw = substr($temp, 0,5);
										$completo = $xuser." ".$xuser_p." ".$xuser_m;
										$completo =strtoupper($completo);
									    $objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, $xiduser); 
									    // Set cell Bn to the "age" column from the database (assuming you have a column called age)
									    //    where n is the Excel row number (ie cell A1 in the first row)
									    $objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, $confir); 
									    $objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount, $xprecio); 
									    $objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowCount, $completo); 
									    $objPHPExcel->getActiveSheet()->SetCellValue('E'.$rowCount, $email); 
									    $objPHPExcel->getActiveSheet()->SetCellValue('F'.$rowCount, $gmail); 
									    $objPHPExcel->getActiveSheet()->SetCellValue('G'.$rowCount, $passw); 
									    $objPHPExcel->getActiveSheet()->SetCellValue('H'.$rowCount, $xdes); 
									    $objPHPExcel->getActiveSheet()->SetCellValue('I'.$rowCount, $opera); 
									    $objPHPExcel->getActiveSheet()->SetCellValue('J'.$rowCount, $xesta); 
									    $objPHPExcel->getActiveSheet()->SetCellValue('K'.$rowCount, $xfehora);
									    $objPHPExcel->getActiveSheet()->SetCellValue('L'.$rowCount, $confir_matri);  

									    // Increment the Excel row counter
									    $rowCount++; 
									}
									// Instantiate a Writer to create an OfficeOpenXML Excel .xlsx file
										$objPHPExcel->getActiveSheet()->setTitle('Usuarios');
										$objPHPExcel->setActiveSheetIndex(0);
										header('Content-Type: application/vnd.ms-excel');
										header('Content-Disposition: attachment;filename="grupo_'.$xcod.'.xls"');
										header('Cache-Control: max-age=0');
										 
										$objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel5');
										$objWriter->save('php://output');
										exit;
										
								
									/* cerrar la sentencia */
									$stmt->close();
		
									$mysqli->close();
								}


?>