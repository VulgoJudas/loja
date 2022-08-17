<?php

class Brand extends Model{
    
    public function getNameBrands(){
        $array=[];

        $sql=$this->db->query("SELECT * FROM brands");
        if($sql->rowCount()>0){
            $array=$sql->fetchAll();
        }


        return $array;
    }

}