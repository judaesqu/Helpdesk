		function init(){
			$("#ticket_form").on("submit", function(e){
				guardaryeditar(e);
			});

		}

		$(document).ready(function() {
			$('#tick_descrip').summernote({
				height:150
			});

			$.post("../../controller/division.php?op=combo",function(data, status){
				$('#div_id').html(data);
			})
			$('#div_id').on('change', function(){
				var div_id_seleccionado = $(this).val();

				if(div_id_seleccionado){
					$.post(
						"../../controller/novedad.php?op=combo",
					{div_id: div_id_seleccionado},
				function(data, status){
					$('#id_nov').html(data);
				}
			);
				}else{
					$('#id_nov').html('<option value="">Seleccione unaa División</option>');
				}
			});
		});	

		function guardaryeditar(e){
			e.preventDefault();
			var formData = new FormData($("#ticket_form")[0]);
			var nombre_novedad = $('#id_nov option:selected').text();
			formData.append("novedad", nombre_novedad);
			$.ajax({
				url: "../../controller/ticket.php?op=insert",
				type: "POST",
				data: formData,
				contentType: false,
				processData: false,
				success: function(datos){
					console.log(datos);
				}
			});
		}
		init();