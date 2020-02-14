<h1>PROIZVOD</h1>

<div class="categories">
    <h3>Kategorije</h3>
    
    <ul class="categories_list">
        <?php foreach ($this->categories as $category) {?>
            <li <?php if (!empty($this->item['fk_category_id']) && $this->item['fk_category_id'] == $category['category_id'] ) { echo 'class="active"'; } ?> >
                <a href="<?php echo URL . 'proizvodi/kategorija/' . $this->urlName($category['category_id'].'-'.$category['name']); ?>"> <?php echo $category['name'] ?> </a> <span>(<?php echo  $category['number_of_items_in_category']; ?>)</span>
            </li>
        <?php } ?>
    </ul>
</div>
<div class="items">
    <h3><?php echo $this->item['title']; ?></h3>

    <div class="item_image">
        <?php if (!empty($this->item['image'])) { ?>
            <img alt="<?php echo $this->item['image']; ?>"  src="<?php echo $this->item['images']['300x300'] ?>" />
        <?php } else { ?>
            <img alt="no_image"  src="<?php echo URL . 'images/no_image.png' ?>" />
        <?php } ?>
        
    </div>
    <div class="item_desc">
        <p>
            <?php echo $this->item['description']; ?>
        </p>

        <div class="price">
            <?php echo number_format($this->item['price'], 2, ',', '.'); ?> RSD
        </div>

        <?php if (!empty($_SESSION['user_id'])) { ?>
        <div>
            <a class="button" href="<?php echo URL . 'proizvodi/dodajUkorpu/' . $this->item['item_id']; ?>">dodaj u korpu</a>
        </div>
        <?php } ?>

    </div>
</div>
<div class="clear_both"></div>