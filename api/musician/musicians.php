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


switch ($method) {

/**
 * Creating new Musician
 */

    case 'POST':
        // echo json_encode($method);
        // $data = json_decode(file_get_contents("php://input") , true);

        
        $jsonField  = isset($_POST['data']) ? trim($_POST['data']) :null;
        
        //Extracting Json Data 
        preg_match_all('/\{.*?\}/s',$jsonField, $matches);

        // $matches[0] contains an array of matched JSON objects
        $jsonObjects = $matches[0];
        $concatenatedJson = implode('', $jsonObjects);

        if ($jsonField == null) {
           echo json_encode(array('error'=> 'Incorrect data '));
        } else {
            $jsonData = json_decode($concatenatedJson, true);
            echo json_encode($jsonData['musician_instagram']);
        }

        if (isset($_FILES['musician_profile']) ) {
                $files = $_FILES['musician_profile'];
                echo json_encode($files);

                if ($files['error'] === UPLOAD_ERR_OK) {
                    $uploadedDirectory ="../../Media/ProfilePictures/".$files["name"];
                    $uploadedFileName  = $files['name'];
                    
                    if (move_uploaded_file($files['tmp_name'], $uploadedDirectory)) {
                        $jsonData['musician_profile'] = $uploadedFileName;
                        echo json_encode("Picture uploaded Successfully");
                    } else echo json_encode("Failed to Upload");
                }
               
        }
    
        $musicien = new Musicien(
                $jsonData['musician_pseudo'],
                $jsonData['musician_nom'],
                $jsonData['musician_prenom'],
                $jsonData['musician_postnom'],
                $jsonData['musician_email'],
                $jsonData['musician_gender'],
                $jsonData['musician_phone'],
                $jsonData['musician_facebook'],
                $jsonData['musician_instagram'],
                $jsonData['musician_twitter'],
                $jsonData['musician_profile'],
                $jsonData['musician_pays'],
                $jsonData['musician_official'],
                $jsonData['musician_password'],
                $jsonData['musician_gender_music'] );
        
         // Creating a musician
         if ($musicien -> creeCompte()) {
            echo json_encode("Successfully Created");
         } else {
            echo json_encode("Account Creation Failed");
         }
       
     
        
        break;
    case "GET":
        $musicien = Musicien::getMusicians();
        echo json_encode($musicien );
    default:
       

        break;
}

