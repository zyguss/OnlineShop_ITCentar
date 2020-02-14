<?php

class Kupovina_Admin_Model extends Admin_Model {
        
    public function getPurchases(){
        $purchases = array();
        $allOdPurchase = array();

        $sql = "SELECT p.purchase_id, p.fk_user_id, p.purchase_date, p.amount, p.total_price, u.login, u.first_name, u.last_name
                FROM purchases p
                INNER JOIN users u
                ON p.fk_user_id=u.user_id ";
        $result = $this->db->query($sql);
        if($result->rowCount() > 0){
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                $purchases[] = $row;
            }
        }
        $allOdPurchase['purchases'] = $purchases;
        
        return $purchases;
    }
    
    public function getDetailsOfPurchase($purchase_id){
        $sql = "SELECT i.title, i.price
        FROM items_to_purchases ip
        INNER JOIN purchases p ON p.purchase_id=ip.fk_purchase_id
        INNER JOIN items i ON i.item_id=ip.fk_item_id
        WHERE ip.fk_purchase_id=$purchase_id ";

        $result = $this->db->query($sql);
        if($result->rowCount() > 0){
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                $purchaseDetails[] = $row;
            }
        }
        return $purchaseDetails;
    }
    
}


?>
