<?php 
    
    try{
        $bdd = new PDO('mysql:host=;dbname=BDlocation;charset=utf8', 'root', 'mysql92s');
        $bdd ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    }
    catch(Exception $e){
        die('Erreur : ' . $e->getMessage());
    }
   
?>
<!doctype html>
<html lang="fr">
    <head>
        <title>form</title>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    </head>
    <style type="text/css">
        #form{
            border:solid 3px;
            border-radius: 25px;
            position:center;
            width:300px;
            background-color: gray;
            margin-top:30px;
        }
        h1{
            color:red;
            
        }
        span{
            color:black;
            border-bottom:solid 2px;
        }
        
    </style>
    <body> 
            
        <center>
            <h1><span>FORMULAIRE:</span> D'AJOUT DE CLASS UTILISATEUR</h1>
            <form method="post" action="" id="form"> 
                <h4>NomComplet :</h4>
                    <input type="text" name="nomComplet"> <br/>
                <h4>Login :</h4>
                    <input type="text" id="log" name="login"> <br/>
                <h4>Password :</h4>
                    <input type="text"    name="password"> <br/>
                <h4>Profil :</h4>
                    <select name="profil" id="profil">
                        <option value="">Profil</option>
                        <option value="admin">Admin</option>
                        <option value="agent">Agent</option>
                    </select>
                <h4>Etat :</h4>
                    <input type="text"    name="etat"> <br/>
                    <input type="submit" name="valider" value="VALIDER">
            </form>
        </center>
            <?php
                if(isset($_POST['valider']))
                {
                    extract($_POST);
                    require_once('locDao_class.php');
                    $util = new location\dao\Utilisateur();
                    $util->nomComplet = $nomComplet;
                    $util->login = $login;
                    $util->password = $password;
                    $util->profil = $profil;
                    $util->etat = $etat;
                    $util->addUtilisateur();
                    

                   
                }
            ?>
       
    </body>
</html>