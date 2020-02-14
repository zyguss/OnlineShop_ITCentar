<table border="1">
    <tr>
        <th>Ime i Prezime</th>
        <th>Datum kupovine</th>
        <th>Kolicina</th>
        <th>Ukupna cena</th>
        <th>Detalji</th>
    </tr>
    <?php
    foreach ($this->allOfPurchases as $purchase) {

        echo "<tr>";
        echo "<td>" . $purchase['first_name'] . " " . $purchase['last_name'] . "</td>";
        echo "<td>" . date('d.m.Y.', $purchase['purchase_date']) . "</td>";
        echo "<td>" . $purchase['amount'] . "</td>";
        echo "<td>" . $purchase['total_price'] . "</td>";
        echo "<td><button class='button' id='" . $purchase['purchase_id'] . "'>detalji - " . $purchase['purchase_id'] . "</button></td>";
        echo "</tr>";
    }
    ?>

</table>


<div class='background'>

    <div class='detailOfPurchases'> 
        <div id='btnClose'>
            <img src="<?php echo URL . 'images/icon_close.png'; ?>" />
        </div>
        <div class="details"></div>
    </div>
</div>
<script>
    jQuery(document).ready(function ($) {
        $('.button').click(function() {
            var id = $(this).attr('id');
            console.log("KLIK");
            console.log(id);
            $('.details').load(
                '<?php echo ADMIN_URL; ?>kupovina/getDetail', {
                purchase_id: id
            });
            $('.background').slideDown(3000);
            $('#btnClose').click(function () {
                $('.background').slideUp(3000);
            });
        });
    });
</script>