<?php
    try{
        $bdd =new PDO("mysql:host=localhost:3308;dbname=form", 'salash', 'Mogwey13');
    }
    catch(PDOException $e){
        echo $e->getmessage();
    }

    @$connect_pseudo = htmlspecialchars($_POST['connect_pseudo']);
    @$connect_mail = $_POST['connect_mail'];
    @$connect_mdp = $_POST['connect_mdp'];
    @$connect_submit = $_POST['connect_submit'];
    @$erreur = '';

    

    if(isset($connect_submit)){
        
        if(!empty($connect_pseudo) AND !empty($connect_mail) AND !empty($connect_mdp) ){
            $req = $bdd->prepare("SELECT * FROM membres WHERE pseudo = ? AND mail = ? AND motsdepass = ? ");
            $req-> execute(array( $connect_pseudo, $connect_mail, $connect_mdp  ));
            $count = $req->rowCount();
            
            if($count == 1){
                $info = $req->fetch(); 
                $_SESSION['id']=  $info['id'];          
                header('Location: Home.php?id='. $_SESSION['id']);
            }

        } else {
          $erreur = "veuillez remplire les champs";
        }
        
        
 
    }        
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>page connexion</title>
    
</head>
<body>
<h1> page connexion </h1>
<form action="" method="post">
    
    <input type="text" name="connect_pseudo" placeholder="Votre pseudo"><br>
    <input type="text" name="connect_mail" placeholder="Votre email"><br>
    <input type="password" name="connect_mdp" placeholder="Votre mdp"><br>
    <input type="submit" name="connect_submit" value=" connexion">
    </form>
    <?php 
        echo $erreur;
    ?>
    
</body>
</html>