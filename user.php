<?php

class User{

    private $id;
    public $login;
    public $email;
    public $firstname;
    public $lastname;

    public function __construct()
    {
    }

    public function register($login, $password, $email, $firstname, $lastname)
    {
        
        $bdd = mysqli_connect('localhost', 'root', '', 'classes');
        mysqli_query($bdd, "INSERT INTO `utilisateurs` (`login`, `password`, `email`, `firstname`, `lastname`) VALUES ('$login', '$password', '$email', '$firstname', '$lastname'");
        
        echo 'bien inscrit';
    }

    public function connect($login, $password)
    {

        $bdd = mysqli_connect('localhost', 'root', '', 'classes');
        $stmt = mysqli_query($bdd, "SELECT * FROM utilisateurs WHERE login = '$login' AND password = '$password'");
        $count = mysqli_num_rows($stmt);
        $req = mysqli_fetch_all($stmt, MYSQLI_ASSOC);

        if($count==1){
            foreach($req as $value){
            $id = $value['id'];
            $login = $value['login'];
            $email = $value['email'];
            $firstname = $value['firstname'];
            $lastname = $value['lastname'];
            
            $this->id = $id;
            $this->login = $login;
            $this->email = $email;
            $this->firstname = $firstname;
            $this->lastname = $lastname;
            
            session_start();
            $_SESSION['login'] = $login;
            $_SESSION['id'] = $id;
            echo 'bien co';
            }
        }
        else{
            echo 'introuvable';
        }   
        
    }
    
    public function disconnect()
    {
        session_start();
        session_destroy();
        echo 'bien deco';
    }


    public function delete($login)
    {
        $bdd = mysqli_connect('localhost', 'root', '', 'classes');
        mysqli_query($bdd, "DELETE FROM `utilisateurs` WHERE `login`='$login'");
        
        echo 'bien supprime';
    } 
    
    public function update($login, $password, $email, $firstname, $lastname)
    {
        $user = $_SESSION['id'];
        $bdd = mysqli_connect('localhost', 'root', '', 'classes');
        mysqli_query($bdd, "UPDATE utilisateurs SET login='$login', password ='$password',  email ='$email', firstname ='$firstname', lastname ='$lastname' WHERE id = '$user'");
        echo 'bien modifié';
    }

    public function isConnected()
    {
        $result = null;
        if(isset($_SESSION['login']))
        {
            $result = true;
        }
        else
        {
            $result = false;
        }

        return $result;
    }

    public function getAllInfos()
    {
        $user = $_SESSION['id'];
        $bdd = mysqli_connect('localhost', 'root', '', 'classes');
        $stmt = mysqli_query($bdd, "SELECT * FROM utilisateurs WHERE id = '$user'");
        $req = mysqli_fetch_all($stmt, MYSQLI_ASSOC);
        foreach($req as $value){
            $login = $value['login'];
            $password = $value['password'];
            $email = $value['email'];
            $firstname = $value['firstname'];
            $lastname = $value['lastname'];
        }
        

        return array($login, $password, $email, $firstname, $lastname);
    }

    public function getLogin()
    {
        $user = $_SESSION['id'];
        $bdd = mysqli_connect('localhost', 'root', '', 'classes');
        $stmt = mysqli_query($bdd, "SELECT login FROM utilisateurs WHERE id = '$user'");
        $req = mysqli_fetch_all($stmt, MYSQLI_ASSOC);
        foreach($req as $value){
            $login = $value['login'];
        }
        return $login;
    }

    public function getEmail()
    {
        $user = $_SESSION['id'];
        $bdd = mysqli_connect('localhost', 'root', '', 'classes');
        $stmt = mysqli_query($bdd, "SELECT email FROM utilisateurs WHERE id = '$user'");
        $req = mysqli_fetch_all($stmt, MYSQLI_ASSOC);
        foreach($req as $value){
            $email = $value['email'];
        }
        return $email;
    }

    public function getFirstname()
    {
        $user = $_SESSION['id'];
        $bdd = mysqli_connect('localhost', 'root', '', 'classes');
        $stmt = mysqli_query($bdd, "SELECT firstname FROM utilisateurs WHERE id = '$user'");
        $req = mysqli_fetch_all($stmt, MYSQLI_ASSOC);
        foreach($req as $value){
            $firstname = $value['firstname'];
        }
        return $firstname;
    }

    public function getLastname()
    {
        $user = $_SESSION['id'];
        $bdd = mysqli_connect('localhost', 'root', '', 'classes');
        $stmt = mysqli_query($bdd, "SELECT lastname FROM utilisateurs WHERE id = '$user'");
        $req = mysqli_fetch_all($stmt, MYSQLI_ASSOC);
        foreach($req as $value){
            $lastname = $value['lastname'];
        }
        
        return $lastname;
    }

}




$login ='test2';
$password = 'test2';
$email = 'test2';
$firstname = 'test2';
$lastname ='test2';
$test = new User();
$test->connect($login, $password, $email, $firstname, $lastname);





