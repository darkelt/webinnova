<?php   

function correoConfirmacion($email_user, $xnomcomple, $xuser , $xcurso, $pagom, $pagom_dolar, $xmoda, $xfini , $xlocal , $iddes){

  require_once 'class.phpmailer.php';
  require_once 'class.smtp.php';

  //Create a new PHPMailer instance

  //Create a new PHPMailer instance
  $mail = new PHPMailer;
  //Set who the message is to be sent from
  $mail->setFrom('cursos@innovatrainingperu.com', 'Innova Training Center');
  //Set an alternative reply-to address
  $mail->addReplyTo('cursos@innovatrainingperu.com', 'Innova Training Center');
  //Set who the message is to be sent to
  $cuenta = "215-2269160-0-24";

  if ($xlocal=="local"){
      $message = '<!DOCTYPE html>
                <html>
                  <head>
                    <style>
                      @media only screen and (max-device-width: 480px) {
                        /* mobile-specific CSS styles go here */
                      }
                    </style>
                  </head>
                  <body>
                    <div style="margin: 5px 0 0 0; padding: 0; background-color: #f3f3f3;" bgcolor="#f3f3f3">
                      <table border="0" cellspacing="0" cellpadding="0" width="100%" bgcolor="#f3f3f3" style="color: #4a4a4a; font-family: "Museo Sans Rounded",Museo Sans Rounded, "Museo Sans",Museo Sans, "Helvetica Neue" ,Helvetica,Arial,sans-serif; font-size: 14px; line-height: 20px; border-collapse: callapse; border-spacing: 0; margin: 0 auto;">
                        <tbody>
                          <tr>
                            <td style="padding-left: 10px; padding-right: 10px;">
                              <table border="0" cellspacing="0" cellpadding="0" align="center" width="100%" style="width: 100%; margin: 0 auto; max-width: 600px;">
                                <tbody>
                                  <tr style="height: 98px;">
                                    <td style="text-align: center; padding-top: 3%; height: 98px;"><a style="text-decoration: none;" target="_blank"> <img src="http://innovatrainingperu.com/images/mailimg/OP/header.jpg" alt="innova training center" width="100%" style="display: block; margin: 0; border: 0; max-width: 600px;" /> </a></td>
                                  </tr>
                                  <tr style="height: 518px;">
                                    <td bgcolor="#ffffff" style="background-color: #ffffff; padding: 9%; height: 518px;">
                                      <table border="0" cellspacing="0" cellpadding="0" style="width: 100%;">
                                        <tbody>
                                          <tr style="height: 40px;">
                                            <td style="padding-bottom: 20px; line-height: 20px; height: 40px;"><img src="http://innovatrainingperu.com/images/mailimg/OP/orden.jpg" alt="orden de pago" width="100%" style="display: block; margin: 0; border: 0; max-width: 600px;" /></td>
                                          </tr>
                                          <tr style="height: 40px;">
                                            <td style="padding-bottom: 20px; line-height: 20px; height: 40px;">
                                              <div style="border-bottom: 2px solid #eeeeee; text-align: center;"><span style="font-family: tahoma, arial, helvetica, sans-serif; font-size: 14pt;"><strong>'.$xnomcomple.'</strong></span></div>
                                            </td>
                                          </tr>
                                          <tr style="height: 10px;">
                                            <td style="background-color: #ffffff; height: 10px;">
                                              <table style="width: 100%;">
                                                <tbody>
                                                  <tr style="height: 43px;">
                                                    <td style="width: 50%; height: 43px;">
                                                      <ul>
                                                        <li><span style="color: #999999; font-size: 10pt;"><span style="color: #999999; font-size: 10pt;"><strong>Cuenta BCP <br /> <span style="color: #000000;">'.$cuenta.'</span></strong></span></span></li>
                                                      </ul>
                                                    </td>
                                                    <td style="width: 50%; height: 43px;">
                                                      <ul>
                                                        <li><span style="color: #999999; font-size: 10pt;"><strong>Curso<br /><span style="color: #000000;">'.$xcurso.'</span></strong></span></li>
                                                      </ul>
                                                    </td>
                                                  </tr>
                                                  <tr style="height: 43px;">
                                                    <td style="width: 50%; height: 43px;">
                                                      <ul>
                                                        <li><span style="color: #999999; font-size: 10pt;"><strong>Monto <br /> <span style="color: #000000;">S/.'.$pagom.'</span></strong></span></li>
                                                      </ul>
                                                    </td>
                                                    <td style="width: 50%; height: 43px;">
                                                      <ul>
                                                        <li><span style="color: #999999; font-size: 10pt;"><strong>Modalidad<br /> <span style="color: #000000;">'.$xmoda.'</span></strong></span></li>
                                                      </ul>
                                                    </td>
                                                  </tr>
                                                  <tr style="height: 43px;">
                                                    <td style="width: 50%; height: 43px;">
                                                      <ul>
                                                        <li><span style="color: #999999; font-size: 10pt;"><strong>Código de Matricula<br /> <span style="color: #000000;">'.$xuser.'</span></strong></span></li>
                                                      </ul>
                                                    </td>
                                                    <td style="width: 50%; height: 43px;">
                                                      <ul>
                                                        <li><span style="color: #999999; font-size: 10pt;"><strong>Inicio<br /> <span style="color: #000000;">'.$xfini.'</span></strong></span></li>
                                                      </ul>
                                                    </td>
                                                  </tr>
                                                  <tr style="height: 43px;">
                                                    <td style="width: 50%; height: 43px;" colspan="2">
                                                      <p><span style="font-size: 8pt; color: #999999;"><strong>Recuerde seguir los siguientes pasos para confirmar su matrícula:</strong></span></p>
                                                      <ol>
                                                        <li style="font-size: 6pt;"><span style="font-size: 8pt; color: #000000;">Enviar su boucher de pago escaneado al correo: cursos@innovatrainingperu.com, indicando su código de matrícula y datos personales.</span></li>
                                                        <li style="font-size: 6pt;"><span style="font-size: 8pt; color: #000000;">Recibirá un correo de confirmación de matricula.</span></li>
                                                      </ol>
                                                    </td>
                                                  </tr>
                                                </tbody>
                                              </table>
                                            </td>
                                          </tr>
                                        </tbody>
                                      </table>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td style="font-size: 0px;"><img src="https://ci4.googleusercontent.com/proxy/12NavqvSN1hipJtW6jogbG-zfKUhYCZjDSwkLBnPuQyH-7sDTvvk_KSCFwFFnO99M0vWmNnd2JF-8gdyE0BCHPthUJWCqGCKoQ1zy3A=s0-d-e1-ft#http://static.duolingo.com/images/email/2014/bottom.png" width="100%" style="display: block;" /> </td>
                                  </tr>
                                  <tr style="height: 150px;">
                                    <td style="padding: 20px; width: 554px; height: 150px;">
                                      <div style="margin: 0px; font-size: 12px; color: #bbbbbb; text-align: center;">Encuentranos:</div>
                                      <br />
                                      <div style="margin: 0px; font-size: 12px; color: #bbbbbb; text-align: center;"><a href="https://www.facebook.com/innovatraining/" target="_blank"><img src="http://innovatrainingperu.com/images/mailimg/OP/FB.jpg" alt="facebook" width="25" height="25" /></a>   <a href="https://www.youtube.com/channel/UC_v5IPrU7f27xflWiveLhHQ" target="_blank"><img src="http://innovatrainingperu.com/images/mailimg/OP/Youtube.jpg" alt="youtubeinnvova" width="25" height="25" /></a> </div>
                                      <br />
                                      <div style="margin: 0px; font-size: 12px; color: #bbbbbb; text-align: center;">© 2016 Innova Training Center</div>
                                      <div style="margin: 0px; font-size: 11px; color: #bbbbbb; text-align: center;">Arequipa - Perú<br />Calle Ibañez #102 Urb. María Isabel, Cercado Arequipa</div>
                                    </td>
                                  </tr>
                                </tbody>
                              </table>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </body>
                </html>
                </tbody>
                </table>
                </div>
                </div>
                </body>
                </html>';
    }else{
      $cuenta = "Western Union/Money G";
      $message = '<!DOCTYPE html>
      <html>
        <head>
          <style>
            @media only screen and (max-device-width: 480px) {
              /* mobile-specific CSS styles go here */
            }
          </style>
        </head>
        <body>
          <div style="margin: 5px 0 0 0; padding: 0; background-color: #f3f3f3;" bgcolor="#f3f3f3">
            <table border="0" cellspacing="0" cellpadding="0" width="100%" bgcolor="#f3f3f3" style="color: #4a4a4a;" museo="" sans="" rounded="" helvetica="" neue="" arial="" sans-serif="" font-size:="" 14px="" line-height:="" 20px="" border-collapse:="" callapse="" border-spacing:="" 0="" margin:="" auto="">
              <tbody>
                <tr>
                  <td style="padding-left: 10px; padding-right: 10px;">
                    <table border="0" cellspacing="0" cellpadding="0" align="center" width="100%" style="width: 100%; margin: 0 auto; max-width: 600px;">
                      <tbody>
                        <tr style="height: 98px;">
                          <td style="text-align: center; padding-top: 3%; height: 98px;"><a style="text-decoration: none;" target="_blank"> <img src="http://innovatrainingperu.com/images/mailimg/OP/header.jpg" alt="innova training center" width="100%" style="display: block; margin: 0; border: 0; max-width: 600px;" /> </a></td>
                        </tr>
                        <tr style="height: 518px;">
                          <td bgcolor="#ffffff" style="background-color: #ffffff; padding: 9%; height: 518px;">
                            <table border="0" cellspacing="0" cellpadding="0" style="width: 100%;">
                              <tbody>
                                <tr style="height: 40px;">
                                  <td style="padding-bottom: 20px; line-height: 20px; height: 40px;"><img src="http://innovatrainingperu.com/images/mailimg/OP/orden.jpg" alt="orden de pago" width="100%" style="display: block; margin: 0; border: 0; max-width: 600px;" /></td>
                                </tr>
                                <tr style="height: 40px;">
                                  <td style="padding-bottom: 20px; line-height: 20px; height: 40px;">
                                    <div style="border-bottom: 2px solid #eeeeee; text-align: center;"><span style="font-family: tahoma, arial, helvetica, sans-serif; font-size: 14pt;"><strong>'.$xnomcomple.'</strong></span></div>
                                  </td>
                                </tr>
                                <tr style="height: 10px;">
                                  <td style="background-color: #ffffff; height: 10px;">
                                    <table style="width: 100%;">
                                      <tbody>
                                        <tr style="height: 43px;">
                                          <td style="width: 50%; height: 43px;">
                                            <ul>
                                              <li><span style="color: #999999; font-size: 10pt;"><span style="color: #999999; font-size: 10pt;"><strong>Envio <br /> <span style="color: #000000;">'.$cuenta.'</span></strong></span></span></li>
                                            </ul>
                                          </td>
                                          <td style="width: 50%; height: 43px;">
                                            <ul>
                                              <li><span style="color: #999999; font-size: 10pt;"><strong>Curso<br /><span style="color: #000000;">'.$xcurso.'</span></strong></span></li>
                                            </ul>
                                          </td>
                                        </tr>
                                        <tr style="height: 43px;">
                                          <td style="width: 50%; height: 43px;">
                                            <ul>
                                              <li><span style="color: #999999; font-size: 10pt;"><strong>Monto <br /> <span style="color: #000000;">$.'.$pagom_dolar.'</span></strong></span></li>
                                            </ul>
                                          </td>
                                          <td style="width: 50%; height: 43px;">
                                            <ul>
                                              <li><span style="color: #999999; font-size: 10pt;"><strong>Modalidad<br /> <span style="color: #000000;">'.$xmoda.'</span></strong></span></li>
                                            </ul>
                                          </td>
                                        </tr>
                                        <tr style="height: 43px;">
                                          <td style="width: 50%; height: 43px;">
                                            <ul>
                                              <li><span style="color: #999999; font-size: 10pt;"><strong>Código de Matricula<br /> <span style="color: #000000;">'.$xuser.'</span></strong></span></li>
                                            </ul>
                                          </td>
                                          <td style="width: 50%; height: 43px;">
                                            <ul>
                                              <li><span style="color: #999999; font-size: 10pt;"><strong>Inicio<br /> <span style="color: #000000;">'.$xfini.'</span></strong></span></li>
                                            </ul>
                                          </td>
                                        </tr>
                                        <tr>
                                          <td style="width: 50%; height: 43px;" colspan="2">
                                            <p><strong><span style="font-size: 8pt; color: #999999;">El depósito se hará a una persona natural.</span></strong></p>
                                            <ul>
                                              <li><strong style="font-size: 8pt;">Nombre:</strong> Cynthia Lizbeth Vilca Llerena (Asesora de Capacitación)</li>
                                              <li><strong style="font-size: 8pt;">DNI:</strong> 73076089</li>
                                              <li><strong style="font-size: 8pt;">Dirección:</strong>  Calle Ibáñez 102, Urbanización María Isabel Cercado- Arequipa - Perú</li>
                                              <li><strong style="font-size: 8pt;">Teléfono: </strong> 993655595</strong></li>
                                            </ul>
                                          </td>
                                        </tr>
                                        <tr style="height: 43px;">
                                          <td style="width: 50%; height: 43px;" colspan="2">
                                            <p><span style="font-size: 8pt; color: #999999;"><strong>Recuerde seguir los siguientes pasos para confirmar su matrícula:</strong></span></p>
                                            <ol>
                                              <li style="font-size: 6pt;"><span style="font-size: 8pt; color: #000000;">Enviar su boucher de pago escaneado al correo: cursos@innovatrainingperu.com, indicando su código de matrícula y datos personales.</span></li>
                                              <li style="font-size: 6pt;"><span style="font-size: 8pt; color: #000000;">Recibirá un correo de confirmación de matricula.</span></li>
                                            </ol>
                                          </td>
                                        </tr>
                                      </tbody>
                                    </table>
                                  </td>
                                </tr>
                              </tbody>
                            </table>
                          </td>
                        </tr>
                        <tr>
                          <td style="font-size: 0px;"><img src="https://ci4.googleusercontent.com/proxy/12NavqvSN1hipJtW6jogbG-zfKUhYCZjDSwkLBnPuQyH-7sDTvvk_KSCFwFFnO99M0vWmNnd2JF-8gdyE0BCHPthUJWCqGCKoQ1zy3A=s0-d-e1-ft#http://static.duolingo.com/images/email/2014/bottom.png" width="100%" style="display: block;" /> </td>
                        </tr>
                        <tr style="height: 150px;">
                          <td style="padding: 20px; width: 554px; height: 150px;">
                            <div style="margin: 0px; font-size: 12px; color: #bbbbbb; text-align: center;">Encuentranos:</div>
                            <br />
                            <div style="margin: 0px; font-size: 12px; color: #bbbbbb; text-align: center;"><a href="https://www.facebook.com/innovatraining/" target="_blank"><img src="http://innovatrainingperu.com/images/mailimg/OP/FB.jpg" alt="facebook" width="25" height="25" /></a>   <a href="https://www.youtube.com/channel/UC_v5IPrU7f27xflWiveLhHQ" target="_blank"><img src="http://innovatrainingperu.com/images/mailimg/OP/Youtube.jpg" alt="youtubeinnvova" width="25" height="25" /></a> </div>
                            <br />
                            <div style="margin: 0px; font-size: 12px; color: #bbbbbb; text-align: center;">© 2016 Innova Training Center</div>
                            <div style="margin: 0px; font-size: 11px; color: #bbbbbb; text-align: center;">Arequipa - Perú<br />Calle Ibañez #102 Urb. María Isabel, Cercado Arequipa</div>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </body>
      </html>
      </tbody>
      </table>
      </div>
      </div>
      </body>
</html>';
    }
    $mail->addAddress($email_user, $xnomcomple);
    $mail->Subject = 'CONFIRMACION DE PRE-INSCRIPCION';
    $mail->msgHTML($message);
    $mail->AltBody = 'Se trata de un cuerpo de mensaje de texto sin formato, contactar a cursos@innovatrainingperu.com';
    if (!$mail->send()) {
      return false;
    } else {
      return true;
    }
}
function correoMatricula($fech_matri,$pago,$id_u,$nom_u, $apll_p, $apll_m, $email_user, $id_g, $nom_g, $fech_ini ,$moda ,$nom_d, $gmail,$turno, $horario){


  require_once 'class.phpmailer.php';
  require_once 'class.smtp.php';

  //Create a new PHPMailer instance

  //Create a new PHPMailer instance
  $mail = new PHPMailer;
  //Set who the message is to be sent from
  $mail->setFrom('cursos@innovatrainingperu.com', 'Innova Training Center');
  //Set an alternative reply-to address
  $mail->addReplyTo('cursos@innovatrainingperu.com', 'Innova Training Center');


    $id_g = utf8_encode($id_g);
      $nombre = $nom_u." ".$apll_p." ".$apll_m;
    $nombre = strtoupper($nombre);  
    if($moda=='V'){
      $findme   = '@gmail.com';
      $pos = strpos($email_user , $findme);
      if ($pos == true) {
        $gmail = $email_user;
      }
      $apll_p = strtoupper($apll_p);
      $pri = substr($apll_p,0,1);
      $temp = strlen($apll_p);
      $temp = $id_u*$temp;
      $temp = $pri.$temp;
      $clave = substr($temp, 0,5);
      
      $htmlmensaje = '<!DOCTYPE html>
<html>
  <head>
    <style>
      @media only screen and (max-device-width: 480px) {
        /* mobile-specific CSS styles go here */
      }
    </style>
  </head>
  <body>
    <div style="margin: 5px 0 0 0; padding: 0; background-color: #f3f3f3;" bgcolor="#f3f3f3">
      <table border="0" cellspacing="0" cellpadding="0" width="100%" bgcolor="#f3f3f3" style="color: #4a4a4a;" museo="" sans="" rounded="" helvetica="" neue="" arial="" sans-serif="" font-size:="" 14px="" line-height:="" 20px="" border-collapse:="" callapse="" border-spacing:="" 0="" margin:="" auto="">
        <tbody>
          <tr>
            <td style="padding-left: 10px; padding-right: 10px;">
              <table border="0" cellspacing="0" cellpadding="0" align="center" width="100%" style="width: 100%; margin: 0 auto; max-width: 600px;">
                <tbody>
                  <tr style="height: 98px;">
                    <td style="text-align: center; padding-top: 3%; height: 98px;"><a style="text-decoration: none;" target="_blank"> <img src="http://innovatrainingperu.com/images/mailimg/OP/headerm.jpg" alt="innova training center" width="100%" style="display: block; margin: 0; border: 0; max-width: 600px;" /> </a></td>
                  </tr>
                  <tr style="height: 518px;">
                    <td bgcolor="#ffffff" style="background-color: #ffffff; padding: 9%; height: 518px;">
                      <table border="0" cellspacing="0" cellpadding="0" style="width: 100%;">
                        <tbody>
                          <tr style="height: 40px;">
                            <td style="padding-bottom: 20px; line-height: 20px; height: 40px;"><img src="http://innovatrainingperu.com/images/mailimg/OP/confirmacion.jpg" alt="orden de pago" width="100%" style="display: block; margin: 0; border: 0; max-width: 600px;" /></td>
                          </tr>
                          <tr style="height: 40px;">
                            <td style="padding-bottom: 20px; line-height: 20px; height: 40px;">
                              <div style="border-bottom: 2px solid #eeeeee; text-align: center;"><span style="font-family: tahoma, arial, helvetica, sans-serif; font-size: 14pt;"><strong>'.$nombre.'</strong></span></div>
                            </td>
                          </tr>
                          <tr style="height: 10px;">
                            <td style="background-color: #ffffff; height: 10px;">
                              <table style="width: 100%;">
                                <tbody>
                                  <tr style="height: 43px;">
                                    <td style="width: 50%; height: 43px;" colspan="2">
                                      <p><strong><span style="font-size: 8pt; color: #999999;">Estas inscrito correctamente en:</span></strong></p>
                                      <ul>
                                        <li><strong style="font-size: 8pt;">Curso: </strong>'.$nom_g.'</li>
                                        <li><strong style="font-size: 8pt;">Codigo de matricula: </strong>'.$id_u.'</li>
                                        <li><strong style="font-size: 8pt;">Modalidad: </strong>Virtual </li>
                                      </ul>
                                    </td>
                                  </tr>
                                  <tr style="height: 43px;">
                                    <td style="width: 50%; height: 43px;" colspan="2">
                                      <p><span style="font-size: 8pt; color: #999999;"><strong>Acceda a nuestro Campus Virtual:</strong></span></p>
                                      <p> <a href="http://innovatrainingperu.com/campusinnova/login/" target="_blank"><img src="http://innovatrainingperu.com/images/mailimg/OP/botoncampus.jpg" alt="boton campus innova" style="display: block; margin-left: auto; margin-right: auto;" /></a></p>
                                      <ul>
                                        <li><strong style="font-size: 8pt;">Usuario: </strong>'.$email_user.'</li>
                                        <li><strong style="font-size: 8pt;">Constraseña: </strong>'.$clave.'</li>
                                      </ul>
                                    </td>
                                  </tr>
                                  <tr style="height: 43px;">
                                    <td style="width: 50%; height: 43px; font-size: 7pt;" colspan="2">
                                      <p><i>* Hemos creado este curso para ti, pero recuerda, la constancia y el compromiso, son necesarios.<br />¡Que tengas un excelente curso!.</i></p>
                                    </td>
                                  </tr>
                                </tbody>
                              </table>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </td>
                  </tr>
                  <tr>
                    <td style="font-size: 0px;"><img src="https://ci4.googleusercontent.com/proxy/12NavqvSN1hipJtW6jogbG-zfKUhYCZjDSwkLBnPuQyH-7sDTvvk_KSCFwFFnO99M0vWmNnd2JF-8gdyE0BCHPthUJWCqGCKoQ1zy3A=s0-d-e1-ft#http://static.duolingo.com/images/email/2014/bottom.png" width="100%" style="display: block;" /> </td>
                  </tr>
                  <tr style="height: 150px;">
                    <td style="padding: 20px; width: 554px; height: 150px;">
                      <div style="margin: 0px; font-size: 12px; color: #bbbbbb; text-align: center;">Encuentranos:</div>
                      <br />
                      <div style="margin: 0px; font-size: 12px; color: #bbbbbb; text-align: center;"><a href="https://www.facebook.com/innovatraining/" target="_blank"><img src="http://innovatrainingperu.com/images/mailimg/OP/FB.jpg" alt="facebook" width="25" height="25" /></a>   <a href="https://www.youtube.com/channel/UC_v5IPrU7f27xflWiveLhHQ" target="_blank"><img src="http://innovatrainingperu.com/images/mailimg/OP/Youtube.jpg" alt="youtubeinnvova" width="25" height="25" /></a> </div>
                      <br />
                      <div style="margin: 0px; font-size: 12px; color: #bbbbbb; text-align: center;">© 2016 Innova Training Center</div>
                      <div style="margin: 0px; font-size: 11px; color: #bbbbbb; text-align: center;">Arequipa - Perú<br />Calle Ibañez #102 Urb. María Isabel, Cercado Arequipa</div>
                    </td>
                  </tr>
                </tbody>
              </table>
              <p></p>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </body>
</html>
</tbody>
</table>
</div>
</div>
</body>
</html>'; 
    
    }else{
      
    $lugar = 'Urbanización María Isabel, Calle Ibáñez
        102, Piso 3, Cercado – Arequipa'; 
    $htmlmensaje ='<!DOCTYPE html>
<html>
  <head>
    <style>
      @media only screen and (max-device-width: 480px) {
        /* mobile-specific CSS styles go here */
      }
    </style>
  </head>
  <body>
    <div style="margin: 5px 0 0 0; padding: 0; background-color: #f3f3f3;" bgcolor="#f3f3f3">
      <table border="0" cellspacing="0" cellpadding="0" width="100%" bgcolor="#f3f3f3" style="color: #4a4a4a;" museo="" sans="" rounded="" helvetica="" neue="" arial="" sans-serif="" font-size:="" 14px="" line-height:="" 20px="" border-collapse:="" callapse="" border-spacing:="" 0="" margin:="" auto="">
        <tbody>
          <tr>
            <td style="padding-left: 10px; padding-right: 10px;">
              <table border="0" cellspacing="0" cellpadding="0" align="center" width="100%" style="width: 100%; margin: 0 auto; max-width: 600px;">
                <tbody>
                  <tr style="height: 98px;">
                    <td style="text-align: center; padding-top: 3%; height: 98px;"><a style="text-decoration: none;" target="_blank"> <img src="http://innovatrainingperu.com/images/mailimg/OP/headerm.jpg" alt="innova training center" width="100%" style="display: block; margin: 0; border: 0; max-width: 600px;" /> </a></td>
                  </tr>
                  <tr style="height: 518px;">
                    <td bgcolor="#ffffff" style="background-color: #ffffff; padding: 9%; height: 518px;">
                      <table border="0" cellspacing="0" cellpadding="0" style="width: 100%;">
                        <tbody>
                          <tr style="height: 40px;">
                            <td style="padding-bottom: 20px; line-height: 20px; height: 40px;"><img src="http://innovatrainingperu.com/images/mailimg/OP/confirmacion.jpg" alt="orden de pago" width="100%" style="display: block; margin: 0; border: 0; max-width: 600px;" /></td>
                          </tr>
                          <tr style="height: 40px;">
                            <td style="padding-bottom: 20px; line-height: 20px; height: 40px;">
                              <div style="border-bottom: 2px solid #eeeeee; text-align: center;"><span style="font-family: tahoma, arial, helvetica, sans-serif; font-size: 14pt;"><strong>'.$nombre.'</strong></span></div>
                            </td>
                          </tr>
                          <tr style="height: 10px;">
                            <td style="background-color: #ffffff; height: 10px;">
                              <table style="width: 100%;">
                                <tbody>
                                  <tr style="height: 43px;">
                                    <td style="width: 50%; height: 43px;" colspan="2">
                                      <p><strong><span style="font-size: 8pt; color: #999999;">Estas inscrito correctamente en:</span></strong></p>
                                      <ul>
                                        <li><strong style="font-size: 8pt;">Curso: </strong>'.$nom_g.'</li>
                                        <li><strong style="font-size: 8pt;">Codigo de matricula:</strong>'.$id_u.'</li>
                                        <li><strong style="font-size: 8pt;">Modalidad: </strong>'.$moda.'</li>
                                        <li><strong style="font-size: 8pt;">Turno: </strong>'.$turno.'</li>
                                        <li><strong style="font-size: 8pt;">Horario: </strong>'.$horario.'</li>
                                        <li><strong style="font-size: 8pt;">Inicio: </strong>'.$fech_ini.'</li>
                                        <li><strong style="font-size: 8pt;">Lugar: </strong>'.$lugar.'</li>
                                      </ul>
                                    </td>
                                  </tr>
                                  <tr style="height: 43px;">
                                    <td style="width: 50%; height: 43px; font-size: 8pt;" colspan="2">
                                      <p><span style="color: #808080;">* Recuerda coordinar la instalación del software con dos días de anticipación al inicio del curso.</span><br /><strong><span style="color: #999999;"> Coordinación de Instalación de Software con:</span></strong><br /><span style="color: #808080;">Cynthia Lizbeth Vilca Llerena – Asesora de Capacitación</span><br /><span style="color: #808080;">RPC: 993655595</span></p>
                                    </td>
                                  </tr>
                                </tbody>
                              </table>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </td>
                  </tr>
                  <tr>
                    <td style="font-size: 0px;"><img src="https://ci4.googleusercontent.com/proxy/12NavqvSN1hipJtW6jogbG-zfKUhYCZjDSwkLBnPuQyH-7sDTvvk_KSCFwFFnO99M0vWmNnd2JF-8gdyE0BCHPthUJWCqGCKoQ1zy3A=s0-d-e1-ft#http://static.duolingo.com/images/email/2014/bottom.png" width="100%" style="display: block;" /> </td>
                  </tr>
                  <tr style="height: 150px;">
                    <td style="padding: 20px; width: 554px; height: 150px;">
                      <div style="margin: 0px; font-size: 12px; color: #bbbbbb; text-align: center;">Encuentranos:</div>
                      <br />
                      <div style="margin: 0px; font-size: 12px; color: #bbbbbb; text-align: center;"><a href="https://www.facebook.com/innovatraining/" target="_blank"><img src="http://innovatrainingperu.com/images/mailimg/OP/FB.jpg" alt="facebook" width="25" height="25" /></a>   <a href="https://www.youtube.com/channel/UC_v5IPrU7f27xflWiveLhHQ" target="_blank"><img src="http://innovatrainingperu.com/images/mailimg/OP/Youtube.jpg" alt="youtubeinnvova" width="25" height="25" /></a> </div>
                      <br />
                      <div style="margin: 0px; font-size: 12px; color: #bbbbbb; text-align: center;">© 2016 Innova Training Center</div>
                      <div style="margin: 0px; font-size: 11px; color: #bbbbbb; text-align: center;">Arequipa - Perú<br />Calle Ibañez #102 Urb. María Isabel, Cercado Arequipa</div>
                    </td>
                  </tr>
                </tbody>
              </table>
              <p></p>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </body>
</html>
</tbody>
</table>
</div>
</div>
</body>
</html>'; 
      
    }
  
    $titulo    = 'CONFIRMACION MATRICULA '.$nom_g;
    // Para enviar un correo HTML, debe establecerse la cabecera Content-ty
    $mail->addAddress($email_user, $nombre);
    $mail->Subject = $titulo;
    $mail->msgHTML($htmlmensaje);
    $mail->AltBody = 'Se trata de un cuerpo de mensaje de texto sin formato, contactar a cursos@innovatrainingperu.com';
    if (!$mail->send()) {
      return false;
      echo "Mailer Error: " . $mail->ErrorInfo;
    } else {
      return true;
    }
}
?>