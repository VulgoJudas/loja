<?php

class Categorie extends Model{

    public function getList(){
        $array=[];

        $sql=$this->db->query("SELECT * FROM categories ORDER BY sub DESC");

        if($sql->rowCount()>0){
            foreach($sql->fetchAll() as $item){
                $item['subs']=[];
                $array[$item['id']]=$item;
            }

            while($this->stillNeed($array)){
                $this->organizeCategory($array);
            }
        }


        return $array;
    }

    private function organizeCategory(&$array){
        foreach($array as $key=>$item){
            if(isset($array[$item['sub']])){
                $array[$item['sub']]['subs'][$item['id']]=$item;
                unset($array[$key]);
                break;
            }
        }
    }


    private function stillNeed($array){
        foreach($array as $item){
            if(!empty($item['sub'])){
                return true;
            }

            return false;
        }
    }

}