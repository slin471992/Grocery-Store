
$(document).ready(function() {


$().ready(function() {
	// validate the form when it is submitted
	var validator = $("#myform").validate({
		errorPlacement: function(error, element) {
			// Append error within linked label
			$( element )
				.closest( "form" )
					.find( "label[for='" + element.attr( "id" ) + "']" )
						.append( error );
		},
		errorElement: "span",
		messages: {


			
			userName: {
				required: " (required)"
				
			},
			inputPassword: {
				required: " (required)",
				minlength: " (must be at least 8 characters)"
			}
		}
	});

	$(".cancel").click(function() {
		validator.resetForm();
	});



var validator2 = $("#2form").validate({
		errorPlacement: function(error, element) {
			// Append error within linked label
			$( element )
				.closest( "form" )
					.find( "label[for='" + element.attr( "id" ) + "']" )
						.append( error );
		},
		errorElement: "span",
		messages: {


			
			exampleInputEmail2: {
				required: " (required)"
				
			},

			exampleInputPassword2: {
				required: " (required)"
				
			}
		}
	});

	$(".cancel").click(function() {
		validator2.resetForm();
	});

});

});