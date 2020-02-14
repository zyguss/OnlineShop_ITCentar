<table>
    <tr>
        <th>Naslov</th>
        <th>Cena</th>
    </tr>
<?php
    foreach ($this->purchaseDetails as $detail){
        echo '<tr>';
        echo '<td>'.$detail['title'].'</td>';
        echo '<td>'.$detail['price'].'</td>';
        echo '</tr>';
    }
?>
</table>
            

