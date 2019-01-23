
    <footer class="footer">
        <div class="footer__social">
            <p>Follow Us</p>
            <div class="footer__icons">
                <a href="<?php echo get_option('facebook'); ?>"><i class="fab fa-facebook-square"></i></a>
                <a href="<?php echo get_option('twitter'); ?>"><i class="fab fa-twitter-square"></i></a>
                <a href="<?php echo get_option('linkedin'); ?>"><i class="fab fa-linkedin"></i></a>
            </div>
        </div>
        <div class="footer__main">
            <div class="footer__info">
                <div class="footer__nav">
                    <?php 
                    wp_nav_menu( array(
                        'theme_location'    =>  'footer_menu',
                        'menu_class'        =>  'navbar__nav',
                        'walker'            =>  new Custom_Nav_Walker()
                    ) ); ?>
                </div>
                <div class="footer__contact">
                    <p>730 Kenmore Avenue,<br/>Fredericksburg, VA 22401</p>
                    <p>Telephone: <a href="tel:540-373-6040">540-373-6040</a></p>
                    <p>E-mail: <a href="mailto:salon730@aol.com">salon730@aol.com</a></p>
                </div>
                <div class="footer__hours">
                    <p>9am - 8pm Monday</p>
                    <p>9am - 8pm Tuesday</p>
                    <p>9am - 8pm Wednesday</p>
                    <p>9am - 8pm Thursday</p>
                    <p>9am - 5pm Friday</p>
                    <p>9am - 4pm Saturday</p>
                    <p>Closed Sunday</p>
                </div>
            </div>
            <div class="footer__copyright">
                <p>SALON 730 &copy; <?php echo date('Y'); ?> | <a href="#_">PRIVACY POLICY</a> | Website Design by <a href="https://childressagency.com">Childress Agency</a></p>
            </div>
        </div>
    </footer>
    
    <?php wp_footer(); ?>
</body>
</html>