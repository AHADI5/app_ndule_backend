<?php

    require_once 'Utilisateur.php';

    class Client extends Utilisateur {

        private $id_client;
        private $client_pseudo;
        private $client_gender;


     
        public function __construct(
                $nom, $prenom, $postnom, $email, $imageTitle, $phone, 
                $pays, $password,$client_pseudo,$client_gender) {
    
                parent::__construct($nom, $prenom, $postnom, $email, $imageTitle, 
                    $phone, $pays, $password);
                
                $this->client_pseudo = $client_pseudo;
                $this->client_gender = $client_gender;
            }

        public function creeCompte(){

        }

        public function modifierIdentifiants(){

        }

        public function getIdClient() {
            global $db;

            $requete = 'SELECT id_client FROM client WHERE client_pseudo = ? AND client_phone = ?';
            $statement = $db->prepare($requete);
            $execute = $statement->execute(array($this->getClient_pseudo(),$this->getPhone()));

            if ($execute) {
                if($data = $statement -> fetch()){
                    $id_client = $data['id_client'];
                    $this->setId_client($id_client);
                    return $id_client;
                } else return null;
            } else return null;
        }
        

        /**
         * Set the value of id_client
         *
         * @return  self
         */ 
        public function setId_client($id_client)
        {
                $this->id_client = $id_client;

                return $this;
        }

        

        /**
         * Get the value of client_pseudo
         */ 
        public function getClient_pseudo()
        {
                return $this->client_pseudo;
        }

        /**
         * Set the value of client_pseudo
         *
         * @return  self
         */ 
        public function setClient_pseudo($client_pseudo)
        {
                $this->client_pseudo = $client_pseudo;

                return $this;
        }

        

        /**
         * Get the value of client_gender
         */ 
        public function getClient_gender()
        {
                return $this->client_gender;
        }

        /**
         * Set the value of client_gender
         *
         * @return  self
         */ 
        public function setClient_gender($client_gender)
        {
                $this->client_gender = $client_gender;

                return $this;
        }

        

        /**
         * Get the value of client_nom
         */ 
    

        /**
         * Set the value of client_nom
         *
         * @return  self
         */ 
        public function setClient_nom($client_nom)
        {
                $this->client_nom = $client_nom;

                return $this;
        }

        

        /**
         * Get the value of client_prenom
         */ 
  
        /**
         * Set the value of client_prenom
         *
         * @return  self
         */ 
        public function setClient_prenom($client_prenom)
        {
                $this->client_prenom = $client_prenom;

                return $this;
        }

        


        /**
         * Set the value of client_postnom
         *
         * @return  self
         */ 
        public function setClient_postnom($client_postnom)
        {
                $this->client_postnom = $client_postnom;

                return $this;
        }

        

        /**
         * Get the value of client_email
         */ 


        /**
         * Set the value of client_email
         *
         * @return  self
         */ 
        public function setClient_email($client_email)
        {
                $this->client_email = $client_email;

                return $this;
        }

        

        /**
         * Get the value of client_profile
         */ 
    

        /**
         * Set the value of client_profile
         *
         * @return  self
         */ 
        public function setClient_profile($client_profile)
        {
                $this->client_profile = $client_profile;

                return $this;
        }

        

        /**
         * Get the value of client_phone
         */ 
   

        /**
         * Set the value of client_phone
         *
         * @return  self
         */ 
        public function setClient_phone($client_phone)
        {
                $this->client_phone = $client_phone;

                return $this;
        }

        

        /**
         * Get the value of client_pays
         */ 
        /**
         * Set the value of client_pays
         *
         * @return  self
         */ 
        public function setClient_pays($client_pays)
        {
                $this->client_pays = $client_pays;

                return $this;
        }

        

     

        /**
         * Set the value of client_password
         *
         * @return  self
         */ 
        public function setClient_password($client_password)
        {
                $this->client_password = $client_password;

                return $this;
        }
    }
    