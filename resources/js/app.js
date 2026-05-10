require('./bootstrap');

window.Vue = require('vue');

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

const app = new Vue({
    el: '#app'
});

import $ from 'jquery';
window.$ = window.jQuery = $;

// import 'jquery-ui/ui/widgets/datepicker.js';
require('bootstrap-datepicker/js/bootstrap-datepicker.js');
require('bootstrap-datepicker/dist/locales/bootstrap-datepicker.es.min.js');
require('datatables.net');
require('datatables.net-bs4');
require('datatables.net-responsive');
require('datatables.net-responsive-bs4');

/*==================================
=            DatePicker            =
==================================*/
$('.datepicker').datepicker({
	language: 			'es',
	format: 			'yyyy-mm-dd',
	defaultViewDate:	'1950-01-01',
	startView:			2,
	todayHighlight: 	true,
	autoclose: 			true
});
/*=====  End of DatePicker  ======*/



/*=====================================
=            AJAX Requests            =
=====================================*/

/*----------  DOMICILIOS  ----------*/

$("#domicilios").on('click','.btn-agregar-colonias', function() {

	var boton			= $(this);
	var codigoPostal	= $(boton).closest("#domicilios").find('input[name="codigo_postal"]').val();

	if(codigoPostal) {
		$.ajax({
			url: 		'/API/sepomex/' + codigoPostal,
			type: 		"GET",
			dataType: 	"json",
			success:	function(data) {
				if(data){
					$(boton).closest("#domicilios").find('select[id="asentamiento"]').empty();
					$(boton).closest("#domicilios").find('select[id="asentamiento"]').focus;
					$(boton).closest("#domicilios").find('select[id="asentamiento"]').append('<option value="">-- Seleccionar colonia --</option>');

					$.each(data, function(key, value){
						$(boton).closest("#domicilios")
								.find('select[id="asentamiento"]')
								.append('<option value="'+ value.id +'">' + value.asentamiento+ '</option>');
					});

				} else {
					$(boton).closest("#domicilios").find('select[id="asentamiento"]').empty();
				}
			}
		});
	} else {
		$(boton).closest(".col-xs-4")
				.find('select[id="asentamiento"]')
				.empty();
	}
});

/*----------  SERVICIOS  ----------*/

$('select[name="servicio"]').on('change', function() {
	var servicioID = $(this).val();
	$("#input_puesto_alter").nextUntil('.form-group').remove();

	var cadena = $('select[name="base"] option:selected').text().substring(6);
	if(cadena != 'Contrato'){
		$("#puesto_alter").hide();
		document.getElementById("input_puesto_alter").value ="" ;
		document.getElementById("cpre_puesto").value ="" ;
		$("#puesto_alter").hide();
		document.getElementById("input_puesto_alter").value ="" ;
		document.getElementById("cpre_puesto").value ="" ;
		if(servicioID) {
			$.ajax({
				url: 		'/API/puestos/' + servicioID,
				type: 		"GET",
				dataType: 	"json",
				success: 	function(data) {
					if(data){
						$('select[name="servicio_puesto"]').empty();
						$('select[name="servicio_puesto"]').focus;
						$('select[name="servicio_puesto"]').append('<option value="">-- Seleccionar puesto --</option>');

						$.each(data, function(key, value){
							$('select[name="servicio_puesto"]')
								.append('<option value="' + value.ID_Servicio_Puesto + '">' + value.Puesto_Nombre + '</option>');
						});
						$('select[name="servicio_puesto"]').append('<option value="">Otro</option>');
					} else {
						$('select[name="servicio_puesto"]').empty();
					}
				}
			});
		} else {
			$('select[name="servicio_puesto"]').empty();
		}
	}


});


