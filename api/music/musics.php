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
        
        // Getting metaData-image 
        $jsonField = isset($_POST['meta_data']) ? $_POST['meta_data'] : null;
         
        //Extracting Json Data 
        preg_match_all('/\{.*?\}/s',$jsonField, $matches);


        // $matches[0] contains an array of matched JSON objects
        $jsonObjects = $matches[0];
        $concatenatedJson = implode('', $jsonObjects);


        if ($jsonField == null) {
            echo json_encode(array('error'=> 'Incorrect data '));
        } else {
            $jsonData = json_decode($jsonData, true);
            echo json_encode($jsonData['back_image']);
        }
        

        // Getting Music Background Image 

        if (isset($_FILES['back_image'])) {
            $music_image = $_FILES['back_image'];
            if ($files['error'] == UPLOAD_ERR_OK) {

                $uploadDirectory = "../../Media/MusicBackGround/".$music_image;
                if (move_uploaded_file($music_image, $uploadDirectory)) {
                    $jsonData["back_image"] = $music_image;
                    echo json_encode("Uploaded successfully");
                } else {
                    echo json_encode("Failed to upload");
                }
            }            
        }

        //Getting Music file 

        if (isset($_FILES['music_title'])) {
            $music_file  = $_FILES['music_title'];
            $music_file_name = $_music_file['name'];
            //Getting File extention
            $music_file_type = strtolower(pathinfo($music_file_name, PATHINFO_EXTENSION));
            
            if (isAudio($music_file_type)) {
                $musicDirectory  = '../../Media/MusicFiles/MusicAudio/';
                $jsonData ['music_type'] = "Audio";
            } else if (isVideo($music_file_type)) {
                $musicDirectory = '../../Media/MusicFiles/MusicVideo/';
                $jsonData ['music_type'] = 'Video';

            }
        }




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

/**
 * This function checks wether , the file is audio one 
 * 
 * @param string $file_type
 * @return  boolean 
 * 
 * 
 */
function isAudio( $file_type ) {
    $supportedFormats = ['mp3','wav', 'ogg','aac', 'mp4'];
    return in_array( $file_type, $supportedFormats );
}

/**
 * 
 * This function checks wether , the file is video one 
 * 
 * @param string $file_type
 * @return  boolean
 */

function isVideo( $file_type ) {
    $supportedFormats = ['mp4','avi', 'mkv', 'mov'];
    return in_array( $file_type, $supportedFormats );
}