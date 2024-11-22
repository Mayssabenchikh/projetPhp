<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="insert.php" method="GET">
        <label for="name">name</label>
        <input type="text"  required name="name"><br>
        <label for="email">mail</label>
        <input type="email"  required name="email"><br>
        <label for="mdm">password</label>
        <input type="password" required name="passwd"><br>
        <label for="tel">phone number</label>
        <input type="text" name="number">
        <input type="submit" value="Ajouter">
    </form>
</body>
</html>