$('select[name="curso"]').on('change', function() {
	var curso = $(this).val();

	if(curso==""){
		$("#nombre_curso").prop('readonly', false);
		$("#institucion_curso").prop('readonly', false);
		document.getElementById("nombre_curso").value ="" ;
		document.getElementById("institucion_curso").value ="" ;
	}
	else{if(curso) {
		$.ajax({
			url: 		'/API/cursos/' + curso,
			type: 		"GET",
			dataType: 	"json",
			success: 	function(data) {
				if(data){
					$("#nombre_curso").prop('readonly', true);
					$("#institucion_curso").prop('readonly', true);
					document.getElementById("nombre_curso").value =data.Nombre;
					document.getElementById("institucion_curso").value =data.Institucion ;

				} else {

				}
			}
		});
	}}

});

/*----------  PUESTOS  ----------*/

/*$('select[name="puesto"]').on('change', function() {
	var servicioPuestoID = $(this).val();

	if(servicioPuestoID) {
		$.ajax({
			url: 		'/empleados/getUnidades/'+servicioPuestoID,
			type: 		"GET",
			dataType: 	"json",
			success: 	function(data) {
				if(data){
					$('select[name="unidad"]').empty();
					$('select[name="unidad"]').focus;
					$('select[name="unidad"]').append('<option value="">-- Seleccionar unidad--</option>');

					$.each(data, function(key, value){
						$('select[name="unidad"]')
							.append('<option value="' + value.ID_Unidad + '">' + value.CLUES + '-' + value.Nombre_Unidad + '</option>');
					});

				} else {
					$('select[name="unidad"]').empty();
				}
			}
		});
	} else {
		$('select[name="unidad"]').empty();
	}
});
*/
/*----------  UNIDADES MÉDICAS  ----------*/

/*
var timer = null;
$('input[name="clues_adscrita"]').keyup(function(){
	   var clues 	= $(this).val();

	   var form		= $(this);
	   clearTimeout(timer);
       timer = setTimeout(function(){unidadAdscrita(clues,form);}, 3000);
});

function unidadAdscrita(clues,form) {

	$.ajax({
		url: 		'/API/unidades/getUnidadClues/' + clues,
		type: 		"GET",
		dataType: 	"json",
		success: 	function(data) {
			console.log(data);
			if(!isEmpty(data)) {
				if(!form.next().is('.alert') ){
					form.after('<div class="alert alert-primary"><label>Unidad: ' + data.Nombre + '</label><input name="unidad_adscrita" type="hidden" value="' + data.ID_Unidad + '"></div>');
				} else{
					form.nextUntil('.form-group').remove();
					form.after('<div class="alert alert-primary"><label>Unidad: ' + data.Nombre + '</label><input name="unidad_adscrita" type="hidden" value="' + data.ID_Unidad + '"></div>');
				}
			} else {
				if(!form.next().is('.alert') ){
					form.after('<div class="alert alert-danger"><label>Unidad no encontrada</label></div>');

				} else {
					form.nextUntil('.form-group').remove();
					form.after('<div class="alert alert-danger"><label>Unidad no encontrada</label></div>');
				}
			}
		}
	});
}

$('input[name="clues_fisica"]').keyup(function(){
	   var clues 	= $(this).val();
	   var form		= $(this);
	   clearTimeout(timer);
       timer = setTimeout(function(){unidadFisica(clues,form);}, 3000);
});

function unidadFisica(clues,form) {
	$.ajax({
		url: 		'/API/unidades/getUnidadClues/' + clues,
		type: 		"GET",
		dataType: 	"json",
		success: 	function(data) {


			if(!isEmpty(data)) {
				if(!form.next().is('.alert') ){
					form.after('<div class="alert alert-primary"><label>Unidad: ' + data.Nombre + '</label><input name="unidad_fisica" type="hidden" value="' + data.ID_Unidad + '"></div');
				} else{
					form.nextUntil('.form-group').remove();
					form.after('<div class="alert alert-primary"><label>Unidad: ' + data.Nombre + '</label><input name="unidad_fisica" type="hidden" value="' + data.ID_Unidad + '"></div>');
				}
			} else {
				if(!form.next().is('.alert') ){
					form.after('<div class="alert alert-danger"><label>Unidad no encontrada</label></div>');

				} else {
					form.nextUntil('.form-group').remove();
					form.after('<div class="alert alert-danger"><label>Unidad no encontrada</label></div>');
				}
			}
		}
	});
}
*/
$(".btn-buscar-unidad-adscrita").on('click', function(){
	var form 	= $(this);
	var clues 	= form.closest('.form-group').find('input[name="clues_adscrita"]').val();

	if(clues!=""){
		$.ajax({
			url: 		'/API/unidades/getUnidadClues/' + clues,
			type: 		"GET",
			dataType: 	"json",
			success: 	function(data) {

				if(!isEmpty(data)) {
					if(!form.closest('.form-row').next().is('.alert') ){
						form.closest('.form-row').after('<div class="alert alert-primary"><label>Unidad: ' + data.Nombre + '</label><input name="unidad_adscrita" type="hidden" value="' + data.ID_Unidad + '"></div>');
					} else{
						form.closest('.form-row').nextUntil('.form-group').remove();
						form.closest('.form-row').after('<div class="alert alert-primary"><label>Unidad: X' + data.Nombre + '</label><input name="unidad_adscrita" type="hidden" value="' + data.ID_Unidad + '"></div>');
					}
				} else {
					if(!form.closest('.form-row').next().is('.alert') ){
						form.closest('.form-row').after('<div class="alert alert-danger"><label>Unidad no encontrada</label></div>');

					} else {
						form.closest('.form-row').nextUntil('.form-group').remove();
						form.closest('.form-row').after('<div class="alert alert-danger"><label>Unidad no encontrada</label></div>');
					}
				}
			}
		});
	} else {
		if(!form.closest('.form-row').next().is('.alert') ){
			form.closest('.form-row').after('<div class="alert alert-danger"><label>Unidad no encontrada</label></div>');

		} else {
			form.closest('.form-row').nextUntil('.form-group').remove();
			form.closest('.form-row').after('<div class="alert alert-danger"><label>Unidad no encontrada</label></div>');
		}
	}

});

