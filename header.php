<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="IE=edge" http-equiv="X-UA-Compatible">
    <meta content="width=device-width initial-scale=1.0" name="viewport">
    <meta content="The Childress Agency" name="author">
    <meta content="public" http-equiv="cache-control">
    <meta content="private" http-equiv="cache-control">
    
    <title><?php echo get_bloginfo( 'name' ); if( get_bloginfo( 'description' ) ): echo ' | ' . get_bloginfo( 'description' ); endif; ?></title>

    <?php wp_head(); ?>
    
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src='https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js'></script>
    <script src='https://oss.maxcdn.com/respond/1.4.2/respond.min.js'></script>
    <![endif]-->
    <!--[if gte IE 9]
    <style type='text/css'>
    footer {
    filter: none;
    }
    </style>
    <![endif]-->
</head>
<body>
    
    <header class="header">
        <div class="header__brand">
            <a href="<?php echo home_url(); ?>"><img src="<?php echo get_option( 'logo' ); ?>" alt="Salon 730"/></a>
        </div>
        <div class="header__links">
            <a class="header__call" href="tel:540-373-6040">
                <p>CALL TODAY</p>
                <p class="header__number"><?php echo get_option( 'phone' ); ?></p>
            </a>
            <div class="header__nav">
                <button class="navbar__toggler" type="button" data-target="#main-menu">
                    <i class="fas fa-bars"></i>
                </button>
                
                <div id="main-menu">
                    <?php 
                    wp_nav_menu( array(
                        'theme_location'    =>  'main_menu',
                        'menu_class'        =>  'navbar__nav',
                        'walker'            =>  new Custom_Nav_Walker()
                    ) ); ?>
                </div>
            </div>
        </div>
    </header>
