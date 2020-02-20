<?php
    try{
        $bdd =new PDO("mysql:host=localhost:3308;dbname=form", 'salash', 'Mogwey13');
    }
    catch(PDOException $e){
        echo $e->getmessage();
    }

    @$pseudo = $_POST['pseudo'];
    @$mail = $_POST['mail'];
    @$mdp = $_POST['mdp'];
    @$mdp2 = $_POST['mdp2'];
    @$submit = $_POST['submit'];
    @$erreur = '';

    if(isset($submit)){
        if(!empty($pseudo) AND !empty($mail) AND !empty($mdp) AND !empty($mdp2)){
            
            $req = $bdd->prepare("SELECT * FROM membres WHERE mail = ? AND pseudo = ?" );
            $req-> execute(array( $mail, $pseudo));
            $count = $req->rowCount();

            if($count == 0){
                if($mdp === $mdp2){
                    if(filter_var($mail, FILTER_VALIDATE_EMAIL)){
                        $insert = $bdd-> prepare("INSERT INTO membres(pseudo, mail, motsdepass) VALUES(?,?,?)");
                        $verif = $insert->execute(array($pseudo, $mail, $mdp));
                            if($verif){
                              header('Location: connexion.php');
                            }
                            else{
                                $erreur="une erreur est survenue";
                            }
                        
                    }
                    else {
                        $erreur =" rentrer un mail valide";
                    }

                }
                else {
                    $erreur ="mdp pas identique";
                }

                }
                else {
                $erreur ="vous etes deja inscrit connecté vous <a href='connexion.php'>click ici</a>";
            }


        } 
        else {
            $erreur = "veuillez remplire les champs";
        }
    }
        
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire</title>
</head>
<body>
    <form action="" method="post">
    <p>vous éte deja inscrit?<a href='connexion.php'>click ici</a>"</p>
    <input type="text" name="pseudo" placeholder="Votre pseudo"><br>
    <input type="text" name="mail" placeholder="Votre email"><br>
    <input type="password" name="mdp" placeholder="Votre mdp"><br>
    <input type="password" name="mdp2" placeholder="Votre mdp2"><br>
    <input type="submit" name="submit" value=" enregistrer">
    <?php echo $erreur; ?>
    </form>
</body>
</html>