$(".btn-buscar-unidad-fisica").on('click', function(){
	var form 	= $(this);
	var clues 	= form.closest('.form-group').find('input[name="clues_fisica"]').val();
	if(clues!=""){
		$.ajax({
			url: 		'/API/unidades/getUnidadClues/' + clues,
			type: 		"GET",
			dataType: 	"json",
			success: 	function(data) {

				if(!isEmpty(data)) {
					if(!form.closest('.form-row').next().is('.alert') ){
						form.closest('.form-row').after('<div class="alert alert-primary"><label>Unidad: ' + data.Nombre + '</label><input name="unidad_fisica" type="hidden" value="' + data.ID_Unidad + '"></div>');
					} else{
						form.closest('.form-row').nextUntil('.form-group').remove();
						form.closest('.form-row').after('<div class="alert alert-primary"><label>Unidad: ' + data.Nombre + '</label><input name="unidad_fisica" type="hidden" value="' + data.ID_Unidad + '"></div>');
					}
				}  else {
					if(!form.closest('.form-row').next().is('.alert') ){
						form.closest('.form-row').after('<div class="alert alert-danger"><label>Unidad no encontrada</label></div>');

					} else {
						form.closest('.form-row').nextUntil('.form-group').remove();
						form.closest('.form-row').after('<div class="alert alert-danger"><label>Unidad no encontrada</label></div>');
					}
				}
			}
		});
	} else {
		if(!form.closest('.form-row').next().is('.alert') ){
			form.closest('.form-row').after('<div class="alert alert-danger"><label>Unidad no encontrada</label></div>');

		} else {
			form.closest('.form-row').nextUntil('.form-group').remove();
			form.closest('.form-row').after('<div class="alert alert-danger"><label>Unidad no encontrada</label></div>');
		}
	}

});

