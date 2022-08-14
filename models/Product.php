<?php

class Product extends Model{
    public function getProducts($offset=0,$limit=4,$filters=array()){
        $array=[];

        $where=[
            '1=1'
        ];

        if(!empty($filters['category'])){
            $where[]="id_categorie = :id_categorie";
        }

        $db=$this->db->prepare("SELECT *,
        (select brands.name from brands where brands.id=products.id_brand) as brands_name,
        (select categories.name from categories where categories.id=products.id_categorie) as category_name 
        FROM products WHERE ".implode(' AND ', $where)."
        LIMIT $offset,$limit");

        if(!empty($filters['category'])){
           $db->bindValue(':id_categorie',$filters['category']);
        }

        $db->execute();

        if($db->rowCount()>0){
            $array=$db->fetchAll(PDO::FETCH_ASSOC);

            foreach($array as $key=>$valor){
                $array[$key]['images']=$this->getImagesProducts($valor['id']);
            }
        }

        return $array;
    }

    public function getTotalItens($filters=array()){
        $where=[
            '1=1'
        ];

        if(!empty($filters['category'])){
            $where[]="id_categorie = :id_categorie";
        }

        $sql=$this->db->prepare("SELECT COUNT(*) as c FROM products WHERE ".implode(' AND ',$where));

        if(!empty($filters['category'])){
            $sql->bindValue(':id_categorie',$filters['category']);
        }

        $sql->execute();



        $sql=$sql->fetch();

        return $sql['c'];
    }

    private function getImagesProducts($id_product){
        $array=[];

        $sql=$this->db->prepare("SELECT url FROM product_images WHERE id_product=:id");
        $sql->bindValue(':id',$id_product);
        $sql->execute();

        if($sql->rowCount()>0){
            $array=$sql->fetchAll(PDO::FETCH_ASSOC);
        }

        return $array;
    }
}