<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <script src="http://code.jquery.com/jquery-1.10.2.js"></script> 
</head>   
<body>


	<script type="text/javascript">
$(function() { 

    $("#bt").click(function() { 

		$.post("http://localhost:8090/Mapics/Controller/img_down.php", 
			{id:'asdf'}, 
			function(obj) { 

				 var el = $("#dataTable"), 

				 html = ""; 

				 if(obj.state == "err") { 

				    alert( obj.msg ); 

				    return; 

				 } 

				 obj.data.forEach(function(data) { 

				    html += "<tr>"; 

				    html += "<td>"+ data.map_id +"</td>"; 

				    html += "<td>"+ data.mapCapture +"</td>"; 

				    html += "</tr>"; 

				 }) 

				 el.html(html); 

			}, 'json') 

		.fail(function(e) { 

			console.log(e.message); 

		}) 

	 }) 

 }) 




	</script>
	<input type="button" value="보기" id="bt" /> 
	<table id = "dataTable">
	</table>

<!-- <form action="../Controller/test.php" method="POST">
   <input type="hidden" name="map_id" value="2" />
   <input type="hidden" name="dtdt" value="태그네임5"/>
   <input type="hidden" name="nickname" value="my nick name"/>
   <textarea name="tag_name" rows="4"></textarea>
   <input type="submit" value="upload" />
</form> -->
</body>
</html>
