<?php
include("../bd_conexao/conexao.php");


if (isset($_POST['btnPress'])) {

    $email = $con->escape_string($_POST['email_prof']);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "E-mail inválido";
    }

    $sql = "SELECT senha FROM `cadastroprofissional` WHERE email_prof = '$email'";
    $sql_query = $con->query($sql) or die("Falha no SQL: " . $con->error);

    if ($sql == 0) {
        echo "O E-mail informado não está cadastrado.";
    }

    $cod = substr(md5(time()), 0, 6);

    $for = "$email"; //quem recebe a mensagem
    $assunto = "Redefinição de Senha - StreamLine";

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
<div align="center" class="alignment" style="line-height:10px"><img alt="Dont Know What Happened" class="fullMobileWidth" src="https://d15k2d11r6t6rl.cloudfront.net/public/users/Integrators/BeeProAgency/907253_891565/13744794_Mar-Business_2.jpg" style="display: block; height: auto; border: 0; width: 408px; max-width: 100%;" title="Dont Know What Happened" width="408"/></div>
</td>
</tr>
</table>
<table border="0" cellpadding="0" cellspacing="0" class="heading_block block-2" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
<tr>
<td class="pad" style="padding-bottom:15px;padding-left:20px;padding-right:20px;text-align:center;width:100%;">
<h1 style="margin: 0; color: #212121; direction: ltr; font-family: Fira Sans, Lucida Sans Unicode, Lucida Grande, sans-serif; font-size: 40px; font-weight: 400; letter-spacing: normal; line-height: 120%; text-align: center; margin-top: 0; margin-bottom: 0;"><strong>Esqueceu sua senha?</strong></h1>
</td>
</tr>
</table>
<table border="0" cellpadding="0" cellspacing="0" class="text_block block-3" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;" width="100%">
<tr>
<td class="pad" style="padding-bottom:10px;padding-left:20px;padding-right:20px;padding-top:10px;">
<div style="font-family: sans-serif">
<div class="" style="font-size: 12px; mso-line-height-alt: 18px; color: #20448c; line-height: 1.5; font-family: Fira Sans, Lucida Sans Unicode, Lucida Grande, sans-serif;">
<p style="margin: 0; font-size: 22px; text-align: center; mso-line-height-alt: 33px;"><span style="font-size:22px;">Olá Usuário,</span></p>
<p style="margin: 0; font-size: 22px; text-align: center; mso-line-height-alt: 33px;"><span style="font-size:22px;">Você solicitou um código para redefinir a sua senha.</span></p>
<p style="margin: 0; font-size: 22px; mso-line-height-alt: 18px;"> </p>
<p style="margin: 0; font-size: 22px; mso-line-height-alt: 30px;"><span style="font-size:20px;">O seu código é: '.$cod.'</span></p>
<p style="margin: 0; font-size: 22px; mso-line-height-alt: 18px;"> </p>
<p style="margin: 0; font-size: 22px; text-align: center; mso-line-height-alt: 33px;"><span style="font-size:22px;"> </span></p>
</div>
</div>
</td>
</tr>
</table>
<table border="0" cellpadding="0" cellspacing="0" class="text_block block-4" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;" width="100%">
<tr>
<td class="pad" style="padding-bottom:50px;padding-left:20px;padding-right:20px;padding-top:10px;">
<div style="font-family: sans-serif">
<div class="" style="font-size: 12px; mso-line-height-alt: 18px; color: #20448c; line-height: 1.5; font-family: Fira Sans, Lucida Sans Unicode, Lucida Grande, sans-serif;">
<p style="margin: 0; font-size: 22px; text-align: center; mso-line-height-alt: 18px;"> </p>
<p style="margin: 0; font-size: 22px; text-align: center; mso-line-height-alt: 24px;"><span style="font-size:16px;">Se você não solicitou a redefinição de senha, por favor ignore.<span style=""> </span></span></p>
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
<table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-2" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #acc3ff;" width="100%">
<tbody>
<tr>
<td>
<table align="center" border="0" cellpadding="0" cellspacing="0" class="row-content stack" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000; width: 680px;" width="680">
<tbody>
<tr>
<td class="column column-1" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 5px; padding-bottom: 5px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;" width="100%">
<table border="0" cellpadding="0" cellspacing="0" class="icons_block block-1" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
<tr>
<td class="pad" style="vertical-align: middle; color: "#ffffff"; font-family: "Roboto Slab", Arial, "Helvetica Neue", Helvetica, sans-serif; font-size: 27px; text-align: center; letter-spacing: 1px;">
<table cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
<tr>
<td class="alignment" style="vertical-align: middle; text-align: center;">
<!--[if vml]><table align="left" cellpadding="0" cellspacing="0" role="presentation" style="display:inline-block;padding-left:0px;padding-right:0px;mso-table-lspace: 0pt;mso-table-rspace: 0pt;"><![endif]-->
<!--[if !vml]><!-->
<table cellpadding="0" cellspacing="0" class="icons-inner" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; display: inline-block; margin-right: -4px; padding-left: 0px; padding-right: 0px;">
<!--<![endif]-->
<tr>
<td style="vertical-align: middle; text-align: center; padding-top: 1px; padding-bottom: 3px; padding-left: 5px; padding-right: 5px;"><img align="center" alt="" class="icon" height="60" src="https://d15k2d11r6t6rl.cloudfront.net/public/users/Integrators/BeeProAgency/907253_891565/Logo-StreamLine-TCC-ELY_SURPRESA.png" style="display: block; height: auto; margin: 0 auto; border: 0;" width="64"/></td>
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
    $headers[] = 'From: mailstreamlineserver@gmail.com';

    if (mail($for, $assunto, $corpo, implode("\r\n", $headers))) {
        $update = "UPDATE `cadastroprofissional` SET `senha`='$cod' WHERE email_prof = '$email'";
        $update_query = $con->query($update) or die("Falha no SQL: " . $con->error);
        header("Location: novasenhaAuto.php");
    } else {
        echo "Não foi possível alterar a senha.";
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta name="format-detection" content="telephone=no" />
    <meta name="msapplication-tap-highlight" content="no" />
    <meta name="viewport" content="initial-scale=1, width=device-width, viewport-fit=cover" />
    <link rel="stylesheet" href="../../node_modules/bootstrap/dist/css/bootstrap.css" />
    <link rel="stylesheet" href="../../node_modules/bootstrap/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../../css/recuperarsenha.css" />
    <link rel="stylesheet" href="../../css/navbar.css" />
    <link href="../node_modules/jquery/dist/jquery.js" />
    <script src="../node_modules/bootstrap/dist/js/bootstrap.js"></script>
    <script src="../node_modules/jquery/dist/jquery.min.js"></script>
    <script type="text/javascript" src="../js/function.js"></script>
    <title>Recuperar senha</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-faded" style="background-color: #182b3d;">
        <div class="container-fluid" style="padding-bottom: 30px;">
            <a class="navbar-brand" style="color: #f2f2f2; margin-top: 20px;">StreamLine</a>
        </div>
    </nav>
    <div class="flex-box container-box">
        <div class="card-body">
            <h3 class="card-title" style="color:#f2f2f2;">Redefinição de senha</h3>
            <p class="card-text" style="min-width: 40px;">
                Digite o seu e-mail no campo abaixo para o envio de um código de verificação para uma nova senha.
            </p>
            <form method="post" action="" id="form" name="form" style="color: #f2f2f2;">
                <div class="form-group">
                    <label class="label" for="Email">Email:</label>
                    <input type="email" class="form-control" required name="email_prof" id="email_prof" placeholder="email@email.com" />
                </div>
                <button type="submit" id="btnPress" name="btnPress" class="btnPress" style="margin-top: 10%;">
                    Redefinir senha
                </button>
                <a href="../autonomo/loginAutonomo.php"><input type="button" id="btnCancel" class="btnCancel" value="Cancelar" /></a>

            </form>
        </div>
    </div>

</body>

</html>
