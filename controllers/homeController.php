<?php
class homeController extends controller {

	private $user;

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $dados = array();
        $products=new Product();
        $categories=new Categorie();
        $f=new Filter();

        $currentPage=1;
        $offset=0;
        $limit=3;

        if(!empty($_GET['p'])){
            $currentPage=$_GET['p'];
        }

        $offset=($currentPage* $limit)-$limit;

        $dados['filters']=$f->getFilters();

        $dados['product_list']=$products->getProducts($offset,$limit);
        $dados['total_itens']=$products->getTotalItens();
        $dados['numberOfPages']=ceil($dados['total_itens']/$limit);
        $dados['currentPage']=$currentPage;

        $dados['categories']=$categories->getList();

        $dados['maxSlide']=500;
        
        $this->loadTemplate('home', $dados);
    }

}