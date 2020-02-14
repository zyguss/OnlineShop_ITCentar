<h1>AZURIRANJE PROIZVODA</h1>

<div>
    <form class="form" action="<?php echo ADMIN_URL . 'proizvodi/izmeniProizvod' ?>" method="post" enctype="multipart/form-data">
        <input type="hidden" name="item_id" value="<?php echo $this->item['item_id']; ?>" />
        <label for="title">Naziv</label> <input type="text" id="title" name="title" value="<?php echo $this->item['title']; ?>" /> <br/>
        <label for="description">Opis</label> <textarea id="description" name="description" ><?php echo $this->item['description']; ?></textarea> <br/>
        <?php if ( !empty($this->item['images']['300x300']) ) { ?>
        <label for="slika" >Slika</label> <img id="slika" alt="<?php echo $this->item['image']; ?>"  src="<?php echo $this->item['images']['300x300'] ?>" /> <br/>
        <?php } ?>
        <label for="image">Izmeni sliku</label> <input type="file" id="image" name="image" /> <br/>
        <label for="price">Cena</label> <input type="text" id="price" name="price" value="<?php echo $this->item['price']; ?>" /> <br/>
        <label for="fk_category_id">Kategorija</label>
            <select name="fk_category_id">
                <option value=""> - - - - - </option>
                <?php
                    foreach ($this->categories as $category) {
                        echo '<option ' .  ($this->item['fk_category_id'] == $category['category_id'] ? 'selected="selected"' : '') .  ' value="' . $category['category_id'] .'">'. $category['name'] . '</option>';
                    }
                ?>
            </select> <br/>
        <input class="button" type="submit" value="dodaj" />
    </form>
    
</div>
<div class="clear_both"></div>