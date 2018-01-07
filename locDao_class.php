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