$(document).ready(function() {
	$("#input").keydown(function(e) {
		if(e.keyCode == 13) {
			var tr = document.createElement("tr");
			var td = document.createElement("td");
			tr.appendChild(td);
			td.appendChild(document.createTextNode("Vincent: " + $("#input").val() + ""));
			document.getElementById("table").getElementsByTagName("tbody")[0].appendChild(tr);


			if($("#input").val === "siapa") {
				//jadiin ijo terus tambah kata
			}

			$("#input").val("");
		}
	});

	var getDivHeight = function() {
		var windowHeight = parseInt($(window).height());
		var headerHeight = parseInt($("#header").outerHeight());
		var footerHeight = parseInt($("#footer").outerHeight());
		var paddingTop = parseInt($("#chatDiv").css('padding-top'));
		var paddingBottom = parseInt($("#chatDiv").css('padding-bottom'));

		var height = windowHeight - headerHeight - footerHeight - paddingTop - paddingBottom;
		return height + "px";
	};
	$("#chatDiv").height(getDivHeight());
});