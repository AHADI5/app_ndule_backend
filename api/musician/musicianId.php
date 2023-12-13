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
        $musician = Musicien::getMusicianById($data['id']);
        echo json_encode($musician);
        break;
    case 'PUT':
           
    default:
        # code...
        break;
}