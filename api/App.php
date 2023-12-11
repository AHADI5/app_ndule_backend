
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
        
        return $response->with_header('content-type : application/json');
    });


    //  ---- MISE A JOURS ----
    
    $app->post('/musicien/{id}', function ($request, $response, $args) {
        $id = $args['id'];
        $data = $request->getParsedBody();
        
        Musicien::setMusicianInfos($id, $data);     
    
    
        return $response->withHeader('Location', '/')->withStatus(302);
    });

    // --- VERIFIER SI LE COMPTE EST OFFICIEL ---

    $app->get('/musicien/{id}', function ($request, $response, $args) {
        $id = $args['id'];
       
        
        Musicien::isOfficial($id);  
    
    
        return $response->withHeader('Location', '/')->withStatus(302);
    });


     //  ---- ARCHIVER ALBUM ----
    
     $app->post('/album/{id}', function ($request, $response, $args) {
        $id = $args['id'];        
        
        Album::archiver_album($id);      
    
        return $response->withHeader('Location', '/')->withStatus(302);
    });