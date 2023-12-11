
<?php

    use Psr\Http\Message\ResponseInterface as Response;
    use Psr\Http\Message\ServerRequestInterface as Request;
    use Slim\Factory\AppFactory;


    include_once '../model/Auth.php';
    include_once '../model/Musicien.php';

    $app = AppFactory::create();

    $app->get('/api/auth/online_user', function (Request $request, Response $response) 
    {        
        $online_user = Auth::countOnlineUsers();
        $response = json_encode($online_user,JSON_PRETTY_PRINT);      
        
        return $response;
    });


    //  ---- MISE A JOURS ----
    
    $app->put('/musicien/{id}', function (Request $request,Response $response, $args) {
        $id = $request-> getAttribute('id');
        $data = $request->getParsedBody();
        
        Musicien::setMusicianInfos($id, $data);     
    
    
        return $response->withHeader('Location', '/')->withStatus(302);
    });

    // --- VERIFIER SI LE COMPTE EST OFFICIEL ---

    $app->get('/api/musicien/{id}/isOfficial', function ( Request $request, Response $response, $args) {
        $id = $request->getAttribute('id');       
        
        $response = Musicien::isOfficial($id);     
    
        return $response ;
    });


     //  ---- ARCHIVER ALBUM ----
    
     $app->put('/api/album/{idMusicien}/album/{idAlbum}/archiver', function (Request $request, Response $response, $args) {
    
        $idMusicien = $request->getAttribute('idMusicien');
        $idAlbum = $request->getAttribute('idAlbum');
        
        $response = Album::archiver_album($idMusicien, $idAlbum);      
    
        return $response;
    });

    $app->get('/musiciens/{gender}', function (Request $request, Response $response, $args) {
    
        $gender = $request->getAttribute('gender');        
        
        $response = Musicien::getMusiciansByGender($gender);      
    
        return $response;
    });