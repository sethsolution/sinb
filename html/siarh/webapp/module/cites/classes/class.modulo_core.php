<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
/**
 * Created by PhpStorm.
 * User: henrytaby
 * Date: 29/07/2020
 * Time: 19:53
 */

class Modulo_Core extends Table {

    function __construct(){
        /**
         * Inicializamos todas las librerias y variables para el submodulo
         */
        $this->submodule_init_sbm();
    }

    function privface_extender(){
        global $privFace,$smarty;
        /**
         * Consulta a la tabla local, de usuario_permisos
         */
        $sql ="";


        /**
         * reconstruir
         */
        $privFace["siguiente"] = 1;
        $privFace["devolver"] = 1;
        $privFace["ver"] = 1;
        $privFace["editar"] = 1;


        if($privFace["editar"]==0){

            $privFace["checkbox"] = " disabled='true' ";
            $privFace["input"] = " disabled='true' ";
        }


        $smarty->assign("privFace", $privFace);
    }

    function get_cites_config(){
        global $db,$CFG;
        $sql = "SELECT * FROM ".$CFG->tabla["cites_core_config"]." AS c WHERE c.activo=1 limit 1";
        $res = $db->execute($sql);
        $item = $res->fields;
        return $item;
    }


    public function send_email_system($to,$asunto,$base=""){
        global $subcontrol,$path_sbm,$pathmodule,$smarty_template,$smarty,$frontend,$CFGm,$CFG,$templateSmoduleCore;

        /**
         * Configuración de template para sacar datos de los tpl para enviar el correo
         */
        $smarty_template = array();
        $smarty_template[] = "./module/cites/template/email_core/";
        $smarty_template[] = $path_sbm."snippet/".$subcontrol."/view/";
        $smarty_template[] = $pathmodule."template/frontend/";
        $smarty->setTemplateDir($smarty_template);

        if($base==""){
            $base = $frontend["email_base"];
            //$base = $templateSmoduleCore."email_base.tpl";
        }

        /**
         * Sacamos los datos de configuración
         */
        $conf = $this->get_cites_config();

        /**
         * Variable dominio en la url
         */

        if($conf["dominio_ssl"]==0){
            $dominio = "http://";
        }else{
            $dominio = "http://";
        }
        $dominio .=  $conf["dominio"];
        $smarty->assign("url_dominio",$dominio);
        $smarty->assign("dominio",$conf["dominio"]);

        $frontend["email_base"] = "./module/cites/template/email_core/email_base.tpl";
        $cuerpo = $smarty->fetch($frontend["email_base"]);
        //echo $cuerpo;exit;
        $mail = new PHPMailer(true);
        try {
            //Server settings
            //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = $conf["smtp_server"];                    // Set the SMTP server to send through
            $mail->SMTPAuth   = $conf["stmp_auth"];                                   // Enable SMTP authentication
            $mail->Username   = $conf["smtp_user"];                          // SMTP username
            $mail->Password   = $conf["smtp_password"];                                   // SMTP password
            $mail->SMTPSecure = 'tls';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port       = $conf["smtp_port"];                          // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

            //Recipients
            $mail->setFrom($conf["email_from"], $conf["email_from_nombre"]);
            //$mail->AddReplyTo($CFGm->phpmailer["De"], $CFGm->phpmailer["Nombre"]);
            $mail->addAddress($to["email"], $to["name"]);     // Add a recipient

            //print_struc($mail);exit;
            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            //$asunto = htmlentities($asunto,ENT_QUOTES,"UTF-8");
            //$asunto = utf8_encode($asunto);
            $asunto = utf8_decode($asunto);
            $mail->Subject = $asunto;
            $mail->Body    = $cuerpo;
            $mail->AltBody = $cuerpo;

            $archivos = "./module/cites/template/email_core/email/";
            //$archivos = "./images/email/";
            $mail->AddEmbeddedImage($archivos.'email_logo.png','mmayaLogo','email_logo.png');

            $mail->send();
            $res["res"] = 1;
            $res["msgdb"] = "Mensaje fue enviado correctamente";
        } catch (Exception $e) {
            $res["res"] = 2;
            $res["msgdb"] = "No se pudo enviar el correo electrónico {$mail->ErrorInfo}";
        }
        return $res;
    }
}