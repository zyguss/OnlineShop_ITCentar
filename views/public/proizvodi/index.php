<h1>PROIZVODI</h1>

<div class="categories">
    <h3>Kategorije</h3>
    <ul class="categories_list">
        <?php foreach ($this->categories as $category) {?>
            <li <?php if (!empty($this->currentCategoryId) && $this->currentCategoryId == $category['category_id'] ) { echo 'class="active"'; } ?> >
                <a href="<?php echo URL . 'proizvodi/kategorija/' . $this->urlName($category['category_id'].'-'.$category['name']); ?>"> <?php echo $category['name'] ?> </a> <span>(<?php echo  $category['number_of_items_in_category']; ?>)</span>
            </li>
        <?php } ?>
    </ul>
</div>
<div class="items">

    <div class="search" >
        <form action="<?php echo $this->paginationUrl; ?>" method="get">
            Pretraga: <input type="text" name="pretraga" value="<?php echo $this->search; ?>"/>
            <input class="button" type="submit" value="ok" />
        </form>
    </div>

    <ul class="items_list cf">
        <?php foreach($this->items as $item):
            $itemUrl = URL . 'proizvodi/proizvod/' . $this->urlName($item['item_id'].'-'.$item['title']);
        ?>
            <li>
                <div class="item_thumb">
                    <?php if (!empty($item['image'])) { ?>
                        <a href="<?php echo $itemUrl; ?>"><img src="<?php echo $item['images']['160x160'] ?>" alt="thumb"></a>
                    <?php } else { ?>
                        <a href="<?php echo $itemUrl; ?>"><img width="160" alt="no_image"  src="<?php echo URL . 'images/no_image.png' ?>" /></a>
                    <?php } ?>
                </div>
                <h2 class="title4"><a href="<?php echo $itemUrl; ?>"><?php echo $item['title'] ?></a></h2>
                <div class="price"><?php echo number_format($item['price'], 2, ',', '.'); ?> RSD</div>
                <a class="button" href="<?php echo $itemUrl; ?>">detaljnije</a>
            </li>
        <?php endforeach; ?>
    </ul>
    
    
    <?php if ($this->pagesCount > 1) { ?>
    <ul class="pagination">
        <?php for ($i = 1; $i <= $this->pagesCount; $i++) { ?>
            <li>
                <a <?php if ($i == $this->currentPage) { 
                        echo 'class="current"';
                    }?>   
                    href="<?php echo $this->paginationUrl . '?page=' . $i ?>"><?php echo $i; ?></a>
            </li>
        <?php } ?>
    </ul>
    <?php } ?>
    
    
    
</div>
<div class="clear_both"></div>