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


    public function getCategorieTree($id_categorie){
        $array=[];

        $haveChild=true;

        while($haveChild){

            $sql=$this->db->prepare("SELECT * FROM categories WHERE id=:id");
            $sql->bindValue(':id',$id_categorie);
            $sql->execute();

            if($sql->rowCount()>0){
                $sql=$sql->fetch();
                $array[]=$sql;

                if(!empty($sql['sub'])){
                    $id_categorie=$sql['sub'];
                }else{
                    $haveChild=false;
                }
            }
        }

        $array=array_reverse($array);

        return $array;

    }

    public function getCategorieName($id_categorie){
        $array=[];

        $sql=$this->db->prepare("SELECT name FROM categories WHERE id=:id");
        $sql->bindValue(':id',$id_categorie);
        $sql->execute();

        if($sql->rowCount()>0){
            $array=$sql->fetch(PDO::FETCH_ASSOC);
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