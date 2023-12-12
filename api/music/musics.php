<?php 

//tracking Errors 
error_reporting(E_ALL);
ini_set('display_errors', 1);
include ("../../models/Music.php");
include ("../../configurations/config.php");
header("Access-Control-Allow-Origin: *");
header("Content-type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Autorization, X-Requested-Width");

$method = $_SERVER["REQUEST_METHOD"];
switch ($method) {
    case 'POST':
        $data = json_decode(file_get_contents("php://input"), true);

        //checking Wether data exists

        if (
            isset($data['id_album'], $data['id_musician'],
                   $data['music_title'], $data['music_path'], $data['extract_path'],
                   $data['music_gender'], $data['music_format'], $data['music_type'],
                   $data['back_image'], $data['duration'], $data['music_size'])
        ) {
            // All required fields are set, proceed with creating Musicien object or processing the data
            $music = new Music (
                $data['id_album'],
                $data['id_musician'],
                $data['music_title'],
                $data['music_path'],
                $data['extract_path'],
                $data['music_gender'],
                $data['music_format'],
                $data['music_type'],
                $data['back_image'],
                $data['duration'],
                $data['music_size']
            );
            echo json_encode("Music Uploaded");
            echo json_encode("Creating Music");
            if ($music -> uploadMusic()) {
                echo json_encode("done");
            } else {
                echo json_encode("Failed");
            }
    
            // Process the Musicien object or add it to an array, etc.
        } else {
            // Some required fields are not set, handle the error or skip the current iteration
            echo json_encode("Please provide for required fields");
        }

        break;
    
    default:
        # code...
        break;
}