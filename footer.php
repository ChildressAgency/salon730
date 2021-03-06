
    <footer class="footer">
        <div class="footer__social">
            <p>Follow Us</p>
            <div class="footer__icons">
                <?php if( get_option('facebook') ): ?><a href="<?php echo get_option('facebook'); ?>"><i class="fab fa-facebook-square"></i></a><?php endif; ?>
                <?php if( get_option('twitter') ): ?><a href="<?php echo get_option('twitter'); ?>"><i class="fab fa-twitter-square"></i></a><?php endif; ?>
                <?php if( get_option('linkedin') ): ?><a href="<?php echo get_option('linkedin'); ?>"><i class="fab fa-linkedin"></i></a><?php endif; ?>
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
                    <p><?php echo get_option( 'address' ); ?></p>
                    <p>Telephone: <a href="tel:<?php echo get_option( 'phone' ); ?>"><?php echo get_option( 'phone' ); ?></a></p>
                    <p>E-mail: <a href="mailto:<?php echo get_option( 'email' ); ?>"><?php echo get_option( 'email' ); ?></a></p>
                </div>
                <div class="footer__hours">
                    <p><?php echo get_option( 'hours-monday' ); ?> Monday</p>
                    <p><?php echo get_option( 'hours-tuesday' ); ?> Tuesday</p>
                    <p><?php echo get_option( 'hours-wednesday' ); ?> Wednesday</p>
                    <p><?php echo get_option( 'hours-thursday' ); ?> Thursday</p>
                    <p><?php echo get_option( 'hours-friday' ); ?> Friday</p>
                    <p><?php echo get_option( 'hours-saturday' ); ?> Saturday</p>
                    <p><?php echo get_option( 'hours-sunday' ); ?> Sunday</p>
                </div>
            </div>
            <div class="footer__copyright">
                <p><?php echo get_option( 'copyright' ); ?></p>
            </div>
        </div>
    </footer>
    
    <?php wp_footer(); ?>
</body>
</html>