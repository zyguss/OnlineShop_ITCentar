<!DOCTYPE html>
<html>
    <head>
      <meta charset="utf-8">
        <title>online shop</title>
        <link rel="stylesheet" href="<?php echo URL . 'views/public/style.css'; ?>"/>
        <script type="text/javascript" src="<?php echo URL . 'libs/javascript/jquery-1.10.2.min.js' ?>"></script>
    </head>
    <body>
        
        <div id="page">
            <div class="header cf">
                
                <div class="logo">Online Shop</div>

                <?php if (!empty($_SESSION['user_id'])) {  ?>
                <div class="login header_login">
                    
                    <p style="text-align:right;">
                        <?php echo '<b>' . $_SESSION['login'] . '</b>' . ' (' . $_SESSION['first_name'] . ' ' . $_SESSION['last_name'] . ')' ; ?>
                    </p>
                    
                    <a href="<?php echo URL . 'proizvodi/korpa' ?>" >korpa</a>: <?php echo !empty($_SESSION['korpa']) ? count($_SESSION['korpa']) : 0; ?> proizvoda <br/>
										<span class="price">
											<?php 
												$priceSum = 0;
												if (!empty($_SESSION['korpa'])) {
													foreach ($_SESSION['korpa'] as $proizvodUkorpi) {
														$priceSum += $proizvodUkorpi['price'];
													}
												}

												echo number_format($priceSum, 2, ',', '.') . ' RSD'; ?>
										</span>
                </div>
                <?php } ?>
            </div>
            
            <div class="navigation cf">
                <ul>
                    <li><a <?php if (!empty($this->controllerName) && $this->controllerName == 'home') { echo 'class="active"' ; } ?> href="<?php echo URL . 'home' ?>">Home</a></li>
                    <li><a <?php if (!empty($this->controllerName) && $this->controllerName == 'proizvodi') { echo 'class="active"' ; } ?> href="<?php echo URL . 'proizvodi' ?>">Proizvodi</a></li>
                    <li><a <?php if (!empty($this->controllerName) && $this->controllerName == 'kontakt') { echo 'class="active"' ; } ?> href="<?php echo URL . 'kontakt' ?>">Kontakt</a></li>
                    <?php if (!empty($_SESSION['user_id'])) { ?>
                        <li><a <?php if (!empty($this->controllerName) && $this->controllerName == 'korisnici') { echo 'class="active"' ; } ?> href="<?php echo URL . 'korisnici/logout' ?>">Logout</a></li>
                    <?php } else { ?>
                        <li><a <?php if (!empty($this->controllerName) && $this->controllerName == 'korisnici') { echo 'class="active"' ; } ?> href="<?php echo URL . 'korisnici/login' ?>">Login</a></li>
                    <?php }?>
                </ul>
            </div>
            <div class="content">

