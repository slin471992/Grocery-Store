$(document).ready(function() {
    if ($('body.filter_search').length > 0) {
	   var filter = $("#filter").val()

	   // AJAX
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("filterResult").innerHTML = this.responseText;
            }
        }
        xmlhttp.open("GET", "grocery_list.php?q="+filter, true);
        xmlhttp.send();
    }

	$("#filter").change(function() {
		// get user selected year
		var filter = $("#filter").val()

		// AJAX
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                	document.getElementById("filterResult").innerHTML = this.responseText;
            }
        }
        xmlhttp.open("GET", "grocery_list.php?q="+filter, true);
        xmlhttp.send();
	});

    // search input box
	$("#search_button").click(function() {
		var search = $("#search_input").val();
		// alert($("#search_input").val())
        console.log(search);
		// AJAX
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                	document.getElementById("filterResult").innerHTML = this.responseText;
            }
        }
        if ($("#filter").val() == "") {
            console.log("category empty");
            xmlhttp.open("GET", "grocery_list.php?search="+search, true);
            xmlhttp.send();
        }
        else {
            console.log("not empty");
            console.log($("#filter").val());
            xmlhttp.open("GET", "grocery_list.php?q="+filter+"&search="+search, true);
            xmlhttp.send();
        }

	});

    // AJAX pagination 
    $("#filterResult" ).load( "grocery_list.php"); //load initial records
    
    // AJAX
    $("#filterResult").on( "click", ".pagination a", function (e){
        console.log(this);
        var page = $(this).attr("data-page"); //get page number from link
        var linkfilter = $(this).attr("data-filter"); // get filter information from link
        console.log(page);
        console.log(linkfilter);
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("filterResult").innerHTML = this.responseText;
            }
        }
        // xmlhttp.open("GET", "grocery_list.php?q="+filter+"&search="+search+"&page="+page, true);
        // xmlhttp.send();

        // search input is empty
        // if( $.trim("#search_input").length == 0 ) {
        //     console.log("empty");
        //     xmlhttp.open("GET", "grocery_list.php?q="+filter+"&page="+page, true);
        //     xmlhttp.send();
        // }

        // else {
        //     xmlhttp.open("GET", "grocery_list.php?q="+filter+"&search="+search+"&page="+page, true);
        //     xmlhttp.send();
        // }
        if( $.trim(linkfilter).length == 0 ) {
            console.log("empty");
            xmlhttp.open("GET", "grocery_list.php?page="+page, true);
            xmlhttp.send();
        }
        else {
            xmlhttp.open("GET", "grocery_list.php?page="+page+"&filter="+linkfilter, true);
            xmlhttp.send();
        }
    });


    // if( !$.trim("#search_input").length == 0 ) {
    //     console.log("empty");
    // };
});













