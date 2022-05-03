<?php
require_once ('Film_DTO.php');

class Film_DAO{
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
    
    public function getFilmById($id) {
            $sql = "SELECT * FROM film WHERE id like ?";
            $req = $this->bdd->prepare($sql);
            $req->execute([$id]);
            $data = $req->fetch();
            if($data!=null){
                    $film = new Film_DTO($id,$data['workname'],$data['realisator'], $data['actor'], $data['audiotrack'], $data['subtitles']);
                    return film;
            }else{
                    return null;
            }
    }
    public function getFilmByName($name) {
            $sql = "SELECT * FROM film WHERE workname like ?";
            $req = $this->bdd->prepare($sql);
            $req->execute([$name]);
            $data = $req->fetch();
            if($data!=null){
                    $unFilm = new Film_DTO($data['id'],$data['workname'],$data['realisator'], $data['actor'], $data['audiotrack'], $data['subtitles']);
                    return $unFilm;
            }else{
                    return null;
            }
    }	    
    
    //SELECT COUNT(*) FROM film
    
    public function getFilmNumber(){
        $sql ='SELECT COUNT(*) as total FROM film';
        $req=$this->bdd->prepare($sql);
        $req->execute();
        $data=$req->fetch();
        
        if($data!=null){
            $filmNumber='Le total de film ='.$data['total'];
            return $filmNumber;
        }else{
            return null;
        } 
        
    }
    
    
}