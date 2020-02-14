<h1>
    <?php
    echo $this->homePage['title'];
    ?>
</h1>

<?php // echo $this->homePage['description']; ?>

<div>
    <div style="float:left;">
        <img  src="<?php echo URL . 'images/onlineshop.png' ?>" />
    </div>
    <div style="float:left; font-size: 18px;">
        <p style="margin: 15px;">
            <?php
            echo $this->homePage['description'];
            ?>
        </p>
    </div>
    <div style="clear:both;"></div>
</div>




