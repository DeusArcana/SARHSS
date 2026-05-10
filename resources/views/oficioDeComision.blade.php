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
				<b>ASUNTO:</b> Cambio de Adscripción<br><br>
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
		<div class="parrafo">De conformidad en la fracción XVII del articulo 32 del Reglamento Interior de los Servicios de Salud de Nayarit, y con fundamento en el articulo 149 de las Condiciones Genrales de Trabajo, se informa que, a partir del dia DIA DE INICIO y hasta
			DIA DE FIN, se autoriza comisión a la JURISDICCION.
		</div>
	</div>
	<br>
	<div class="row">
		<div class="parrafo">Por lo que debera presentarse con el JEFE DEL AREA, JEFE/DIRECTOR UNIDAD, a fin de recibir las indicaciones correspondientes dentro de los cuatro días hábiles siguientes contados a partir del inicio de su comisión, ya que de lo contrario incurrirá en la causal de abandono de empleo y
		 se estaria en lo dispuesto por los articulos 28,30 fraccion 1,32,135 y demas relativos aplicables de las Condiciones Generales de Trabajo de la Secretaía de Salud
	 	</div>
	</div>
	<br>
	<div class="row">
		<div class="parrafo">No omito aclarar a usted que su adscripción <b>REAL</b> es UNIDAD DE ADSCRIPCION en el PUESTO con clave:CLAVE</div>
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
