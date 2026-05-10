<!DOCTYPE html>
<head>
	<meta charset="utf-8">

	<!-- Styles -->
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<style>

		.container{
				font-family:arial;
		}

		.parrafo{
			text-align:justify;
			font-size: 14px;

		}
		.remitente{
			font-weight:bold;
			font-size: 14px;

		}

		.info-depa{
			font-weight:bold;
			font-size: 11px;

		}

		.info-oficio{
			font-size: 11px;

		}
		.atentamente{
			font-size: 11px;
			font-weight:bold;
		}

		.firmas{
			font-size: 10px;
		}
		.ccp{
			font-size: 7px;
		}
		.cimage{
			align:center;
		}
	</style>

</head>
<html>
<form>
<div class="container">
    <div class="row">
		<div class="col-4"><img class="cimage" src="{{ public_path("/img/LogoSSN.png") }}" width="300px"></div>
		<div class="col-4"></div>
		<div class="col-4">
			<div class="info-depa">
				<p>DIRECCIÓN DE ADMINISTRACIÓN<br>
				SUBDIRECCION DE RECURSOS HUMANOS<br>
				NÓMINA Y PAGO<br>
				DEPARTAMENTO DE RECURSOS HUMANOS
				</p>
			</div>
			<div class="info-oficio">
				<p><b>OFICIO:</b>SSN-DA-SRHNP-RH-RC/<br><br>
				Fecha Y Lugar<br><br>
				<b>ASUNTO:</b> Oficio de Presentación<br><br>
				Fecha oficial</p>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="remitente">
			<label>C. Nombre<br>
			Puesto<br>
			Presente</label>
		</div>
	</div>
	<div class="row">
		<div class="parrafo">Se presenta con usted el C. Nombre contratado como prestado de Servicios Profesionales, con una jornada de 8 horas para cubrir vacante temporal de PUESTO por tiempo determinado,
			con adscripción en UNIDAD el cual será cubierto por presupuesto ESTATAL a partir del día fecha de inicio.
		</div>
	</div>
	<br>

	<div class="row">
		<div class="parrafo">Sin otro particula por el momento, me permito enviarle un cordial saludo</div>
	</div>
	<div class="row">
			<div class="col-12 text-center atentamente">
				<br>
				<p>A T E N T A M E N T E <br><br><br>
					NOMBRE<br>
					DIRECTOR DE ADMINISTRACIÓN</p><br><br></div>

	</div>

	<div class="row">
		<div class="col-4 text-center firmas">
			<label>ELABORÓ</label><br><br><br><br>
			<label>_________________________________</label><br>
			<label>NOMBRE</label><br>
			<label>Coordinador de reclutamiento</label>
		</div>
		<div class="col-4 text-center firmas">
			<label>REVISÓ</label><br><br><br><br>
			<label>_________________________________</label><br>
			<label>NOMBRE</label><br>
			<label>JEFE DEL DEPARTEMENTO DE RECURSOS HUMANOS</label>
		</div>
		<div class="col-4 text-center firmas">
			<label>Vo. Bo.</label><br><br><br><br>
			<label>_________________________________</label><br>
			<label>NOMBRE</label><br>
			<label>SUBDIRECCTOR DE RECURSOS HUMANOS, NOMINA Y PAGO</label>
		</div>
	</div>
	<div class="row ccp">
		<div class="col-1">CCP</div>
		<div class="col-9">
			<label>	1</label><br>
			<label>	2</label><br>
			<label>NOMBRE</label><br>
			<label>JEFE DEL DEPARTEMENTO DE RECURSOS HUMANOS</label></div>

	</div>


</div>
</form>
</html>
