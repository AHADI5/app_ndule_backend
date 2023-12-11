<?php


class Musicien{
      


    public static function getMusiciansByGender($genderName) {
        // Assuming you have a database connection
        $db = new DB();
        $db ->connect();
    
       $sql = "SELECT * FROM musicien WHERE MUSICIAN_GENDER_MUSIC = :gender";
        $stmt = $db->prepare($sql);
        
        $stmt->execute([":gender"=> $genderName]);
    
        // Fetch the results
        $musicians = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        return json_encode($musicians);
    }

    public static function isOfficial($id) {
        // Assuming you have a database connection
        $pdo = new PDO("mysql:host=localhost,dbname=your_database", "username", "password");
    
        // Perform a query to check if the musician is official
        $stmt = $pdo->prepare("SELECT isOfficial FROM musicians WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    
        // Fetch the result
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // Check if the musician is official
        return json_encode($result && $result['isOfficial'] == 1);
    }
}
