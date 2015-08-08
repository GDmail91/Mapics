<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
</head>   
<body>
<form enctype="multipart/form-data" action="../Controller/test.php" method="POST">
   <input type="hidden" name="dest_id" value="3" />
   <input type="hidden" name="user_id" value="1"/>
   <input type="hidden" name="nickname" value="my nick name"/>
   <textarea name="comment" rows="4"></textarea>
   <input type="submit" value="upload" />
</form>
</body>
</html>
