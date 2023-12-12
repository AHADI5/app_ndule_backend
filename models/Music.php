<?php

    class Music{
        
        private $id_music; //PK
        private $id_album; //FK
        private $id_musicien; //FK
        private $music_title;
        private $music_path;
        private $extrac_path;
        private $music_gender;
        private $music_format;
        private $music_type;
        private $back_image;
        private $duration;
        private $music_size;

        public function __construct($id_album, $id_musicien, $music_title, $music_path, $extrac_path, $music_gender,
                                    $music_format, $music_type, $back_image, $duration, $music_size){
            $this->id_album = $id_album;
            $this->id_musicien = $id_musicien;
            $this->music_title = $music_title;
            $this->music_path = $music_path;
            $this->extrac_path = $extrac_path;
            $this->music_gender = $music_gender;
            $this->music_format = $music_format;
            $this->music_type = $music_type;
            $this->back_image = $back_image;
            $this->duration = $duration;
            $this->music_size = $music_size;
        }

        public function uploadMusic() {
                global $db;
                $result = false;
                $requette =  'INSERT INTO MUSIC(id_album, id_musician,
                                 music_title, music_path, extract_path, music_gender, 
                                 music_format, music_type, back_image, duration, music_size) 
                                 VALUES (:id_album, :id_musician, 
                                         :music_title, :music_path, :extract_path, :music_gender, :music_format, 
                                         :music_type, :back_image, :duration, :music_size);';
            
                $statement = $db->prepare($requette);
                $execute = $statement->execute(array(
                    ':id_album' => $this->getId_album(),
                    ':id_musician' => $this->getId_musicien(),
                    ':music_title' => $this->getMusic_title(),
                    ':music_path' => $this->getMusic_path(),
                    ':extract_path' => $this->getExtrac_path(),
                    ':music_gender' => $this->getMusic_gender(),
                    ':music_format' => $this->getMusic_format(),
                    ':music_type' => $this->getMusic_type(),
                    ':back_image' => $this->getBack_image(),
                    ':duration' => $this->getDuration(),
                    ':music_size' => $this->getMusic_size(),
                ));
            
                if ($execute) {
                    $result = true;
                } else {
                    $result = false;
                }
                return $result;
            }
            
            public function getMusicInformations() {
                global $db;
                $requette = 'SELECT * FROM MUSIC';
                $statement = $db->prepare($requette);
                $execute = $statement->execute(array());
            
                $musics = [];
            
                if ($execute) {
                    while ($data = $statement->fetch(PDO::FETCH_ASSOC)) {
                        $musics[] = [
                            'id_album' => $data['id_album'],
                            'id_musician' => $data['id_musician'],
                            'music_title' => $data['music_title'],
                            'music_path' => $data['music_path'],
                            'extract_path' => $data['extract_path'],
                            'music_gender' => $data['music_gender'],
                            'music_format' => $data['music_format'],
                            'music_type' => $data['music_type'],
                            'back_image' => $data['back_image'],
                            'duration' => $data['duration'],
                            'music_size' => $data['music_size']
                        ];
                    }
                }
                return $musics;
            }
            

        public function functionGetMusicById($id) {
                global $db ;
                $requette = 'SELECT * FROM MUSIC WHERE id_music = :id_music';
                $statement = $db->prepare($requette);
                $execute = $statement->execute(array($id));

        }

        public function getIdMusic() {
            global $db;

            $requete = 'SELECT id_music FROM music WHERE music_title = ? AND id_musicien = ?';
            $statement = $db->prepare($requete);
            $execute = $statement->execute(array($this->getMusic_title(),$this->getId_musicien()));

            if ($execute) {
                if($data = $statement -> fetch()){
                    $id_music = $data['id_music'];
                    $this->setId_music($id_music);
                    return $id_music;
                } else return null;
            } else return null;
        }


        static function addMusicToAlbum($id_music_, $id_album_){
            global $db;

            $requete = "UPDATE music set id_album = ? where id_music = ?";
            $statement = $db->prepare($requete);
            $execute=$statement->execute(array($id_album_, $id_music_));

            return $resultat = $execute ? true : false;

        }

        static function deleteMusicToAlbum($id_music_, $id_album_){
            global $db;

            $requete = "UPDATE music set id_album = ? where id_music = ?";
            $statement = $db->prepare($requete);
            $execute=$statement->execute(array(null, $id_music_));

            return $resultat = $execute ? true : false;

        }



        



        /**
         * Get the value of id_album
         */ 
        public function getId_album()
        {
                return $this->id_album;
        }

        /**
         * Set the value of id_album
         *
         * @return  self
         */ 
        public function setId_album($id_album)
        {
                $this->id_album = $id_album;

                return $this;
        }

        

        /**
         * Get the value of id_musicien
         */ 
        public function getId_musicien()
        {
                return $this->id_musicien;
        }

        /**
         * Set the value of id_musicien
         *
         * @return  self
         */ 
        public function setId_musicien($id_musicien)
        {
                $this->id_musicien = $id_musicien;

                return $this;
        }

        /**
         * Get the value of music_title
         */ 
        public function getMusic_title()
        {
                return $this->music_title;
        }

        /**
         * Set the value of music_title
         *
         * @return  self
         */ 
        public function setMusic_title($music_title)
        {
                $this->music_title = $music_title;

                return $this;
        }

        

        /**
         * Get the value of music_path
         */ 
        public function getMusic_path()
        {
                return $this->music_path;
        }

        /**
         * Set the value of music_path
         *
         * @return  self
         */ 
        public function setMusic_path($music_path)
        {
                $this->music_path = $music_path;

                return $this;
        }

        

        /**
         * Get the value of extrac_path
         */ 
        public function getExtrac_path()
        {
                return $this->extrac_path;
        }

        /**
         * Set the value of extrac_path
         *
         * @return  self
         */ 
        public function setExtrac_path($extrac_path)
        {
                $this->extrac_path = $extrac_path;

                return $this;
        }

        

        /**
         * Get the value of music_gender
         */ 
        public function getMusic_gender()
        {
                return $this->music_gender;
        }

        /**
         * Set the value of music_gender
         *
         * @return  self
         */ 
        public function setMusic_gender($music_gender)
        {
                $this->music_gender = $music_gender;

                return $this;
        }

        

        /**
         * Get the value of music_format
         */ 
        public function getMusic_format()
        {
                return $this->music_format;
        }

        /**
         * Set the value of music_format
         *
         * @return  self
         */ 
        public function setMusic_format($music_format)
        {
                $this->music_format = $music_format;

                return $this;
        }

        /**
         * Get the value of music_type
         */ 
        public function getMusic_type()
        {
                return $this->music_type;
        }

        /**
         * Set the value of music_type
         *
         * @return  self
         */ 
        public function setMusic_type($music_type)
        {
                $this->music_type = $music_type;

                return $this;
        }

        /**
         * Get the value of back_image
         */ 
        public function getBack_image()
        {
                return $this->back_image;
        }

        /**
         * Set the value of back_image
         *
         * @return  self
         */ 
        public function setBack_image($back_image)
        {
                $this->back_image = $back_image;

                return $this;
        }

        

        /**
         * Get the value of duration
         */ 
        public function getDuration()
        {
                return $this->duration;
        }

        /**
         * Set the value of duration
         *
         * @return  self
         */ 
        public function setDuration($duration)
        {
                $this->duration = $duration;

                return $this;
        }

        

        /**
         * Get the value of music_size
         */ 
        public function getMusic_size()
        {
                return $this->music_size;
        }

        /**
         * Set the value of music_size
         *
         * @return  self
         */ 
        public function setMusic_size($music_size)
        {
                $this->music_size = $music_size;

                return $this;
        }

        /**
         * Set the value of id_music
         *
         * @return  self
         */ 
        public function setId_music($id_music)
        {
                $this->id_music = $id_music;

                return $this;
        }
    }