/*--------------CLAVE PRESUPUESTAL--------------------*/
$('select[name="base"]').on('change', function() {
	var form = $(this);
	var base = $(this).val();
	var cadena = $('option:selected',form).text().substring(6);


	if(cadena == 'Contrato'){
		document.getElementById("cpre_base").value ="" ;
		document.getElementById("cpre_puesto").value ="" ;
		$('#servicio').show();
		$('#puesto').hide();
		$("#cpre_base").hide();
		$("#cpre_puesto").hide();
		$("#puesto_alter").show();
		document.getElementById("cpre_puesto").value ="";

	}
	else{
		$('#servicio').show();
		$('#puesto').show();
		$("#cpre_base").show();
		$("#cpre_puesto").show();
		document.getElementById("cpre_puesto").value ="";
		$("#puesto_alter").hide();
		document.getElementById("input_puesto_alter").value ="";
		$("#input_puesto_alter").nextUntil('.form-group').remove();

		$.ajax({
		url: 		'/API/puestos/getBase/' + base,
		type: 		"GET",
		dataType: 	"json",
		success: 	function(data) {

			if($.trim(data)) {

				//form.closest(".container").find("#clave_presupuestal").append(
					//'<label>Codigo: ' + data.Codigo + ' Clave:'+data.Complemento_Clave_Presupuestal+' </label>');
				if(document.getElementById("cpre_base").value==""){
				document.getElementById("cpre_base").value += data.Codigo + data.Complemento_Clave_Presupuestal ;
				}
				else {
					document.getElementById("cpre_base").value ="" ;
					document.getElementById("cpre_base").value += data.Codigo + data.Complemento_Clave_Presupuestal ;
				}
			}
		}
	});}


});

$('select[name="servicio_puesto"]').on('change', function() {
	var form = $(this);
	var puesto = $(this).val();
	var cadena = $('select[name="servicio_puesto"] option:selected').text();

	if(cadena=='Otro'){
		$("#puesto_alter").show();
		document.getElementById("cpre_puesto").value ="" ;
		document.getElementById("input_puesto_alter").value ="" ;
	}

	else{
	$("#input_puesto_alter").nextUntil('.form-group').remove();

	$("#puesto_alter").hide();
	document.getElementById("input_puesto_alter").value ="" ;


	var cadena = $('select[name="base"] option:selected').text().substring(6);
	if(cadena == 'Contrato'){

	}
	else{$.ajax({
		url: 		'/API/puestos/getPuesto/' + puesto,
		type: 		"GET",
		dataType: 	"json",
		success: 	function(data) {

			if($.trim(data)) {
				if(document.getElementById("cpre_puesto").value==""){
				document.getElementById("cpre_puesto").value += data.Codigo;
				}
				else {
					document.getElementById("cpre_puesto").value ="" ;
					document.getElementById("cpre_puesto").value += data.Codigo;
				}
			}
		}
	});}}

});

$(".btn-buscar-puesto").on('click', function(){
	var form 	= $(this);
	var codigo	= form.closest('.form-group').find('input[name="puesto_alter"]').val();
	if(codigo!=""){
		$.ajax({
			url: 		'/API/puestos/getPuestoCodigo/' + codigo,
			type: 		"GET",
			dataType: 	"json",
			success: 	function(data)  {

				if(!isEmpty(data)) {
					if(!form.closest('.form-row').next().is('.alert') ){
						form.closest('.form-row').after('<div class="alert alert-primary"><label>Codigo: '+data.Codigo+' Puesto: ' + data.Nombre + '</label><input name="puesto_alternativo" type="hidden" value="' + data.ID_Puesto + '"></div>');
						document.getElementById("cpre_puesto").value += data.Codigo;
					} else{
						form.closest('.form-row').nextUntil('.form-group').remove();
						document.getElementById("cpre_puesto").value ="" ;
						document.getElementById("cpre_puesto").value += data.Codigo;
						form.closest('.form-row').after('<div class="alert alert-primary"><label>Codigo: '+data.Codigo+' Puesto: ' + data.Nombre + '</label><input name="puesto_alternativo" type="hidden" value="' + data.ID_Puesto + '"></div>');
					}
				}  else {
					if(!form.closest('.form-row').next().is('.alert') ){
						form.closest('.form-row').after('<div class="alert alert-danger"><label>Puesto no encontrado</label></div>');

					} else {
						form.closest('.form-row').nextUntil('.form-group').remove();
						form.closest('.form-row').after('<div class="alert alert-danger"><label>Puesto no encontrado</label></div>');
					}
				}
			}
		});
	} else {
		if(!form.closest('.form-row').next().is('.alert') ){
			form.closest('.form-row').after('<div class="alert alert-danger"><label>Puesto no encontrado</label></div>');

		} else {
			form.closest('.form-row').nextUntil('.form-group').remove();
			form.closest('.form-row').after('<div class="alert alert-danger"><label>Puesto no encontrado</label></div>');
		}
	}

});

