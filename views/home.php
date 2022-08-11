<div class="row">
    <?php
    $a=0;
    foreach($product_list as $item): ?>
        <div class="col-sm-4">
            <?php $this->loadView('product_item',$item); ?>
        </div>
        <?php if($a>=2){
            $a=0;
            echo '</div><div class="row">';
        }else{
            $a++;
        } ?>
<?php endforeach; ?>
    </div>


<div class="paginationArea">
    <?php for($q=1;$q<=$numberOfPages;$q++): ?>
        <div class="paginationItem <?php echo($currentPage==$q)?'pag_active':''; ?>">
            <a href="<?php echo BASE_URL; ?>?p=<?php echo $q; ?>">
                <?php echo $q; ?>
            </a>
        </div>
    <?php endfor; ?>
</div>