<?php include 'header.php';
if (login_check($mysqli) == true ) {
	if ($_SESSION['permiso'] == 'A'){
					?>	
<!---------------------------------------------------------- Hmtl Seguro-------------------------------------------------------------------------------->		
<div class="clear"><br><br></div>
<div id="fh5co-team-section">
				<div class="container">
					<?php include 'header_adm.php' ?> 
					<div class="container">
					<div class="row">
						<h4>Descripcion Matriculas</h4>
						<div class="col-md-5">
							<a href="adm_matricula_grupo.php" class="btn btn-primary" role="button">Grupos Matriculados</a>
							<?php echo "<a href='../reportes/reporteexcel_prematricula.php' class='btn btn-default'>Generar Reporte Excel</a>"; ?>
						</div>
						<div class="col-md-7">

		<?php

				$paginaActual = leerParam("pag","");
				if ($paginaActual == null){
					$paginaActual= 1;
				}



				if ($stmt = $mysqli->prepare("SELECT  `m`.`id_matricula`,
						`m`.`confirma_matricula`,
						`m`.`fecha_matricula`,
						`m`.`pago_matricula`,
						`m`.`pago_dolar_matricula`,
						`m`.`id_usuario`,
						`u`.`apell_p_usuario`,
						`u`.`apell_m_usuario`,
						`u`.`nom_usuario`,
						`m`.`id_grupos`,
						`g`.`nom_grupo`,
						`m`.`id_desc`,
						`m`.`estado_matricula`,
                        `p`.`nom_pack`
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
				                        `m`.`id_grupos`,
				                        `g`.`nom_grupo`,
				                        `d`.`nom_desc`,
				                        `m`.`estado_matricula`,
                                        `m`.`id_pack`
				                      FROM `matricula` `m`, `usuario` `u`,  `grupos` `g`, `descuentos` `d`
				                      WHERE  `m`.`id_usuario` =  `u`.`id_usuario` 
				                      AND  `m`.`id_grupos` = `g`.`id_grupo` 
				                      AND `m`.`id_desc` = `d`.`id_desc` 
				                      AND `confirma_matricula`='x' 
				                      AND  `estado_matricula`= 'a');")){
					$stmt->execute();
    				$stmt->store_result();
					$nroProductos = $stmt->num_rows;
				  }
				  echo "<h4>Existen ".$nroProductos." Pre-Matriculas</h4></div></div></div>";
					$stmt->close();
				    $nroLotes = 40;
				    $nroPaginas = ceil($nroProductos/$nroLotes);
				    $lista = '';
				    $tabla = '';
				  	if($paginaActual <= 1){
				  		$limit = 0;
				  	}else{
				  		$limit = $nroLotes*($paginaActual-1);
				  	}
				    echo'<table class="table table-striped table-condensed table-hover">
				                  <thead>
				                      <tr>
				                        <th>Id</th> 
				                        <th>Confirmar</th>
				                        <th>Fecha</th>
				                        <th>Soles</th>
				                        <th>Dolar</th>
				                        <th>Id U</th>
				                        <th>Usuario</th>
				                        <th>Id G</th>
				                        <th>Grupo</th>
				                        <th>Descuento</th>
				                        <th>Estado</th>
				                        <th>Acciones</th> 
				                      </tr> 
				                    </thead>';

				    if ($stmt = $mysqli->prepare("SELECT  `m`.`id_matricula`,
						`m`.`confirma_matricula`,
						`m`.`fecha_matricula`,
						`m`.`pago_matricula`,
						`m`.`pago_dolar_matricula`,
						`m`.`id_usuario`,
						`u`.`apell_p_usuario`,
						`u`.`apell_m_usuario`,
						`u`.`nom_usuario`,
						`m`.`id_grupos`,
						`g`.`nom_grupo`,
						`m`.`id_desc`,
						`m`.`estado_matricula`,
                        `p`.`nom_pack`,
                        `g`. `modalidad_grupo`
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
				                        `m`.`id_grupos`,
				                        `g`.`nom_grupo`,
				                        `d`.`nom_desc`,
				                        `m`.`estado_matricula`,
                                        `m`.`id_pack`,
                                        `g`. `modalidad_grupo`
				                      FROM `matricula` `m`, `usuario` `u`,  `grupos` `g`, `descuentos` `d`
				                      WHERE  `m`.`id_usuario` =  `u`.`id_usuario` 
				                      AND  `m`.`id_grupos` = `g`.`id_grupo` 
				                      AND `m`.`id_desc` = `d`.`id_desc` 
				                      AND `confirma_matricula`='x' 
				                      AND  `estado_matricula`= 'a')
				                      ORDER BY `fecha_matricula` DESC LIMIT ?, ?;")) {
				        $stmt->bind_param('ii',  $limit,$nroLotes );
				        $stmt->execute();
				        /* vincular variables a la sentencia preparada */
				        $stmt->bind_result($xid,$confir, $xfehora, $xprecio, $xprecio_dolar , $xiduser, $xuser, $xuser_m, $xuser_nom, $xidgrupo, $xgrupo, $xdes, $xesta, $pack , $moda);
				        /* obtener valores */
				      while ($stmt->fetch()) {
				        echo "<tr>
				              <td>$xid</td>                           
				              <td>$confir</td>";
				              
				              $nuevafecha = strtotime ( '+48 hour' , strtotime ( $xfehora ) ) ;
				              $xhoynuevo = strtotime ($xhoy);
				              if ($xhoynuevo >= $nuevafecha){
				                echo "<td style= 'color:red'>$xfehora </td>";
				              } else{
				                echo "<td>$xfehora</td>";
				              }   
				              
				              echo "<td>S/. $xprecio</td>
				              <td>$ $xprecio_dolar</td>
				              <td>$xiduser</td>
				              <td>$xuser $xuser_m $xuser_nom</td>
				              <td>$xidgrupo</td>
				              <td><a  href='adm_matricula_grupo.php?xcod=$xidgrupo&xnom=$xgrupo' >$xgrupo</a></td>
				              <td>";if(isset($xdes)){echo $xdes;}else{echo $pack;} echo"</td>
				              <td>$xesta -  $moda</td>
				              <td><a href='adm_matricula_validar.php?xcod=$xid' class='btn btn-default'>validar</a><a href='adm_matricula_grabar.php?tipo=x&xcod=$xid' class='btn btn-danger btn-xs'>quitar</a></td>
				            </tr>";
				      }

				      /* cerrar la sentencia */
				      $stmt->close();
				    }
				        
			
				 echo "</table> <center>
        			<ul class='pagination' id='pagination'>";
					if($paginaActual > 1){
					    	$Anterior = $paginaActual-1;
					        echo'<li><a href="adm_matricula.php?pag='.$Anterior.'">Anterior</a></li>';
				    }
				    for($i=1; $i<=$nroPaginas; $i++){
				        if($i == $paginaActual){
				            echo'<li class="active"><a href="adm_matricula.php?pag='.$i.'">'.$i.'</a></li>';
				        }else{
				            echo'<li><a href="adm_matricula.php?pag='.$i.'">'.$i.'</a></li>';
				        }
				    }
				    if($paginaActual < $nroPaginas){
				    	$Siguiente=$paginaActual+1;
				        echo'<li><a href="adm_matricula.php?pag='.$Siguiente.'">Siguiente</a></li>';
				    }
					?>
					</ul>
   					 </center>
				</div>
</div>													
<!---------------------------------------------------------- Hmtl Seguro-------------------------------------------------------------------------------->
 <?php }
			else { 
				header('Location: ../../login.php?error=2');
			} 
	} else { 

		header('Location: ../../login.php?error=3');
    } 
 include 'footer.php';?>		