<?php

Class Auth{

    // Fonction pour compter le nombre de clients et de musiciens connectés
    public static function countOnlineUsers() {
        $clientCount = 0;
        $musicianCount = 0;

        foreach ($_SESSION as $key => $value) {
            if (strpos($key, 'user_') === 0) {
                // Si la clé commence par 'user_', alors c'est un utilisateur
                $userData = json_decode($value, true);
                
                if ($userData['user_type'] === 'client') {
                    $clientCount++;
                } elseif ($userData['user_type'] === 'musicien') {
                    $musicianCount++;
                }
            }
        }

        return ['client' => $clientCount, 'musicien' => $musicianCount];
    }
    

}