<?php

class Maquinas_model extends CI_Model {

    private $entrada = "entrada";
    private $saida = "saida";
    
     public function __construct(){
        parent::__construct();  
     }


     public function entrada($dados){
       
        $this->db->insert($this->entrada,$dados);
     }


     public function saida($dados){
       
        $this->db->insert($this->saida,$dados);
     }






}