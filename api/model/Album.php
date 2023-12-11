<?php
class Album{

    public static function archiver_album($albumId){
        if (isset($_POST['album_id'])) {
            $albumId = $_POST['album_id'];
        
            // Mettre à jour la base de données pour marquer l'album comme archivé
            $sql = "UPDATE albums SET archived = 1 WHERE id = :album_id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':album_id', $albumId, PDO::PARAM_INT);
            $stmt->execute();
        
            // Répondre à la requête AJAX (par exemple, avec un message JSON)
            echo json_encode(['success' => true, 'message' => 'Album archivé avec succès']);
        } else {
            echo json_encode(['success' => false, 'message' => 'ID de l\'album manquant']);
        }
    }
}