<?php
require_once('Users_DTO.php');

class Users_DAO{
    private $bdd;

    public function __construct(){
        try {
                $this->bdd = new PDO('mysql:host=sql11.freemysqlhosting.net;dbname=sql11416035;charset=utf8',
                        'sql11416035', //username
                        '7Vn1X7wHVi'//password
        );
        } catch (Exception $e){
                die('Erreur : '.$e->getMessage());
        }
    }


    public function getUserByEmail($email) {
            $sql = 'SELECT * FROM users WHERE email like ?';
            $req = $this->bdd->prepare($sql);
            $req->execute([$email]);
            $data = $req->fetch();
            if($data!=null){            
                    $users = new Users_dto($data['id'],$data['firstname'],$data['lastname'],$data['password'],$email,$data['accountLevel']);
                    return $users;
            }else{
                    return null;
            }
    }	


    public function connectUser($mail, $mdp){
            try{				
                $user = $this->getUserByEmail($mail);
                if($user!=null){

                        $emailGet=$user->getEmail();
                        $passw=$user->getPassword();
                        $id_pl=$user->getId();
                        $accLvL=$user->getAccLevel();
                        $username=$user->getFirstname()." ".$user->getLastname();

                        if($mail == $emailGet && $mdp == $passw){
                                $_SESSION['firstname']=$username;
                                $_SESSION['email']=$emailGet;
                                $_SESSION['password']=$mdp;
                                $_SESSION['id']=$id_pl;
                                $_SESSION['accountLevel']=$accLvL;
                        }else{
                                echo 'Comment t as fait pour avoir ce message d erreur ?';
                        }

                }else{
                        echo 'erreur lors de la saisie';
                }

            } catch (Exception $e){
                            die('Erreur : '.$e->getMessage());
            }
    }

    public function createUser($firstname,$lastname,$email,$password){

                            $user = $this->getUserByEmail($email);
                            if($user != null){
                                    unset($_SESSION['firstname']);
                                    unset($_SESSION['lastname']);
                                    unset($_SESSION['password']);
                                    unset($_SESSION['email']);
                                    unset($_SESSION['id']);
                                    unset($_SESSION['accountLevel']);
                                    header('Location: index.php?useralreadyexisting');					
                            } else {					
                            ///////////////////////////////////////////////
                            //realisation de la requête SQL INSERT
                            $requete = 'INSERT INTO users(lastname,firstname,email,accountLevel,password) VALUES (:t_ln, :t_fn, :t_mail, :t_acc,:t_mdp)';
                            $req = $this->bdd->prepare($requete);
                            $req->execute( array(
                                    't_ln' => $lastname,
                                    't_fn' => $firstname,
                                    't_mail' => $email,
                                    't_mdp' => $password,
                                    't_acc' => 0
                            ));						
                            //////////////////////////////////////////////			
                            }
    }




}