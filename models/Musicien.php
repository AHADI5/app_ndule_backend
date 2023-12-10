<?php

    require_once 'Utilisateur.php';

    class Musicien extends Utilisateur {

    
        private $id_musician;
        private $musician_pseudo;
        private $musician_facebook;
        private $musician_instagram;
        private $musician_twitter;
        private $musician_official;
        private $musician_gender;
        private $musician_gender_music;

        public function __construct(
            $nom, $prenom, $postnom, $email, $imageTitle, $phone, 
            $pays, $password,$musician_pseudo, $musician_facebook, 
            $musician_instagram, $musician_twitter, $musician_official,
            $musician_gender_music, $musician_gender) {

            parent::__construct($nom, $prenom, $postnom, $email, $imageTitle, 
                $phone, $pays, $password);
            
            $this->musician_pseudo = $musician_pseudo;
            $this->musician_facebook = $musician_facebook;
            $this->musician_instagram = $musician_instagram;
            $this->musician_twitter = $musician_twitter;
            $this->musician_official = $musician_official;
            $this->musician_gender_music = $musician_gender_music;
            $this->musician_gender = $musician_gender;
        }

        public function creeCompte() {
            global $db ;
            $created = false ;
            $requette = 'INSERT INTO musicien (
                musician_pseudo,musician_nom,musician_prenom, musician_postnom , 
                musician_email, musician_gender , musician_phone,musician_facebook, 
                musician_instagram, musician_twitter, musician_profile,musician_pays
                musician_official,musician_password, musician_gender_music VALUES
                (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)';

            $statement = $db -> prepare($requette);
            $execute  = $statement -> execute( 
                array(
                    $this -> getMusician_pseudo(),
                    $this -> getNom(),
                    $this -> getPrenom(),
                    $this -> getPostnom(),
                    $this -> getEmail (), 
                    $this -> getMusician_gender(),
                    $this -> getPhone() , 
                    $this -> getMusician_facebook(),
                    $this -> getMusician_instagram() , 
                    $this -> getMusician_twitter(), 
                    $this -> getImageTitle(),
                    $this -> getMusician_official(),
                    $this -> getPassword() ,
                    $this -> getMusician_gender_music()
                ));
            if ($execute) {
                $created  =true ;
            } 
            return $created;
        }

        public function modifierIdentifiants(
            $id, $nom, $prenom, $postnom, $email, $imageTitle, $phone, 
            $pays, $password,$musician_pseudo, $musician_facebook, 
            $musician_instagram, $musician_twitter, $musician_official,
            $musician_gender_music, $musician_gender){
            global $db ;
            $result = false ;
            $requette = 'UPDATE musicien SET  musician_pseudo = ?,musician_nom = ?,musician_prenom = ?, musician_postnom = ? , 
            musician_email = ?, musician_gender = ? , musician_phone = ?,musician_facebook = ?, 
            musician_instagram = ?, musician_twitter = ?, musician_profile = ?,musician_pays = ?
            musician_official = ?,musician_password = ? , musician_gender_music =? WHERE  id_musician = ?';
            $statement = $db -> prepare($requette);
            $execute  = $statement -> execute(array(
                $musician_pseudo,
                $nom,
                $prenom,
                $postnom,
                $email,
                $musician_gender,
                $phone,
                $musician_facebook,
                $musician_instagram,
                $musician_twitter,
                $imageTitle,
                $pays,
                $musician_official,
                $password,
                $musician_gender_music,
                $id, 
            ));

            if ($execute) {
               $result = true ;
            }
            return $result;
        }

        /**
         * Returns Musician Id
         */
        public function getIdMusicien() {
            global $db;

            $requete = 'SELECT id_musician FROM musicien WHERE musician_pseudo = ? AND musician_phone = ?';
            $statement = $db->prepare($requete);
            $execute = $statement->execute(array(
                $this->getMusician_pseudo(),
                $this->getPhone()));

            if ($execute) {
                if($data = $statement -> fetch()){
                    $id_musicien = $data['id_musician'];
                    $this->setId_musician($id_musicien);
                    return $id_musicien;
                } else return null;
            } else return null;
        }

        /**
         * Returns a Muscian Object array 
         */
        public function getMusicians () {
            global $db ;
            $requette = 'SELECT * FROM musicien';
            $statement = $db -> prepare($requette);
            $execute = $statement->execute(array());
            $musicians = [] ;

            if ($execute) {
                while ($data = $statement -> fetch()) {
                    $muscian = new Musicien(
                        $data['musician_nom'],
                        $data['musician_prenom'],
                        $data['musician_postnom'],
                        $data['musician_email'],
                        $data['musician_profile'],
                        $data['musician_phone'],
                        $data['musician_pays'],
                        $data['musician_password'],
                        $data['musician_pseudo'],
                        $data['musician_facebook'],
                        $data['musician_instagram'],
                        $data['musician_twitter'],
                        $data['musician_official'],
                        $data['musician_gender_music'],
                        $data['musician_gender'],
                    );

                    array_push($musicians,$muscian);
                }
                return $musicians;
            } else {
                return [];
            }
        }


        /**
         * Returns the Musician Object by id 
         * @param mixed $musician_id
         * 
         * 
         */
        public function getMusicianById ($musician_id) {
            global $db ;
            $requete = 'SELECT * FROM musicien WHERE id_musicien = ?';
            $statement = $db -> prepare($requete);
            $execute = $statement -> execute (array($musician_id));
           
            if ($execute) {
               while ($data = $statement -> fetch()) {
                $musicien  = new Musicien(
                    $data['musician_nom'],
                    $data['musician_prenom'],
                    $data['musician_postnom'],
                    $data['musician_email'],
                    $data['musician_profile'],
                    $data['musician_phone'],
                    $data['musician_pays'],
                    $data['musician_password'],
                    $data['musician_pseudo'],
                    $data['musician_facebook'],
                    $data['musician_instagram'],
                    $data['musician_twitter'],
                    $data['musician_official'],
                    $data['musician_gender_music'],
                    $data['musician_gender'],
                );
               }

               return $musicien;
            } else return null;

        }

    
             

        

        // Getter et Setter pour id_musician

        // Getter et Setter pour id_musician
    public function setId_musician($id_musician) {
        $this->id_musician = $id_musician;
    }

    // Getter et Setter pour musician_pseudo
    public function getMusician_pseudo() {
        return $this->musician_pseudo;
    }

    public function setMusician_pseudo($musician_pseudo) {
        $this->musician_pseudo = $musician_pseudo;
    }

    // Getter et Setter pour musician_facebook
    public function getMusician_facebook() {
        return $this->musician_facebook;
    }

    public function setMusician_facebook($musician_facebook) {
        $this->musician_facebook = $musician_facebook;
    }

    // Getter et Setter pour musician_instagram
    public function getMusician_instagram() {
        return $this->musician_instagram;
    }

    public function setMusician_instagram($musician_instagram) {
        $this->musician_instagram = $musician_instagram;
    }

    // Getter et Setter pour musician_twitter
    public function getMusician_twitter() {
        return $this->musician_twitter;
    }

    public function setMusician_twitter($musician_twitter) {
        $this->musician_twitter = $musician_twitter;
    }

    // Getter et Setter pour musician_official
    public function getMusician_official() {
        return $this->musician_official;
    }

    public function setMusician_official($musician_official) {
        $this->musician_official = $musician_official;
    }

    // Getter et Setter pour musician_gender_music
    public function getMusician_gender_music() {
        return $this->musician_gender_music;
    }

    public function setMusician_gender_music($musician_gender_music) {
        $this->musician_gender_music = $musician_gender_music;
    }

    // Getter et Setter pour musician_nom
 
    public function setMusician_password($musician_password) {
        $this->musician_password = $musician_password;
    }


        /**
         * Get the value of musician_gender
         */ 
        public function getMusician_gender()
        {
                return $this->musician_gender;
        }

        /**
         * Set the value of musician_gender
         *
         * @return  self
         */ 
        public function setMusician_gender($musician_gender)
        {
                $this->musician_gender = $musician_gender;

                return $this;
        }
}

    