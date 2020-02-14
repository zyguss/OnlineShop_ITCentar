<h1>KORPA</h1>

<div class="items">
    
    <?php 
        if($this->itemsCount > 0) : 
    ?>
    
    <h3>Proizvodi u korpi</h3>

        <table border="1" >
            <tr>
                <td>Proizvod</td>
                <td>Kategorija</td>
                <td>Cena</td>
                <td>&nbsp;</td>
            </tr>
            <?php $sumPrice = 0; ?>
            <?php foreach ($this->items as $rb => $item): ?>
            <tr>
                <td><?php echo $item['title'] ?></td>
                <td><?php echo $item['category'] ?></td>
                <td><?php echo $item['price'] ?></td>
                <td><a  style="color:red;" href="<?php echo URL . 'proizvodi/obrisiIzKorpe/' . $rb; ?>">X</a></td>
                <?php $sumPrice += $item['price'];?>
            </tr>
            <?php endforeach; ?>
        </table>


        <p>Broj proizvoda u korpi: <?php echo $this->itemsCount; ?></p>
        <p>Ukupna cena: <?php echo number_format($sumPrice, 2, ',', '.') ?></p>


        <div>
            <a class="button" href="<?php echo URL . 'proizvodi/naruci'; ?>">Naruči</a>
        </div>

    <?php
        
        else :
          
    ?>
        <h3>Korpa je prazna</h3>
    <?php
        endif;
    ?>
        
</div>
<div class="clear_both"></div>