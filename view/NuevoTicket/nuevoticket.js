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