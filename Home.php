<?php
    session_start();
        try{
            $bdd =new PDO("mysql:host=localhost:3308;dbname=form", 'salash', 'Mogwey13');
        }
        catch(PDOException $e){
            echo $e->getmessage();
        }
        if(isset($_GET ['id']))
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>home</title>
</head>
<body>
    <h1>bienvenue</h1>
</body>
</html>