/*
$('input[name="puesto_alter"]').keyup(function(){
	   var codigo 	= $(this).val();
	   var form		= $(this);

	   clearTimeout(timer);
       timer = setTimeout(function(){puestoAlter(codigo,form);}, 3000);
});

function puestoAlter(codigo,form) {

	$.ajax({
		url: 		'/API/puestos/getPuestoCodigo/' + codigo,
		type: 		"GET",
		dataType: 	"json",
		success: 	function(data) {

			console.log(data);
			if(!isEmpty(data)) {

				if(!form.next().is('.alert') ){
					form.after('<div class="alert alert-primary"><label>Codigo: '+data.Codigo+' Puesto: ' + data.Nombre + '</label><input name="puesto_alternativo" type="hidden" value="' + data.ID_Puesto + '"></div>');
					document.getElementById("cpre_puesto").value += data.Codigo;
				} else{
					form.nextUntil('.form-group').remove();
					document.getElementById("cpre_puesto").value ="" ;
					document.getElementById("cpre_puesto").value += data.Codigo;
					form.after('<div class="alert alert-primary"><label>Codigo: '+data.Codigo+' Puesto: ' + data.Nombre + '</label><input name="puesto_alternativo" type="hidden" value="' + data.ID_Puesto + '"></div>');
				}
			} else {
				if(!form.next().is('.alert') ){

					form.after('<div class="alert alert-danger"><label>Puesto no encontrado</label></div>');

				} else {
					form.nextUntil('.form-group').remove();
					form.after('<div class="alert alert-danger"><label>Puesto no encontrado</label></div>');

				}
			}
		}
	});
}*/
/*-------HORAS-----*/
$('#horas').on('change', function() {
	var form = $(this);
	var base = $(this).val();
	var cadena = $('option:selected',form).text();



	if(cadena == 'TURNO MIXTO'){


		$.ajax({
		url: 		'/API/turnos/' + cadena,
		type: 		"GET",
		dataType: 	"json",
		success: 	function(data) {

				if($.trim(data)) {
					$('select[name="turno"]').empty();
					$('select[name="turno"]').focus;
					$('select[name="turno"]').append('<option value="">-- Seleccionar horas --</option>');
					var check = 0;
					var cad ="";
					$.each(data, function(key, value){
						if(check!=value.ID_Turno){
							cad+='<option value="' + value.ID_Turno + '">-- ' + value.Turno + ' y ';
							check=value.ID_Turno;
						}
						else{
							cad+=' ' + value.Turno + '</option>';
							check=0;
						}

					});
					$('select[name="turno"]').append(cad);


				}
			}
		});
	}
	else{
		$.ajax({
		url: 		'/API/turnos/' + cadena,
		type: 		"GET",
		dataType: 	"json",
		success: 	function(data) {

				if($.trim(data)) {
					$('select[name="turno"]').empty();
					$('select[name="turno"]').focus;
					$('select[name="turno"]').append('<option value="">-- Seleccionar horas --</option>');

					$.each(data, function(key, value){
						$('select[name="turno"]')
							.append('<option value="' + value.ID_Turno + '">-- ' + value.Turno + ' --</option>');
					});

				}
			}
		});
	}

});


/*=====  End of AJAX Requests  ======*/


