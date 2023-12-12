<?php  
error_reporting(E_ALL);
ini_set('display_errors', 1);
include ("../../models/Musicien.php");
include ("../../configurations/config.php");
header("Access-Control-Allow-Origin: *");
header("Content-type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods");


/**
 * Creating new Musician
 */

$method = $_SERVER["REQUEST_METHOD"];


switch ($method) {
    
    case 'POST':
        echo json_encode($method);
        $data = json_decode(file_get_contents("php://input") , true);
        echo json_encode($data['musician_gender_music']);
        if (isset($data['musician_pseudo']) &&
        isset($data['musician_nom']) &&
        isset($data['musician_prenom']) &&
        isset($data['musician_postnom']) &&
        isset($data['musician_email']) &&
        isset($data['musician_gender']) &&
        isset($data['musician_phone']) &&
        isset($data['musician_facebook']) &&
        isset($data['musician_instagram']) &&
        isset($data['musician_twitter']) &&
        isset($data['musician_profile']) &&
        isset($data['musician_pays']) &&
        isset($data['musician_official']) &&
        isset($data['musician_password']) &&
        isset($data['musician_gender_music'])) {
    
        $musicien = new Musicien(
                $data['musician_pseudo'],
                $data['musician_nom'],
                $data['musician_prenom'],
                $data['musician_postnom'],
                $data['musician_email'],
                $data['musician_gender'],
                $data['musician_phone'],
                $data['musician_facebook'],
                $data['musician_instagram'],
                $data['musician_twitter'],
                $data['musician_profile'],
                $data['musician_pays'],
                $data['musician_official'],
                $data['musician_password'],
                $data['musician_gender_music'] );
        
         // Creating a musician
         if ($musicien -> creeCompte()) {
            echo json_encode("Successfully Created");
         } else {
            echo json_encode("Account Creation Failed");
         }
       
        } else {
            
            echo json_encode("Provide All Parameters");
        
        }
        
        break;
    case "GET":
        $musicien = Musicien::getMusicians();
        echo json_encode($musicien);
    default:
       

        break;
}

