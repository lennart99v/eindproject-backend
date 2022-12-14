<!DOCTYPE HTML>
<html lang="en-US">
<head>
        <meta charset="UTF-8">
        <title>Micro Blog</title>
				<link rel="stylesheet" type="text/css" href="css/style.css">  
</head>
<body>
        <a href="/index">Home</a>
        <?if($login == 'login'){
                 echo "<a href='/auth/login'>login</a>";    
        } else {
                echo "<a href='/auth/logout'>logout</a>";
        }?>
        <a href="/auth/register"><?=$register?></a>
        <hr>
        <?php echo $content_for_layout;?>
</body>
</html>