<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Feedback</title>
</head>
<body>
<?php
    if(!empty($feedbackList))
    {
        foreach($feedbackList as $item)
        {
            echo "Login: {$item['login']}</br>";
            echo "Email: {$item['email']}</br>";
            echo "Text: {$item['text']}</br>";
            echo "Date: {$item['feed_date']}</br>";

            if($item['image_path'] != 'NULL')
            {
                echo "Img:</br><img src='/imageStorage/{$item['image_path']}'></br>";
            }

            echo "<hr>";
        }
    }
?>
<form action="/save" method="post" enctype="multipart/form-data">
    <p>Login: <input type="text" name="login"></p>
    <p>Email: <input type="text" name="email"></p>
    <p>Text: <br>
    <textarea name="text"></textarea>
    </p>
    <p><input type="file" name="file"></p>
    <p><input type="button" value="Предварительный просмотр"></p>
    <p><input type="submit" name="submit" value="Send"></p>
</form>
</body>
</html>