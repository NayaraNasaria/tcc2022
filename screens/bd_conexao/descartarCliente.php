<?php
session_start();
include('../bd_conexao/conexao.php');

$id_prof = $_SESSION['Id_prof'];
$cliente = $_POST['cliente'];

$sql = mysqli_query ($con, "DELETE FROM `orcamento` WHERE Id_cli = $cliente and Id_prof = $id_prof");
$consulta = mysqli_query ($con, "SELECT `email_cli` FROM `cadastrocliente` WHERE Id_cli = $cliente");

if ($consulta->num_rows > 0) {
    while ($dados = mysqli_fetch_assoc($consulta)) {
        $email = $dados['email_cli']; }}


if($sql >= 1){
    $up = mysqli_query ($con, "UPDATE `cadastrocliente` SET `ativo`='0' WHERE Id_cli = $id_cli");
            $for = "$email"; //quem recebe a mensagem
            $assunto="Você foi Suspenso da StreamLine!";
            $corpo=' 
            <!DOCTYPE html>

            <html lang="en" xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:v="urn:schemas-microsoft-com:vml">
            <head>
            <title></title>
            <meta content="text/html; charset=utf-8" http-equiv="Content-Type"/>
            <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
            <!--[if mso]><xml><o:OfficeDocumentSettings><o:PixelsPerInch>96</o:PixelsPerInch><o:AllowPNG/></o:OfficeDocumentSettings></xml><![endif]-->
            <!--[if !mso]><!-->
            <link href="https://fonts.googleapis.com/css?family=Fira+Sans" rel="stylesheet" type="text/css"/>
            <link href="https://fonts.googleapis.com/css?family=Roboto+Slab" rel="stylesheet" type="text/css"/>
            <!--<![endif]-->
            <style>
                    * {
                        box-sizing: border-box;
                    }
            
                    body {
                        margin: 0;
                        padding: 0;
                    }
            
                    a[x-apple-data-detectors] {
                        color: inherit !important;
                        text-decoration: inherit !important;
                    }
            
                    #MessageViewBody a {
                        color: inherit;
                        text-decoration: none;
                    }
            
                    p {
                        line-height: inherit
                    }
            
                    .desktop_hide,
                    .desktop_hide table {
                        mso-hide: all;
                        display: none;
                        max-height: 0px;
                        overflow: hidden;
                    }
            
                    @media (max-width:700px) {
                        .desktop_hide table.icons-inner {
                            display: inline-block !important;
                        }
            
                        .icons-inner {
                            text-align: center;
                        }
            
                        .icons-inner td {
                            margin: 0 auto;
                        }
            
                        .fullMobileWidth,
                        .row-content {
                            width: 100% !important;
                        }
            
                        .mobile_hide {
                            display: none;
                        }
            
                        .stack .column {
                            width: 100%;
                            display: block;
                        }
            
                        .mobile_hide {
                            min-height: 0;
                            max-height: 0;
                            max-width: 0;
                            overflow: hidden;
                            font-size: 0px;
                        }
            
                        .desktop_hide,
                        .desktop_hide table {
                            display: table !important;
                            max-height: none !important;
                        }
                    }
                </style>
            </head>
            <body style="background-color: #111111; margin: 0; padding: 0; -webkit-text-size-adjust: none; text-size-adjust: none;">
            <table border="0" cellpadding="0" cellspacing="0" class="nl-container" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #111111;" width="100%">
            <tbody>
            <tr>
            <td>
            <table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-1" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #ffffff;" width="100%">
            <tbody>
            <tr>
            <td>
            <table align="center" border="0" cellpadding="0" cellspacing="0" class="row-content stack" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; width: 680px;" width="680">
            <tbody>
            <tr>
            <td class="column column-1" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 5px; padding-bottom: 5px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;" width="100%">
            <table border="0" cellpadding="0" cellspacing="0" class="image_block block-1" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
            <tr>
            <td class="pad" style="padding-bottom:15px;padding-left:15px;padding-right:15px;width:100%;">
            <div align="center" class="alignment" style="line-height:10px"><img alt="Dont Know What Happened" class="fullMobileWidth" src="https://d15k2d11r6t6rl.cloudfront.net/public/users/Integrators/BeeProAgency/907253_891565/Social%20anxiety-pana.png" style="display: block; height: auto; border: 0; width: 578px; max-width: 100%;" title="Dont Know What Happened" width="578"/></div>
            </td>
            </tr>
            </table>
            <table border="0" cellpadding="0" cellspacing="0" class="heading_block block-2" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
            <tr>
            <td class="pad" style="padding-bottom:15px;padding-left:20px;padding-right:20px;text-align:center;width:100%;">
            <h1 style="margin: 0; color: #212121; direction: ltr; font-family: Fira Sans, Lucida Sans Unicode, Lucida Grande, sans-serif; font-size: 40px; font-weight: 400; letter-spacing: normal; line-height: 120%; text-align: center; margin-top: 0; margin-bottom: 0;"><strong>Lamentamos que a sua transação não tenha dado certo!</strong></h1>
            </td>
            </tr>
            </table>
            <table border="0" cellpadding="0" cellspacing="0" class="text_block block-3" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;" width="100%">
            <tr>
            <td class="pad" style="padding-bottom:10px;padding-left:20px;padding-right:20px;padding-top:10px;">
            <div style="font-family: sans-serif">
            <div class="" style="font-size: 12px; mso-line-height-alt: 18px; color: #7c0808; line-height: 1.5; font-family: Fira Sans, Lucida Sans Unicode, Lucida Grande, sans-serif;">
            <p style="margin: 0; font-size: 22px; text-align: left; mso-line-height-alt: 33px;">Olá, </p>
            <p style="margin: 0; font-size: 22px; text-align: left; mso-line-height-alt: 33px;">A equipe StreamLine lamenta que a sua contratação não tenha sido aceita.</p>
            <p style="margin: 0; font-size: 22px; text-align: left; mso-line-height-alt: 18px;"> </p>
            <p style="margin: 0; font-size: 22px; text-align: left; mso-line-height-alt: 33px;">Nós esperamos que você não tenha se decepcionado e continue utilizando os nossos serviços.</p>
            <p style="margin: 0; font-size: 22px; text-align: center; mso-line-height-alt: 33px;"><span style="font-size:22px;"> </span></p>
            </div>
            </div>
            </td>
            </tr>
            </table>
            <table border="0" cellpadding="0" cellspacing="0" class="text_block block-4" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;" width="100%">
            <tr>
            <td class="pad" style="padding-bottom:70px;padding-left:20px;padding-right:10px;padding-top:10px;">
            <div style="font-family: sans-serif">
            <div class="" style="font-size: 12px; mso-line-height-alt: 14.399999999999999px; color: #111111; line-height: 1.2; font-family: Fira Sans, Lucida Sans Unicode, Lucida Grande, sans-serif;">
            <p style="margin: 0; font-size: 18px; text-align: center; mso-line-height-alt: 14.399999999999999px;"> </p>
            <p style="margin: 0; font-size: 18px; text-align: center; mso-line-height-alt: 21.599999999999998px;"><span style="font-size:18px;">Você não pode mudar o vento, mas pode ajustar as</span></p>
            <p style="margin: 0; font-size: 18px; text-align: center; mso-line-height-alt: 21.599999999999998px;"><span style="font-size:18px;">velas do barco para chegar onde quer. - Confúcio</span></p>
            </div>
            </div>
            </td>
            </tr>
            </table>
            </td>
            </tr>
            </tbody>
            </table>
            </td>
            </tr>
            </tbody>
            </table>
            <table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-2" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #7c0808;" width="100%">
            <tbody>
            <tr>
            <td>
            <table align="center" border="0" cellpadding="0" cellspacing="0" class="row-content stack" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; width: 680px;" width="680">
            <tbody>
            <tr>
            <td class="column column-1" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 5px; padding-bottom: 5px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;" width="100%">
            <table border="0" cellpadding="0" cellspacing="0" class="icons_block block-1" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
            <tr>
            <td class="pad" style="vertical-align: middle; color: #ffffff; font-family: 'Roboto Slab', Arial, 'Helvetica Neue', Helvetica, sans-serif; font-size: 27px; letter-spacing: 1px; text-align: center;">
            <table cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
            <tr>
            <td class="alignment" style="vertical-align: middle; text-align: center;">
            <!--[if vml]><table align="left" cellpadding="0" cellspacing="0" role="presentation" style="display:inline-block;padding-left:0px;padding-right:0px;mso-table-lspace: 0pt;mso-table-rspace: 0pt;"><![endif]-->
            <!--[if !vml]><!-->
            <table cellpadding="0" cellspacing="0" class="icons-inner" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; display: inline-block; margin-right: -4px; padding-left: 0px; padding-right: 0px;">
            <!--<![endif]-->
            <tr>
            <td style="vertical-align: middle; text-align: center; padding-top: 5px; padding-bottom: 5px; padding-left: 5px; padding-right: 5px;"><img align="center" alt="" class="icon" height="64" src="https://d15k2d11r6t6rl.cloudfront.net/public/users/Integrators/BeeProAgency/907253_891565/Logo-StreamLine-TCC-ELY_SURPRESA.png" style="display: block; height: auto; margin: 0 auto; border: 0;" width="64"/></td>
            <td style="font-family: 'Roboto Slab', Arial, 'Helvetica Neue', Helvetica, sans-serif; font-size: 27px; color: #ffffff; vertical-align: middle; letter-spacing: 1px; text-align: center;">StreamLine</td>
            </tr>
            </table>
            </td>
            </tr>
            </table>
            </td>
            </tr>
            </table>
            <table border="0" cellpadding="0" cellspacing="0" class="text_block block-2" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;" width="100%">
            <tr>
            <td class="pad" style="padding-bottom:15px;padding-left:20px;padding-right:20px;">
            <div style="font-family: sans-serif">
            <div class="" style="font-size: 12px; mso-line-height-alt: 18px; color: #e9e9e9; line-height: 1.5; font-family: Fira Sans, Lucida Sans Unicode, Lucida Grande, sans-serif;">
            <p style="margin: 0; font-size: 14px; text-align: center; mso-line-height-alt: 25.5px;"><span style="font-size:17px;">ESTE E-MAIL É AUTOMÁTICO, POR FAVOR NÃO RESPONDA!</span></p>
            </div>
            </div>
            </td>
            </tr>
            </table>
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
            </tbody>
            </table><!-- End -->
            </body>
            </html>
            ';
            $headers[] = 'MIME-Version: 1.0';
            $headers[] = 'Content-type: text/html; charset=iso-8859-1';

            // Additional headers
            if(mail($for,$assunto,$corpo,implode("\r\n", $headers))){
                header('Location: ../contratacaoAutonomo.php');
            } else{
            }
   
}else{
    echo "<script>alert('Não foi possível descartar!');</script>";
    header('Location: ../contratacaoAutonomo.php');

}

?>
