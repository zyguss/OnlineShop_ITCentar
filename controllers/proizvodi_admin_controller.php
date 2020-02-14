<?php

class Proizvodi_Admin_Controller extends Admin_Controller {

    public $thumbs = array(
        '160x160' => array('width' => 160, 'height' => 160),
        '300x300' => array('width' => 300, 'height' => 300)
    );

    public function kategorije() {
        $this->view->activeNavigation = 'kategorije';
        $categories = $this->model->getCategories();
        $this->view->categories = $categories;
        $this->view->render('proizvodi/kategorije.php');
    }

    public function dodajKategoriju() {
        $name = $_POST['name'];
        if ($this->model->addCategory($name)) {
            $poruka = 'ok';
        } else {
            $poruka = 'false';
        }
        $_SESSION['poruka'] = $poruka;
        header('Location: ' . ADMIN_URL . 'proizvodi/kategorije');
        die();
    }

    public function obrisiKategoriju() {
        $categoryId = $_GET['category_id'];
        $this->model->deleteCategory($categoryId);
        header('Location: ' . ADMIN_URL . 'proizvodi/kategorije');
    }

    public function index() {
        $this->view->activeNavigation = 'proizvodi';
        $search = !empty($_GET['pretraga']) ? $_GET['pretraga'] : '';

        $itemsPerPage = 3;
        $page = 1;

        if (!empty($_GET['page']) && $_GET['page'] > 1) {
            $page = $_GET['page'];
        }

        $offset = ($page - 1) * $itemsPerPage;
        $limit = $itemsPerPage;

        $itemsCount = $this->model->countItems(0, $search);

        $pagesCount = ceil($itemsCount / $itemsPerPage);
        $this->view->pagesCount = $pagesCount;
        $this->view->currentPage = $page;

        $items = $this->model->getItems(0, $offset, $limit, $search);
        $this->view->items = $items;
        $this->view->paginationUrl = ADMIN_URL . 'proizvodi';
        $this->view->searchParam = !empty($search) ? '&pretraga=' . $search : '';
        $this->view->search = $search;
        $this->view->render('proizvodi/index.php');
    }

    public function noviProizvod() {
        $this->view->activeNavigation = 'proizvodi';

        $categories = $this->model->getCategories();
        $this->view->categories = $categories;

        $this->view->render('proizvodi/novi_proizvod.php');
    }

    public function dodajProizvod() {
        $item['title'] = $_POST['title'];
        $item['description'] = $_POST['description'];
        $item['price'] = $_POST['price'];
        $item['fk_category_id'] = $_POST['fk_category_id'];
        $item['image'] = !empty($_FILES['image']['name']) ? $_FILES['image']['name'] : '';

        $itemId = $this->model->addItem($item);

        //Ako dodajemo sliku
        if (!empty($_FILES['image']['tmp_name']) && $_FILES['image']['error'] == 0 && $_FILES['image']['size'] > 0) {
            require_once LIBS . 'PHPThumb/ThumbLib.inc.php';
            $imageFolder = BASE_PATH . 'images/proizvodi/' . $itemId . '/';
            $imageFile = $_FILES['image']['name'];

            if (!is_dir($imageFolder)) {
                mkdir($imageFolder);
            }

//            foreach ($this->thumbs as $thumb) {
//                $newImageFile = $thumb['width'] . 'x' . $thumb['height'] . '_' . $imageFile;
//                $phpThumb = PhpThumbFactory::create($_FILES['image']['tmp_name']);
//                $phpThumb->resize($thumb['width'], $thumb['height'])->save($imageFolder . $newImageFile);
//            }

            $newImageFile = '160x160_' . $imageFile;
            $phpThumb = PhpThumbFactory::create($_FILES['image']['tmp_name']);
            $phpThumb->resize(160, 160)->save($imageFolder . $newImageFile);

            $newImageFile = '300x300_' . $imageFile;
            $phpThumb = PhpThumbFactory::create($_FILES['image']['tmp_name']);
            $phpThumb->resize(300, 300)->save($imageFolder . $newImageFile);
        }

        header('Location: ' . ADMIN_URL . 'proizvodi');
    }

    public function obrisiProizvod() {
        $itemId = $_GET['item_id'];
        $this->model->deleteItem($itemId);
        header('Location: ' . ADMIN_URL . 'proizvodi/');
    }

    public function azuriranjeProizvoda($itemId) {
        $this->view->activeNavigation = 'proizvodi';

        $item = $this->model->getItem($itemId);
        $this->view->item = $item;

        $categories = $this->model->getCategories();
        $this->view->categories = $categories;

        $this->view->render('proizvodi/azuriranje_proizvoda.php');
    }

    public function izmeniProizvod() {
        $item['item_id'] = $_POST['item_id'];
        $item['title'] = $_POST['title'];
        $item['description'] = $_POST['description'];
        $item['price'] = $_POST['price'];
        $item['fk_category_id'] = $_POST['fk_category_id'];
        $item['image'] = !empty($_FILES['image']['name']) ? $_FILES['image']['name'] : '';

        $this->model->updateItem($item);

        //Ako menjamo sliku
        if (!empty($_FILES['image']['tmp_name']) && $_FILES['image']['error'] == 0 && $_FILES['image']['size'] > 0) {
            require_once LIBS . 'PHPThumb/ThumbLib.inc.php';
            $imageFolder = BASE_PATH . 'images/proizvodi/' . $item['item_id'] . '/';
            $imageFile = $_FILES['image']['name'];

            if (!is_dir($imageFolder)) {
                mkdir($imageFolder);
            }

            foreach ($this->thumbs as $thumb) {
                $newImageFile = $thumb['width'] . 'x' . $thumb['height'] . '_' . $imageFile;
                $phpThumb = PhpThumbFactory::create($_FILES['image']['tmp_name']);
                $phpThumb->resize($thumb['width'], $thumb['height'])->save($imageFolder . $newImageFile);
            }
        }

        header('Location: ' . ADMIN_URL . 'proizvodi');
    }

}

?>