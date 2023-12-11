<?php
include_once ("../config/Db.php");

class Album{

    public static function archiver_album($idMusicien,$idAlbum) {
        if (isset($id)) {
            
            $db = new Db();
            $db->connect();
        
            // Mettre à jour la base de données pour marquer l'album comme archivé
            $stmt = $db->prepare("UPDATE album SET ARCHIVED = 1 WHERE id_musicien = :idMusicien AND id_album = :idAlbum");
            $stmt->bindParam(':idMusicien', $idMusicien, PDO::PARAM_INT);
            $stmt->bindParam(':idAlbum', $idAlbum, PDO::PARAM_INT);
            $stmt->execute();

        
            // Répondre à la requête AJAX (par exemple, avec un message JSON)
            echo json_encode(['success' => true, 'message' => 'Album archivé avec succès']);
        } else {
            echo json_encode(['success' => false, 'message' => 'ID de l\'album manquant']);
        }
    }
}