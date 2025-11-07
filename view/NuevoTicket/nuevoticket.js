		$(document).ready(function() {
			$('#tick_descrip').summernote({
				height:150
			});

			$.post("../../controller/division.php?op=combo",function(data, status){
				$('#div_id').html(data);
			})
		});