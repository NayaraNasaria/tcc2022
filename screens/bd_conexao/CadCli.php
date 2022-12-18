<?php 
    $host = "127.0.0.1";
    $usuario = "root";
    $senha = ""; 
    $bd = "streamline";
    $con = mysqli_connect($host , $usuario, $senha , $bd);
 ?>

 <?php
$nome = $_POST['nome']; 
$genero = $_POST['genero'];
$email = $_POST ['email'];
$senha = password_hash($_POST ['senha'], PASSWORD_DEFAULT);
$data_nasc = $_POST ['dataNascimento'];
$data_cadCli = date('Y-m-d');
$tel = $_POST ['telefone'];
$cep = $_POST ['cep'];
$num_casa = $_POST ['numero_casa'];
$comp = $_POST ['complemento'];
$cidade = $_POST ['cidade'];
$estado = $_POST ['estado'];

$tel = preg_replace( '/[^a-z0-9]/i', '', $tel);
$link = "http://api.whatsapp.com/send?1=pt_BR&phone=55$tel";

$confirmaremail = mysqli_query($con, "SELECT * FROM `cadastrocliente` WHERE email_cli = '$email'");
$totalEmail = mysqli_num_rows($confirmaremail);
if($totalEmail >= 1){
   echo "Este E-mail já foi cadastrado!\nPor favor, faça login.";
   header("Location: ../cliente/loginCliente.php");
}else{

$token = md5(mt_rand(2, 6));

$sql = mysqli_query ($con, "INSERT INTO `cadastrocliente`(`Id_cli`, `nome_cli`, `genero`, `email_cli`, `senha`, `data_nacimento`, `Data_cadCli`, `contato`, 
`cep`, `numero_casa`, `complemento`, `estado`, `cidade`, `biografia`, `link`, `foto_perfil`, `ativo`, `token`) VALUES ('','$nome','$genero','$email','$senha','$data_nasc','$data_cadCli',
'$tel','$cep','$num_casa','$comp','$estado','$cidade', 'Olá!', '$link', 'perfis1.svg', '0', '$token')");


        if($sql >= 1){

            $for = "$email"; //quem recebe a mensagem
                    $assunto = "Confirme o Seu E-mail - StreamLine";

                    $corpo = '
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
<div align="center" class="alignment" style="line-height:10px"><img alt="Dont Know What Happened" class="fullMobileWidth" src="https://d15k2d11r6t6rl.cloudfront.net/public/users/Integrators/BeeProAgency/907253_891565/New%20team%20members-amico.png" style="display: block; height: auto; border: 0; width: 408px; max-width: 100%;" title="Dont Know What Happened" width="408"/></div>
</td>
</tr>
</table>
<table border="0" cellpadding="0" cellspacing="0" class="heading_block block-2" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
<tr>
<td class="pad" style="padding-bottom:15px;padding-left:20px;padding-right:20px;text-align:center;width:100%;">
<h1 style="margin: 0; color: #212121; direction: ltr; font-family: Fira Sans, Lucida Sans Unicode, Lucida Grande, sans-serif; font-size: 40px; font-weight: 400; letter-spacing: normal; line-height: 120%; text-align: center; margin-top: 0; margin-bottom: 0;"><strong>Confirme o seu E-mail</strong></h1>
</td>
</tr>
</table>
<table border="0" cellpadding="0" cellspacing="0" class="text_block block-3" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;" width="100%">
<tr>
<td class="pad" style="padding-bottom:10px;padding-left:20px;padding-right:20px;padding-top:10px;">
<div style="font-family: sans-serif">
<div class="" style="font-size: 12px; mso-line-height-alt: 18px; color: #20448c; line-height: 1.5; font-family: Fira Sans, Lucida Sans Unicode, Lucida Grande, sans-serif;">
<p style="margin: 0; text-align: center; mso-line-height-alt: 33px;"><span style="font-size:22px;">Olá,                                                 </span></p>
<p style="margin: 0; text-align: center; mso-line-height-alt: 33px;"><span style="font-size:22px;">Você se cadastrou em nosso site.</span></p>
<p style="margin: 0; font-size: 22px; mso-line-height-alt: 18px;"> </p>
<p style="margin: 0; font-size: 22px; text-align: center; mso-line-height-alt: 30px;"><span style="font-size:20px;">Por favor, coloque o código abaixo para completar o seu cadastro.</span></p>
<p style="margin: 0; font-size: 22px; text-align: center; mso-line-height-alt: 18px;"> </p>
</div>
</div>
</td>
</tr>
</table>
<table border="0" cellpadding="0" cellspacing="0" class="heading_block block-4" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
<tr>
<td class="pad" style="width:100%;text-align:center;">
<h1 style="margin: 0; color: #20448c; font-size: 32px; font-family: "Roboto Slab", Arial, "Helvetica Neue", Helvetica, sans-serif; line-height: 150%; text-align: center; direction: ltr; font-weight: 700; letter-spacing: normal; margin-top: 0; margin-bottom: 0;"><span class="tinyMce-placeholder">'.$token.'</span></h1>
</td>
</tr>
</table>
<table border="0" cellpadding="0" cellspacing="0" class="text_block block-5" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;" width="100%">
<tr>
<td class="pad" style="padding-bottom:50px;padding-left:20px;padding-right:20px;padding-top:10px;">
<div style="font-family: sans-serif">
<div class="" style="font-size: 12px; mso-line-height-alt: 18px; color: #20448c; line-height: 1.5; font-family: Fira Sans, Lucida Sans Unicode, Lucida Grande, sans-serif;">
<p style="margin: 0; font-size: 18px; text-align: center; mso-line-height-alt: 18px;"> </p>
<p style="margin: 0; font-size: 18px; text-align: center; mso-line-height-alt: 27px;"><span style="font-size:18px;">Obrigado por utilizar os nossos serviços.</span></p>
<p style="margin: 0; font-size: 18px; text-align: center; mso-line-height-alt: 27px;"><br/><span style="font-size:18px;">A Equipe StreamLine o agradece por fazer parte da nossa história.</span></p>
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
<table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-2" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #20448c;" width="100%">
<tbody>
<tr>
<td>
<table align="center" border="0" cellpadding="0" cellspacing="0" class="row-content stack" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; width: 680px;" width="680">
<tbody>
<tr>
<td class="column column-1" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 5px; padding-bottom: 5px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;" width="100%">
<table border="0" cellpadding="0" cellspacing="0" class="icons_block block-1" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
<tr>
<td class="pad" style="vertical-align: middle; color: #ffffff; font-family: "Roboto Slab", Arial, "Helvetica Neue", Helvetica, sans-serif; font-size: 27px; letter-spacing: 1px; text-align: center;">
<table cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
<tr>
<td class="alignment" style="vertical-align: middle; text-align: center;">
<!--[if vml]><table align="left" cellpadding="0" cellspacing="0" role="presentation" style="display:inline-block;padding-left:0px;padding-right:0px;mso-table-lspace: 0pt;mso-table-rspace: 0pt;"><![endif]-->
<!--[if !vml]><!-->
<table cellpadding="0" cellspacing="0" class="icons-inner" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; display: inline-block; margin-right: -4px; padding-left: 0px; padding-right: 0px;">
<!--<![endif]-->
<tr>
<td style="vertical-align: middle; text-align: center; padding-top: 2px; padding-bottom: 4px; padding-left: 5px; padding-right: 5px;"><img align="center" alt="" class="icon" height="64" src="https://d15k2d11r6t6rl.cloudfront.net/public/users/Integrators/BeeProAgency/907253_891565/Logo-StreamLine-TCC-ELY_SURPRESA.png" style="display: block; height: auto; margin: 0 auto; border: 0;" width="64"/></td>
<td style="font-family: "Roboto Slab", Arial, "Helvetica Neue", Helvetica, sans-serif; font-size: 27px; color: "#ffffff"; vertical-align: middle; letter-spacing: 1px; text-align: center;">StreamLine</td>
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
<p style="margin: 0; font-size: 14px; text-align: center; mso-line-height-alt: 18px;"> </p>
<p style="margin: 0; font-size: 14px; text-align: center; mso-line-height-alt: 21px;">Este e-mail é automático, por favor não responda.<br/>Caso precise, contacte mailstreamlineserver@gmail.com</p>
<p style="margin: 0; font-size: 14px; text-align: center; mso-line-height-alt: 18px;"> </p>
<p style="margin: 0; font-size: 14px; text-align: center; mso-line-height-alt: 18px;"> </p>
<p style="margin: 0; font-size: 14px; text-align: center; mso-line-height-alt: 21px;">Copyright© 2022 LMNNY</p>
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
                    $headers[] = 'From: mailstreamlineserver@gmail.com';

                    if (mail($for, $assunto, $corpo, implode("\r\n", $headers))) {
                        echo "<script>alert('Foi enviado um E-mail para confirmar o seu cadastro!');</script>";
                        header("Location: ../email/confirmarCadCli.php");
                    } else {
                    }
        }else{
            echo "Não foi possível completar o cadastro!";
            header("Location: ../Home.php");
        }
    }
?>
