<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);
include ("../../models/Musicien.php");
include ("../../configurations/config.php");
header("Access-Control-Allow-Origin: *");
header("Content-type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Autorization, X-Requested-Width");

$method = $_SERVER["REQUEST_METHOD"];
$data = json_decode(file_get_contents("php://input") , true);

switch ($method) {
    case 'POST':
        /**
         * Fetching signal user by its id 
         */
        $musician = Musicien::getMusicianById($data['id']);
        echo json_encode($musician);
        break;
    case 'PUT':
        /**
         * Modifying User Informations 
         * 
         */
    
         if (
            isset($data['id']) &&
            isset($data['musician_pseudo']) &&
            isset($data['nom']) &&
            isset($data['postnom']) &&
            isset($data['prenom']) &&
            isset($data['email']) &&
            isset($data['musician_gender']) &&
            isset($data['phone']) &&
            isset($data['musician_facebook']) &&
            isset($data['musician_instagram']) &&
            isset($data['musician_twitter']) &&
            isset($data['pays']) &&
            isset($data['password']) &&
            isset($data['musician_gender_music'])
        ) {
            if (Musicien::updateInfo(
                $data['id'],
                $data['musician_pseudo'],
                $data['nom'],
                $data['postnom'],
                $data['prenom'],
                $data['email'],
                $data['musician_gender'],
                $data['phone'],
                $data['musician_facebook'],
                $data['musician_instagram'],
                $data['musician_twitter'],
                $data['pays'],
                $data['password'],
                $data['musician_gender_music']
            )) {
                echo json_encode(array("Success" => true));
            } else {
                echo json_encode(array("Failed" => false));
            }
        } else {
            echo json_encode(array("Please Provide Full Information" => false));
        }
        
               
    default:
        # code...
        break;
}