
$(document).ready(function() {


// $('#myform').validate({ // initialize the plugin
//         rules: {
//             userName: {
//                 required: true
//             },
//             password: {
//                 required: true,
//                 minlength: 8
//             }
//         }
//     });


// only for demo purposes


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


// document.getElementById("un").style.display="inline";
// 	document.getElementById("un").innerHTML = "must filled. It can only contain letters and numbers.";
	
// 	$("#userName").focusin(function(){
// 		document.getElementById("un").style.display="none";
			
// 	});
// $("#userName").focusout(function(){
		
// 		var x = document.getElementById("userName").value;
// 		var y = document.getElementById("userName").value.length;

		
// 		if(y==0){
			

// 	document.getElementById("un").style.display="inline";
// 	document.getElementById("un").innerHTML = "must filled. It can only contain letters and numbers.";

// 		}

		





// var checkun = 0;

// 		if(y!=0){

// 	var ch = 0;
// 			for(var temp=0;temp<y;temp++){
// 				var letter = x[temp];
// 				if(!((letter>=0&&letter<=9)||(letter>='a'&&letter<='z')||(letter>='A'&&letter<='Z')))
// 					ch = 1;
// 			}
// 			if(ch==1)
// 				checkun = 1;
// 		}


// 		if(checkun==1){


// 			document.getElementById("un").style.display="inline";
// 			document.getElementById("un").innerHTML = "It can only contain letters and numbers.";
// 		}

	
// 	});








// document.getElementById("pw").style.display="inline";
// 	document.getElementById("pw").innerHTML = "must filled. At lease 8 characters. At least one capital letter, one small letter and one number.";
	
// 	$("#inputPassword").focusin(function(){
// 		document.getElementById("pw").style.display="none";
			
// 	});
// $("#inputPassword").focusout(function(){
		
// 		var x = document.getElementById("inputPassword").value;
// 		var y = document.getElementById("inputPassword").value.length;

		
// 		if(y==0){
			

// 	document.getElementById("pw").style.display="inline";
// 	document.getElementById("pw").innerHTML = "must filled. At lease 8 characters. At least one capital letter, one small letter and one number.";

// 		}


// 		else if(y<8){
			

// 	document.getElementById("pw").style.display="inline";
// 	document.getElementById("pw").innerHTML = "At lease 8 characters.";

// 		}





// 		var check1 = 0;
// 		var check2 = 0;
// 		var check3 = 0;
// 		if(y>=8){

	
// 			for(var temp=0;temp<y;temp++){
// 				var letter = x[temp];
// 				if(letter>=0&&letter<=9)
// 					check1 =  1;
// 			}
// 		for(var temp=0;temp<y;temp++){
// 				var letter = x[temp];
// 				if(letter>='a'&&letter<='z')
// 					check2 =  1;
// 			}


// for(var temp=0;temp<y;temp++){
// 				var letter = x[temp];
// 				if(letter>='A'&&letter<='Z')
// 					check3=  1;
// 			}






// 		if(check1!=1||check2!=1||check3!=1){


// 			document.getElementById("pw").style.display="inline";
// 			document.getElementById("pw").innerHTML = "At least one capital letter, one small letter and one number.";
// 		}

// 	}


	
// 	});
















});