<?php
echo '<h1>' . $this->kontaktPage['title'] . '</h1>';
?>

<div style="float:left;">
    <?php
    echo $this->kontaktPage['description'];
    ?>


    <h3 style="margin-top: 25px;">Kontaktirajte nas!</h3>

    <?php
    if (!empty($_GET['message']) && $_GET['message'] == 'sent') {
        echo '<p style="color:red; font-weight:bold;">Usrešno ste poslali poruku!</p>';
    }
    if (!empty($_GET['error']) && $_GET['error'] == 1) {
        echo '<p style="color:red; font-weight:bold;">Niste popunili sva polja!</p>';
    }
    if (!empty($_GET['error']) && $_GET['error'] == 2) {
        echo '<p style="color:red; font-weight:bold;">Niste uneli validan Email!</p>';
    }
    ?>

    <form class="form contact_form" action="<?php echo URL . 'kontakt/dodajKontakt'; ?>" method="post" >
        <label for="name">Ime i prezime</label> <input type="text" id="name" name="name" /> <br/>
        <label for="email">Email</label> <input type="text" id="email" name="email" /> <br/>
        <label for="text">Tekst</label> <textarea id="text" name="text"></textarea> <br/>
        <input class="button" type="submit" value="Pošalji">
    </form>
</div>
<div style="clear: both;"></div>