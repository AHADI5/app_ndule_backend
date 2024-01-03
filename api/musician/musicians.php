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
        /**
         * Here We get and process musician data , 
         * one file, and text data in json format
         */
        // echo json_encode($method);
        // $data = json_decode(file_get_contents("php://input") , true);
        
        /**
         * Preprocessing data from user ,  in the case of testing the api 
         * When used , the preceding code will be used , cuz we'll suppose that the data
         * is well formatted and can be precessed as it is 
         */
        $jsonField  = isset($_POST['data']) ? trim($_POST['data']) :null;// Get text data
        $outputString = preg_replace('/\n|\t/', '', $jsonField);

        // Remove curly braces and split by commas
        $splitData = preg_split('/,\s*(?=[^}]*$)/', trim($outputString, '{}'));
        // Initialize an empty associative array
        $jsonArray = [];///This will contail our json format , with keys and values 
        // Process each key-value pair and add it to the array
        foreach ($splitData as $pair) {
            // Extract key and value using regex
            if (preg_match('/\s*(\w+)\s*:\s*\'([^\']*)\'/', $pair, $matches)) {
                // Add key-value pair to the associative array
                $jsonArray[$matches[1]] = $matches[2];
            }
        }
        
        // Convert the associative array to JSON
        // echo json_encode($jsonArray);

        // Output the JSON string, for test issues 
        // echo $jsonString;
        
        // test 
        if ($jsonField == null) {
           echo json_encode(array('error'=> 'Incorrect data '));
        } else {
           
            echo $jsonArray['musician_instagram'];
        }

        //Getting Profile picture 
        if (isset($_FILES['musician_profile']) ) {
                $files = $_FILES['musician_profile'];
                echo json_encode($files);

                if ($files['error'] === UPLOAD_ERR_OK) {
                    $uploadedDirectory ="../../media/Pictures/ProfilePictures/".$files["name"];
                    $uploadedFileName  = $files['name'];
                    
                    if (move_uploaded_file($files['tmp_name'], $uploadedDirectory)) {
                        //Getting Profile picture name and asign it to musician profile for data storing 
                        $jsonArray['musician_profile'] = $uploadedFileName;
                        echo json_encode("Picture uploaded Successfully");
                    } else echo json_encode("Failed to Upload");
                }
               
        }
        // Creating Musicien 
        $musicien = new Musicien(
                $jsonArray['musician_nom'],
                $jsonArray['musician_prenom'],
                $jsonArray['musician_postnom'],
                $jsonArray['musician_email'],
                $jsonArray['musician_profile'],
                $jsonArray['musician_phone'],
                $jsonArray['musician_pays'],
                $jsonArray['musician_password'],
                $jsonArray['musician_pseudo'],
                $jsonArray['musician_facebook'],
                $jsonArray['musician_instagram'],
                $jsonArray['musician_twitter'],
                $jsonArray['musician_official'],
                $jsonArray['musician_gender_music'],
                $jsonArray['musician_gender'],
                );
        
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
        echo json_encode(array("error"=> "This method is not allowed"));
        break;
}

