<h1>NOVI PROIZVOD</h1>

<div>
    <form class="form" action="<?php echo ADMIN_URL . 'proizvodi/dodajProizvod' ?>" method="post" enctype="multipart/form-data">
        <label for="title">Naziv</label> <input type="text" id="title" name="title" /> <br/>
        <label for="description">Opis</label> <textarea id="description" name="description" ></textarea> <br/>
        <label for="price">Cena</label> <input type="text" id="price" name="price" /> <br/>
        <label for="image">Slika</label> <input type="file" id="image" name="image" /> <br/>
        <label for="fk_category_id">Kategorija</label>
            <select name="fk_category_id">
                <option value=""> - - - - - </option>
                <?php
                    foreach ($this->categories as $category) {
                        echo '<option value="' . $category['category_id'] .'">'. $category['name'] . '</option>';
                    }
                ?>
            </select> <br/>
        <input class="button" type="submit" value="dodaj" />
    </form>
    
</div>
<div class="clear_both"></div>