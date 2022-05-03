<?php
session_start();
require_once('../model/Users_DAO.php');
require_once('../model/Film_DAO.php');
require_once('../model/Video-helper.php');

$module='connexion';
$message = '';
$privateSession = '';

$users_dao = new Users_DAO();
$film_dao = new Film_DAO();

/* ------------------ connexion ------------------------------- */

if(isset($_POST['btnValider'])){
	if(isset($_POST['email']) && $_POST['email'] !=''
	&&isset($_POST['password']) && $_POST['password'] !=''){
		$users_dao->connectUser($_POST['email'],$_POST['password']);
		$module='homepage';
	}
}

/* ------------------ inscription -----------------------------*/

if(isset($_POST['btnValiderInscr'])){
	if(isset($_POST['firstname']) && $_POST['firstname'] !=''
        &&isset($_POST['lastname']) && $_POST['lastname'] !=''
        &&isset($_POST['email']) && $_POST['email'] !=''
	&&isset($_POST['password']) && $_POST['password'] !=''){
			$_SESSION['firstname']=$_POST['firstname'];
                        $_SESSION['lastname']=$_POST['lastname'];
			$_SESSION['password']=$_POST['password'];
			$_SESSION['email']=$_POST['email'];

			$fn=$_POST['firstname'];
			$ln=$_POST['lastname'];
                        $pa=$_POST['password'];
                        $ma=$_POST['email'];

			$users_dao->createUser($fn,$ln,$ma,$pa);
		}
			
}


/* --------- Gestion des boutons de navigation --------------------*/

if(isset($_GET['deco'])){
	unset($_SESSION['firstname']);
	unset($_SESSION['lastname']);
	unset($_SESSION['password']);
	unset($_SESSION['accountLevel']);
	unset($_SESSION['id']);
	unset($_SESSION['email']);
	$module='connexion';
}

if(isset($_GET['register'])){
    $module='register';
}

if(isset($_GET['co'])){
    $module='connexion';
}

if(isset($_GET['catalog'])){
    $module='homepage';
}

if(isset($_GET['music'])){
    $module='music';
}
if(isset($_GET['video'])){
    $module='video';
}
if(isset($_GET['game'])){
    $module='game';
}
if(isset($_GET['writing'])){
    $module='writing';
}
if(isset($_GET['image'])){
    $module='image';
}
if(isset($_GET['accUpgrade'])){
    $module='accUpgrade';
}

if(isset($_GET['useralreadyexisting'])){
	$module='register';
	$message ='<p>This user already exists !</p>';
}

if(isset($_SESSION['email']) && $_SESSION['email'] !='' && $module=='connexion'){
    $module='homepage';
}

if(isset($_GET['private'])){
	$module='private';
        if(isset($_SESSION['accountLevel']) && ($_SESSION['accountLevel']!=2) || $_SESSION == null){
            $module='homepage';
        }
}
/*---------------------Le rang de l'internaute--------------------------*/
$imgLvl="../view/css/imgLevel/Dirt"; // Default
if(isset($_SESSION['accountLevel'])){
    switch($_SESSION['accountLevel']){
        case 0:
            $imgLvl="../view/css/imgLevel/Dirt"; // Compte gratuit
            $privateSession="Upgrade to create a room";
            break;
        case 1:
            $imgLvl="../view/css/imgLevel/Gold"; // Compte standard
            $privateSession="Upgrade to create a room";
            break;
        case 2:
            $imgLvl="../view/css/imgLevel/Diamond"; // Compte premium
            $privateSession="Create a room";
            break;
    }
}else{
    $privateSession="Please connect";
}

/*-- Reservation --*/

//TODO : Modifier le lien pour être récupéré par formulaire si temps
$video = new Video('https://www.youtube.com/watch?v=zTTtd6bnhFs', 1);


/*---------------------Gestion des films--------------------------------*/
//DEBUG ATTENTION A RETIRER//
//$unNb = $film_dao->getFilmNumber();
/////////////////////////////////////

if(isset($_POST['filmName'])){
    $oeuvre=$_POST['filmName'];
    $module='filmDetail';
    $aFilm=$film_dao->getFilmByName($oeuvre);
    //var_dump($aFilm);
    
    $detailName=$aFilm->getWorkname();
    $detailRealisator=$aFilm->getRealisator();
    $detailActors=$aFilm->getActor();
    $detailAudio=$aFilm->getAudiotrack();
    $detailSubs=$aFilm->getSubtitles();
}



/*----------------------------------------------------------------------*/

var_dump($_SESSION);
var_dump($module);

/*---------------------Gestion des views--------------------------*/

switch ($module) {
    case 'homepage':
            include('../view/start.php');
            include('../view/accLevel.php');
            include('../view/main_start.php');
            include('../view/homepage/header.php');
            include('../view/homepage/homepage.php');
            include('../view/main_end.php');
            include('../view/end.php');
    break;
    case 'connexion' :
            include('../view/start.php');        
            include('../view/main_start.php');
            include('../view/connexion/header.php');
            include('../view/connexion/form.php');
            include('../view/main_end.php');
            include('../view/end.php');
    break;
    case 'register' :
            include('../view/start.php');       
            include('../view/main_start.php');
            include('../view/register/header.php');
            include('../view/register/form.php');
            include('../view/main_end.php');
            include('../view/end.php');                
    break;
    case 'music' :
            include('../view/start.php');
            include('../view/accLevel.php');        
            include('../view/main_start.php');
            include('../view/music/header.php');
            include('../view/main_end.php');
            include('../view/end.php');        
    break;
    case 'video' :
            include('../view/start.php');
            include('../view/accLevel.php');        
            include('../view/main_start.php');
            include('../view/video/header.php');
            include('../view/video/body.php');
            include('../view/main_end.php');
            include('../view/end.php');           
    break;
    case 'filmDetail' :
            include('../view/start.php');
            include('../view/accLevel.php');        
            include('../view/main_start.php');
            include('../view/video/filmDetails/header.php');
            include('../view/video/filmDetails/body.php');
            include('../view/main_end.php');
            include('../view/end.php');           
    break;
    case 'game' :
            include('../view/start.php');
            include('../view/accLevel.php');        
            include('../view/main_start.php');
            include('../view/game/header.php');
            include('../view/main_end.php');
            include('../view/end.php');           
    break;
    case 'image' :
            include('../view/start.php');
            include('../view/accLevel.php');        
            include('../view/main_start.php');
            include('../view/image/header.php');
            include('../view/main_end.php');
            include('../view/end.php');           
    break;
    case 'writing' :
            include('../view/start.php');
            include('../view/accLevel.php');        
            include('../view/main_start.php');
            include('../view/writing/header.php');
            include('../view/main_end.php');
            include('../view/end.php');           
    break;
    case 'accUpgrade' :
            include('../view/start.php');
            include('../view/accLevel.php');        
            include('../view/main_start.php');
            include('../view/accountUpgrade/header.php');
            include('../view/accountUpgrade/upgrade.php');
            include('../view/main_end.php');
            include('../view/end.php');
    case 'private' :
            include('../view/start.php');
            include('../view/accLevel.php');        
            include('../view/main_start.php');
            include('../view/premiumReservation/header.php');
            include('../view/premiumReservation/body.php');
            include('../view/main_end.php');
            include('../view/end.php');             
    
    
}