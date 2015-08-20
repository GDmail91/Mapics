<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
</head>   
<body>
<form action="../Controller/edit_user.php" method="POST">
   <input type="hidden" name="user_id" value="2" />
   <input type="hidden" name="email" value="tester@test.com" />
   <input type="hidden" name="phone" value="01012345678"/>
   <input type="hidden" name="nickname" value="테스트닉2"/>
   <input type="hidden" name="career" value="DESIGNER"/>
   <textarea name="tag_name" rows="4"></textarea>
   <input type="submit" value="upload" />
</form>
</body>
</html>
