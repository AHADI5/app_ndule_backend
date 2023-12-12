<?php 

class Stream 
{
    private $id_music;
    private $id_client;
    private $date_stream ;

    public function __construct( $id_music,  $id_client, $date_stream){
        $this->id_music = $id_music;
        $this->id_client = $id_client;
        $this -> date_stream = $date_stream;
    }


}
