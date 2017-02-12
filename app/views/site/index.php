<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Feedback</title>
</head>
<body>
<form action="/save" method="post">
    <p>Login: <input type="text" name="login"></p>
    <p>Email: <input type="text" name="email"></p>
    <p>Text: <br>
    <textarea name="text"></textarea>
    </p>
    <p><input type="button" value="Предварительный просмотр"></p>
    <p><input type="submit" name="submit" value="Send"></p>
</form>
<?php
    echo "<pre>";
    print_r($feedbackList);
    echo "</pre>";
?>
</body>
</html>