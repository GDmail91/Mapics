<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
</head>   
<body>
<form action="http://localhost:8090/Mapics/Controller/img_reg.php" method="POST" name="addForm" enctype="multipart/form-data">
   <input type="hidden" name="user_id" value="1" />
   <input type="hidden" name="map_name" value="하하" />
   <input type="hidden" name="map_locate" value="Jeju"/>
   <input type="hidden" name="dest_id" value="2"/>
   <input type="hidden" name="map_id" value="3"/>
   <input type="hidden" name="loc_x" value="32.141414"/>
   <input type="hidden" name="loc_y" value="19.191919"/>
   
   <input type="hidden" name="description" value="아름다운 제주도"/>
   <input type="file" id="uploaded_file" name="uploaded_file"/>
   <textarea name="dfadf" rows="4"></textarea>
   <input type="submit" value="upload" />
</form>
</body>
</html>
