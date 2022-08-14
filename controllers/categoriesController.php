<?php
class categoriesController extends controller {

	private $user;

    public function __construct() {
        parent::__construct();
    }

    public function index(){
        header("Location:".BASE_URL);
        exit;
    }

    public function enter($id){
        $dados=[];

        $categories=new Categorie();
        $products=new Product();

        $dados['category_name']=$categories->getCategorieName($id);

        if(!empty($dados['category_name'])){
            $currentPage=1;
            $offset=0;
            $limit=3;

            if(!empty($_GET['p'])){
                $currentPage=$_GET['p'];
            }

            $offset=($currentPage* $limit)-$limit;
            $filters=[
                'category'=>$id
            ];

            $dados['category_filter']=$categories->getCategorieTree($id);
            $dados['categories']=$categories->getList();
            $dados['product_list']=$products->getProducts($offset,$limit,$filters);
            $dados['total_itens']=$products->getTotalItens($filters);
            $dados['numberOfPages']=ceil($dados['total_itens']/$limit);
            $dados['currentPage']=$currentPage;

            $dados['id_category']=$id;

            $dados['maxSlide']=500;

            $this->loadTemplate('categories',$dados);

        }else{
            header("Location:".BASE_URL);
            exit;
        }
    }

}