<?php 
 require_once 'Utilisateur.php';
 require_once 'Coach.php';
  class Admin extends Utilisateur{
     public function __construct()
     {
        return parent::__construct();
     }
     public function getallcoachs(){
      $coachs = new Coach();
      return $coachs->getAll();
     }
  }

?>