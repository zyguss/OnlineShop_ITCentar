<?php

class Proizvodi_Controller extends Controller {

    public function index(){
        $search = !empty($_GET['pretraga']) ? $_GET['pretraga'] : '';

        $itemsPerPage = 8; // definišemo broj proizvoda po stranici
        $page = 1;  // po dolasku na proizvodi kontroler default stranica je prva

        // ako postoji get parametar "page" i ako je veci od jedan znaci da nismo na prvoj stranici i dodeljujemo tu vrednost promenljivoj page koja predstavlja trenutnu stranicu
        if (!empty($_GET['page']) && $_GET['page'] > 1) {
            $page = $_GET['page'];
        }
        
        // racunamo koji proizvodi ce biti prikazani na trenutnoj stranici
        // offset oznacava koliko proizvoda preskacemo, prvi proizvod je nulti
        // limit oznacava koliko cemo proizvoda uzeti iz baze
        $offset = ($page - 1) * $itemsPerPage;
        $limit = $itemsPerPage;

        // kontroler poziva metodu iz modela koja vraća broj proizvoda. Prvi parametar metode je kategorija a drugi je pretraga
        $itemsCount = $this->model->countItems(0, $search);

        // pagesCount je broj stranica sa proizvodima, dobijen deljenjem ukupnim brojem proizvoda dobijenih iz prethodne metode sa brojem proizvoda po stranici
        $pagesCount = ceil($itemsCount / $itemsPerPage); // ceil() je php funkcija koja radi zaokruzivanje na više (3.3 = 4)
        $this->view->pagesCount = $pagesCount; // templejtu prosledjujemo podatak o broju stranica
        $this->view->currentPage = $page; // templejtu prosledjemo podatak o trenutnoj stranici

        $categories = $this->model->getCategories(); // pozivamo metodu iz modela koja vadi iz baze podatke o kategorijama
        $this->view->categories = $categories; // prosledjujemo podatke o kategorijama templejtu
        
        // metoda iz modela koja vadi podatke o proizvodima
        // ima 4 parametra jer prosledjujemo kategoriju, od kog proizvoda da krene da vadi podatke i za koliko proizvoda da izvadi podatke iz baze
        // i zadnji parametar je vrednost iz pretrage ako je pretraga postojala
        $items = $this->model->getItems(0, $offset, $limit, $search);
        $this->view->items = $items; // podatke o proizvodima prosledjujemo templejtu
        $this->view->paginationUrl = URL . 'proizvodi';
        $this->view->searchParam = !empty($search) ? '&pretraga=' . $search : '';
        $this->view->search = $search;
        $this->view->render('proizvodi/index.php');
    }

    public function kategorija($categoryUrl) {
        // metoda koja se poziva ako selektujemo odredjenu kategoriju sa stranice o proizvodima
        // imamo i parametar metode koji razbijamo gde god ima "-"
        $categoryId = explode('-', $categoryUrl); // 
        $categoryId = (int)$categoryId[0]; // prvi element razbijenog parametra je id kategorije

        $search = !empty($_GET['pretraga']) ? $_GET['pretraga'] : ''; // ispitujemo da li smo pretrazivali proizvode dok se nalazimo u odredjenoj kategoriji

        $itemsPerPage = 8;
        $page = 1;

        if (!empty($_GET['page']) && $_GET['page'] > 1) {
            $page = $_GET['page'];
        }

        $offset = ($page - 1) * $itemsPerPage;
        $limit = $itemsPerPage;

        $itemsCount = $this->model->countItems($categoryId, $search); // broj proizvoda iz odredjene kategorije koji moze da ima i vrednost iz pretrage

        $pagesCount = ceil($itemsCount / $itemsPerPage);
        $this->view->pagesCount = $pagesCount;
        $this->view->currentPage = $page;

        $categories = $this->model->getCategories();
        $this->view->categories = $categories;
        $this->view->currentCategoryId = $categoryId;
        $items = $this->model->getItems($categoryId, $offset, $limit, $search);
        $this->view->items = $items;
        $this->view->paginationUrl = URL . 'proizvodi/kategorija/' . $categoryId;
        $this->view->searchParam = !empty($search) ? '&pretraga=' . $search : '';
        $this->view->search = $search;
        $this->view->render('proizvodi/index.php');
    }

    public function proizvod($itemUrl) {
        // metoda kontrolera proizvodi koja se poziva kada se prikazuju detaljne informacije o proizvodu
        // parametar ove metode je id proizvoda spojen sa imenom proizvoda
        
        $itemId = explode('-', $itemUrl); // razbijamo parametar kako bismo dobili samo id proizvoda
        $itemId = (int)$itemId[0];

        $categories = $this->model->getCategories();
        $this->view->categories = $categories;
        $item = $this->model->getItem($itemId); // poziv metode iz modela koja vadi podatke o proizvodu
        $this->view->item = $item;
        $this->view->render('proizvodi/proizvod.php');
    }

    public function dodajUkorpu($itemId) {
        // metoda koja se poziva pri dodavanju proizvoda u korpu
        // parametar metode je id proizvoda koji se dodaje u korpu
        
        if (!empty($itemId) && $itemId > 0) {
            $item = $this->model->getItem($itemId); // vadimo podatke o proizvodu koji ubacujemo u korpu
            $_SESSION['korpa'][] = $item; // u nizu sesije pravimo niz korpa koji nam cuva podatke o proizvodima u korpi
        }

        header('Location: ' . URL . 'proizvodi/proizvod/' . $itemId); // redirekcija na selektovani proizvod
    }

    public function korpa() {
        // metoda koja se poziva kada se klikne na korpu
        
        // ako korpa nije prazna brojimo koliko proizvoda ima u njoj
        if(!empty($_SESSION['korpa'])){
            $itemsCount = count($_SESSION['korpa']);
            // sve elemente niza korpa smestamo u promenljivu $items
            $items = $_SESSION['korpa'];
            // prosledjujemo te podatke templejtu
            $this->view->items = $items;
            $this->view->itemsCount = $itemsCount;
        }
        else {
            $this->view->itemsCount = 0;
        }
        
            $this->view->render('proizvodi/korpa.php');  
            
    }

    public function naruci() {
        // naruci je metoda koja se poziva prilikom kupovine
        
        //  prvo proveravamo da li je korisnik ulogovan (ulogovan je ako postoji element user_id u sesiji) i da li ima proizvoda u korpi
        if (!empty($_SESSION['user_id']) &&  !empty($_SESSION['korpa'])) {

            $this->model->purchase($_SESSION['user_id'], $_SESSION['korpa']);
            /*
            foreach ($_SESSION['korpa'] as $item) {
                $this->model->purchase($_SESSION['user_id'], $item);
            }
            */
            // nakon kupovine brisemo proizvode iz korpe
            unset($_SESSION['korpa']);

            header('Location: ' . URL . 'proizvodi');
        }
    }

    
    public function obrisiIzKorpe($rb) {
        // metoda koja brise odredjeni proizvod iz korpe
        
        $rb = empty($rb) ? 0 : $rb;
        unset($_SESSION['korpa'][$rb]);

        header('Location: ' . URL . 'proizvodi/korpa');
        return true;
    }


}

?>