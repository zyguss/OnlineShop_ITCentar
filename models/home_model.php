<?php

class Home_Model extends Model {
    
    public function getPage($pageName) {
        $page = array();
        
        $sql = "SELECT page_id, page, title, description
                FROM pages 
                WHERE page LIKE '$pageName'";
        $result = $this->db->query($sql);
        
        if ($result->rowCount() > 0) {
            $page = $result->fetch(PDO::FETCH_ASSOC);
        }
        
        return $page;
    }
}

?>