<?php
class homeController extends controller {

	private $user;

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $dados = array();
        $products=new Product();

        $dados['product_list']=$products->getProducts();
        
        $this->loadTemplate('home', $dados);
    }

}