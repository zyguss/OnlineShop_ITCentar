<?php

class Router {
    
    public function __construct($access = 'public') {
        // po defaultu access je postavljen na public
        // ako idemo na admin stranicu u admin.php je postavljeno da pravi objekat sa argumentom 'admin'
        $url = !empty($_GET['url']) ? $_GET['url'] : null;
        $url = rtrim($url,'/'); // uklanja kosu crtu sa desne strane
        $url = filter_var($url, FILTER_SANITIZE_URL);
        $url = explode('/',$url); // razdvajanje stringa gde god ima kosa crta

        $Controller = !empty($url[0]) ? $url[0] : 'home';
        $Function = !empty($url[1]) ? $url[1] : '';
        $Parameter1 = !empty($url[2]) ? $url[2] : '';

        // ispitujemo da li je public ili admin
        // ako je admin moramo da dodamo 'admin' u imenu fajlova koje pozivamo
        // admin fajlovi u svom nazivu imaju '_admin'
        $adminPrefix = $access == 'admin' ? '_admin' : '';
        
        // ako zahtevamo admin stranicu a sesija nije postavljena router nas vodi na login admin stranicu
        // osim u slucaju da idemo na admin login stranicu da ne bi doslo do mrtve petlje
        if ( $access == 'admin' && empty($_SESSION['user_id']) && $Function != 'login' && $Function != 'ulogujSe' ) {
            header('Location: ' . ADMIN_URL . 'korisnici/login');
            die();
        }
        
        // ako zahtevamo admin stranicu a ulogovani smo kao public korisnik
        if ( $access == 'admin' && !empty($_SESSION['user_id']) && (empty($_SESSION['group_id']) || $_SESSION['group_id'] != 1) ) {
            unset($_SESSION);
            session_destroy();
            header('Location: ' . ADMIN_URL . 'korisnici/login');
            die();
        }

        $file = BASE_PATH . 'controllers/' . $Controller . $adminPrefix . '_controller.php';
        if (file_exists($file)) {
            require $file;
            $controllerName = ucfirst($Controller) . $adminPrefix . '_Controller';
            // $controllerName = Home_Controller ili ako je 
            $controller = new $controllerName($Controller);
        } else {
            $this->error404($access);
        }


        if (!empty($Function)) {
            if (!method_exists($controller, $Function)) {
                $this->error404($access);
            }
            if (!empty($Parameter1)) {
                $controller->{$Function}($Parameter1);
            } else {
                $controller->{$Function}();
            }
        } else {
            if (!method_exists($controller, 'index')) {
                $this->error404($access);
            } else {
                $controller->index();
            }            
        }
    }

    private function error404($access) {
        if($access == 'admin'){
            require BASE_PATH . 'controllers/error_admin_controller.php';

            $controller = new Error_Admin_Controller();
            $controller->index();
            die();
        }
        require BASE_PATH . 'controllers/error_controller.php';

        $controller = new Error_Controller();
        $controller->index();
        die();
    }
    
}
?>