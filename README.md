# GestionLocation
Projet
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
<?php
    namespace location\dao;
    use \PDO;

    class Bien
    {
        
    }
    class Proprietaire
    {

    }
    class typebien
    {

    }
    class Utilisateur       
    {
       
        var $idutil;
        var $nomComplet;
        var $login;
        var $password;
        var $profil;
        var $etat;
        private $bdd;
    
        private function getConnexion(){
            try{
                $this->bdd = new PDO('mysql:host=;dbname=BDlocation;charset=utf8', 'root', 'mysql92s');
                $this->bdd ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
            }
            catch(Exception $e){
                die('Erreur : ' . $e->getMessage());
            }
        }
    
        function addUtilisateur()
        {
            $this->getConnexion();
            // requete a executer
            $sql = "insert into Utilisateur
                            values(null, :nomComplet, :login, :password, :profil, :etat )";
            // preparation de la requete
            $req = $this->bdd->prepare($sql);
            //execution de la requete
            $data = $req->execute(
                array('nomComplet'=>$this->nomComplet,
                    'login'=>$this->login,
                    'password'=>$this->password,
                    'profil'=>$this->profil,
                    'etat'=>$this->etat
                ));
            return $data;
        }
    
        function getAllUtilisateur()
        {
            $this->getConnexion();
            // requete a executer
            $sql = "select * from Utilisateur";
            // preparation de la requete
            $donnees = $this->bdd->query($sql);
            return $donnees;
        }
    
        function login($login, $password)
        {
            $this->getConnexion();
            // requete a executer
            $sql = "select * from Utilisateur where login = :login and password = :password";
            // preparation de la requete
            $req = $this->bdd->prepare($sql);
            //execution de la requete
            $data = $req->execute(
                array(
                    'login'=>$login,
                    'password'=>$password
                ));
            return $data;
        }
    
        function changepassword($password)
        {
            $this->getConnexion();
            // requete a executer
            $sql = "UPDATE Utilisateur
            SET password = :password
            WHERE login = :login;";
            // preparation de la requete
            $req = $this->bdd->prepare($sql);
            //execution de la requete
            $data = $req->execute(
                array(
                    'login'=>$this->login,
                    'password'=>$password
                ));
            return $data;
        }
    }

?>