/*================================================
=            Inyección de Componentes            =
================================================*/

/*----------  DOMICILIOS  ----------*/

var agregar_domicilios = $("#domicilios").html();

$("#btn-domicilios").click(function(){
    // Agregamos el formulario
    $("#domicilios").append(agregar_domicilios);

    // Agregamos un boton para retirar el formulario
    $("#domicilios .col-sm-4:last .well")
    	.append('<button class="btn-danger btn btn-block btn-retirar-domicilios" type="button">Retirar</button><br>');
});

// Cuando hacemos click en el boton de retirar
$("#domicilios").on('click', '.btn-retirar-domicilios', function(){
	$(this).closest('.col-sm-4').remove();
});

/*----------  ESTUDIOS  ----------*/

var agregar_gradoEstudios = $("#gradoDeEstudios").html();

$("#btn-gradoDeEstudios").click(function(){
	// Agregamos el formulario
	$("#gradoDeEstudios").append(agregar_gradoEstudios);

	// Agregamos un boton para retirar el formulario
	$("#gradoDeEstudios .col-sm-4:last .well")
		.append('<button class="btn-danger btn btn-block btn-retirar-gradoDeEstudios" type="button">Retirar</button><br>');
});

// Cuando hacemos click en el boton de retirar
$("#gradoDeEstudios").on('click', '.btn-retirar-gradoDeEstudios', function(){
	$(this).closest('.col-sm-4').remove();
});

/*----------  CLUES  ----------*/
$('select[name="oficio"]').on('change', function() {
	var form = $(this);
	var base = $(this).val();
	var cadena = $('option:selected',form).text();

	if(cadena=="Permanente"){


	}
	else {

	}


});

$('input[type=radio][name=result]').change(function() {
    if (this.value == 'permantene') {
		document.getElementById("input_numero_oficio").value ="";
		document.getElementById("input_clues_fisica").value ="";
		document.getElementById("input_clues_adscrita").value="";
		$('#numero_oficio').hide();
		$('#clues_adscrita').show();
		$('#clues_fisica').hide();

		if($('#clues_adscrita').find('.btn-buscar-unidad-adscrita').next().is('.alert')){
			$('#clues_adscrita').find('.btn-buscar-unidad-adscrita').nextUntil('.form-group').remove();
		}
		if($('#clues_fisica').find('.btn-buscar-unidad-fisica').next().is('.alert')){
			$('#clues_fisica').find('.btn-buscar-unidad-fisica').nextUntil('.form-group').remove();
		}
    }
    else if (this.value == 'comisionado') {
		if($('#clues_adscrita').find('.btn-buscar-unidad-adscrita').next().is('.alert')){
			$('#clues_adscrita').find('.btn-buscar-unidad-adscrita').nextUntil('.form-group').remove();
		}
		document.getElementById("input_numero_oficio").value ="";
		document.getElementById("input_clues_fisica").value ="";
		document.getElementById("input_clues_adscrita").value="";
		$('#clues_adscrita').show();
		$('#numero_oficio').show();
		$('#clues_fisica').show();
    }
});
/*=====  End of Inyección de Componentes  ======*/

/*===================================
=            DATA TABLES            =
===================================*/
$('#empleados-table').DataTable({
	responsive: true,
	language: {
		searchPlaceholder: 	"Busqueda",
		info: 				"Mostrando pagina _PAGE_ de _PAGES_",
		lengthMenu: 		"Mostrar _MENU_ registros por pagina",
		zeroRecords: 		"Lo sentimos, no se encontro nada",
		infoEmpty: 			"Sin registros disponibles",
		processing:     	"Procesando...",
		search:         	"Buscar:",
		infoFiltered: 		"(Filtrado _MAX_ registros totales)",
		paginate: {
				first:      "Primero",
				last:       "Último",
				next:       "Siguiente",
				previous:   "Anterior"
		}
	}
});


