<?php
class Musicien{
    
    


    function getMusiciansByGender($genderName) {
        // Assuming you have a database connection
        $pdo = new PDO("mysql:host=localhost;dbname=your_database", "username", "password");
    
        // Perform a join to get musicians by gender
        $stmt = $pdo->prepare("SELECT musicians.* FROM musicians 
                               JOIN genders ON musicians.gender_id = genders.id 
                               WHERE genders.name = :gender");
        $stmt->bindParam(':gender', $genderName, PDO::PARAM_STR);
        $stmt->execute();
    
        // Fetch the results
        $musicians = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        return json_encode($musicians);
    }

    public static function setMusicianInfos($id, $newInfo = []) {
        // Assuming you have a database connection
        $pdo = new PDO("mysql:host=localhost;dbname=your_database", "username", "password");
    
        // Perform a query to update musician information
        $stmt = $pdo->prepare("UPDATE musicians SET info = :new_info WHERE id = :id");
        $stmt->bindParam(':new_info', $newInfo, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
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
