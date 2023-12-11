<?php 
header("Access-Control-Allow-Origin: *");
//Formats des donnes envoyees
header("Content-Type: application/json; charset=UTF-8");
//Method autorisee
header("Access-Control-Allow-Methods: POST");
//Duree de vie de la requete
header("Access-Control-Max-Age: 3600");
//Entete autorisees
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Autorization, X-Requested-Width");

$method = $_SERVER["REQUEST_METHOD"];
$data = json_decode(file_get_contents("php://input") , true);

switch ($method) {
    case 'GET':
        $musician = Musicien::getMusicianById($data['id']);
        echo json_encode($musician);

        break;
    case 'PUT':
        
    default:
        # code...
        break;
}