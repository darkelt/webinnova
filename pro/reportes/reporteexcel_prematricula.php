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
		$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'ID_USUARIO');
	    $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'CONFIR'); 
	    $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'FECHA'); 
	    $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'S/.SOLES'); 
	    $objPHPExcel->getActiveSheet()->SetCellValue('E1', '$ DOLARES'); 
	    $objPHPExcel->getActiveSheet()->SetCellValue('F1', 'NOMBRES'); 
	    $objPHPExcel->getActiveSheet()->SetCellValue('G1', 'EDAD'); 
	    $objPHPExcel->getActiveSheet()->SetCellValue('H1', 'EMAIL'); 
	    $objPHPExcel->getActiveSheet()->SetCellValue('I1', 'TELEFONO'); 
	    $objPHPExcel->getActiveSheet()->SetCellValue('J1', 'OPERADOR'); 
	    $objPHPExcel->getActiveSheet()->SetCellValue('K1', 'NOM DE GRUPO'); 
	    $objPHPExcel->getActiveSheet()->SetCellValue('L1', 'LOCALIDAD');
	    $objPHPExcel->getActiveSheet()->SetCellValue('M1', 'DECUENTO'); 
		$rowCount = 2;

				if ($stmt = $mysqli->prepare("SELECT  `m`.`id_matricula`,
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
                        `g`.`localidad`
					  FROM `matricula` `m`, `usuario` `u`,  `grupos` `g` ,  `pack` `p`
					  WHERE  `m`.`id_usuario` =  `u`.`id_usuario` 
					  AND  `m`.`id_grupos` = `g`.`id_grupo` 
                      AND `m`.`id_pack` = `p`.`id_pack`
					  AND `confirma_matricula`='x' 
					  AND  `estado_matricula`= 'a' 
                      UNION (SELECT  `m`.`id_matricula`,
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
										`d`.`nom_desc`,
										`d`.`descrip_desc`,
                                        `g`.`localidad`
				                      FROM `matricula` `m`, `usuario` `u`,  `grupos` `g`, `descuentos` `d`
				                      WHERE  `m`.`id_usuario` =  `u`.`id_usuario` 
				                      AND  `m`.`id_grupos` = `g`.`id_grupo` 
				                      AND `m`.`id_desc` = `d`.`id_desc` 
				                      AND `confirma_matricula`='x' 
				                      AND  `estado_matricula`= 'a')ORDER BY `fecha_matricula` DESC;")) 
				{
								$stmt->execute();
								/* vincular variables a la sentencia preparada */
								$stmt->bind_result($xid,$confir, $xfehora, $xprecio, $xprecio_dolar , $xiduser, $xuser, $xuser_m, $xuser_nom, $xuser_naci, $xuser_email ,$xuser_tel ,$xuser_telopera, $xidgrupo, $xgrupo, $xgrupo_des , $xdes,$local);
								while ($stmt->fetch()) {

									$completo = $xuser_nom." ".$xuser." ".$xuser_m;
									$completo =strtoupper($completo);
								    $objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, $xiduser); 
								    // Set cell Bn to the "age" column from the database (assuming you have a column called age)
								    //    where n is the Excel row number (ie cell A1 in the first row)
								    $objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, $confir); 
								    $objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount, $xfehora); 
								    $objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowCount, $xprecio); 
								    $objPHPExcel->getActiveSheet()->SetCellValue('E'.$rowCount, $xprecio_dolar); 
								    $objPHPExcel->getActiveSheet()->SetCellValue('F'.$rowCount, $completo); 
								    $objPHPExcel->getActiveSheet()->SetCellValue('G'.$rowCount, $xuser_naci); 
								    $objPHPExcel->getActiveSheet()->SetCellValue('H'.$rowCount, $xuser_email); 
								    $objPHPExcel->getActiveSheet()->SetCellValue('I'.$rowCount, $xuser_tel); 
								    $objPHPExcel->getActiveSheet()->SetCellValue('J'.$rowCount, $xuser_telopera); 
								    $objPHPExcel->getActiveSheet()->SetCellValue('K'.$rowCount, $xgrupo); 
								    $objPHPExcel->getActiveSheet()->SetCellValue('L'.$rowCount,  $local); 
								    $objPHPExcel->getActiveSheet()->SetCellValue('M'.$rowCount, $xgrupo_des.":".$xdes); 

								    // Increment the Excel row counter
								    $rowCount++; 
								}
							// Instantiate a Writer to create an OfficeOpenXML Excel .xlsx file
								$objPHPExcel->getActiveSheet()->setTitle('Pre-matriculados');
								$objPHPExcel->setActiveSheetIndex(0);
								header('Content-Type: application/vnd.ms-excel');
								header('Content-Disposition: attachment;filename="prematricula_'.$xfecha.'.xls"');
								header('Cache-Control: max-age=0');
								 
								$objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel5');
								$objWriter->save('php://output');
								exit;
								
						
							/* cerrar la sentencia */
								$stmt->close();

								$mysqli->close();
				}
	}
}								

?>