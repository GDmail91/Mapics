<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
</head>   
<body>
<form enctype="multipart/form-data" action="../Controller/uploadtest.php" method="POST">
   <input type="hidden" name="MAX_FILE_SIZE" value="3000000" />
   <input type="hidden" name="map_id" value="5"/>
   <input type="hidden" name="loc_x" value="7"/>
   <input type="hidden" name="loc_y" value="7"/>
   <input name="uploaded_file" type="file" />
   <input type="submit" value="upload" />
</form>
</body>
</html>