$('#unidades-table').DataTable({
	responsive: true,
	language: {
		searchPlaceholder: 	"Busqueda",
		info: 				"Mostrando pagina _PAGE_ de _PAGES_",
		lengthMenu: 		"Mostrar _MENU_ registros por pagina",
	    zeroRecords: 		"Lo sentimos, no se encontro nada",
	    infoEmpty: 			"Sin registros disponibles",
		processing:     	"Procesando...",
		search:         	"Buscar:",
	    infoFiltered: 		"(Filtrado _MAX_ registros totales)",
		paginate: {
			first:      "Primero",
			last:       "Último",
			next:       "Siguiente",
			previous:   "Anterior"
		}
	},
	columnDefs: [{
		'searchable'	: false,
		'targets'		: 4
		},
	]
});

$('#show-unidades-empleados').DataTable({
	responsive:true,
	language: {
		searchPlaceholder: 	"Busqueda",
		info: 				"Mostrando pagina _PAGE_ de _PAGES_",
		lengthMenu: 		"Mostrar _MENU_ registros por pagina",
		zeroRecords: 		"Lo sentimos, no se encontro nada",
		infoEmpty: 			"Sin registros disponibles",
		processing: 		"Procesando...",
		search:				"Buscar:",
		infoFiltered: 		"(Filtrado _MAX_ registros totales)",
		paginate: {
			first:      "Primero",
			last:       "Último",
			next:       "Siguiente",
			previous:   "Anterior"
		}
	},
	columnDefs:[
		{
			'searchable'    : false,
			'targets'       : [2, 3, 4, 5]
		},
	]
});

$('table.display').DataTable({
	responsive: true,
	language: {
		searchPlaceholder: 	"Busqueda",
		info: 				"Mostrando pagina _PAGE_ de _PAGES_",
		lengthMenu: 		"Mostrar _MENU_ registros por pagina",
		zeroRecords: 		"Lo sentimos, no se encontro nada",
		infoEmpty: 			"Sin registros disponibles",
		processing: 		"Procesando...",
		search: 			"Buscar: _INPUT_ ",
		infoFiltered: 		"(Filtrado _MAX_ registros totales)",
		paginate: {
			first:      "Primero",
			last:       "Último",
			next:       "Siguiente",
			previous:   "Anterior"
		}
	},

});
$(".delete").on("submit", function(){
        return confirm("¿Borrar?");
    });
$(".clickable-row").click(function() {
	        window.location = $(this).data("href");
});
$('table.t-simple').DataTable({
	dom: 		't',
	ordering: 	false,
	responsive:	true,
	language: {
		zeroRecords: 		"Lo sentimos, no se encontro nada",
		infoEmpty: 			"Sin registros disponibles"
	}
});

/*=====  End of DATA TABLES  ======*/
var hasOwnProperty = Object.prototype.hasOwnProperty;

function isEmpty(obj) {

    // null and undefined are "empty"
    if (obj == null) return true;

    // Assume if it has a length property with a non-zero value
    // that that property is correct.
    if (obj.length > 0)    return false;
    if (obj.length === 0)  return true;

    // If it isn't an object at this point
    // it is empty, but it can't be anything *but* empty
    // Is it empty?  Depends on your application.
    if (typeof obj !== "object") return true;

    // Otherwise, does it have any properties of its own?
    // Note that this doesn't handle
    // toString and valueOf enumeration bugs in IE < 9
    for (var key in obj) {
        if (hasOwnProperty.call(obj, key)) return false;
    }

    return true;
}


//Cambiar Luego
$(document).keypress(
  function(event){
    if (event.which == '13') {
      event.preventDefault();
    }
});

(function($){
	$('.dropdown-menu a.dropdown-toggle').on('click', function(e) {
	  if (!$(this).next().hasClass('show')) {
		$(this).parents('.dropdown-menu').first().find('.show').removeClass("show");
	  }
	  var $subMenu = $(this).next(".dropdown-menu");
	  $subMenu.toggleClass('show');

	  $(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function(e) {
		$('.dropdown-submenu .show').removeClass("show");
	  });

	  return false;
	});
})(jQuery)
