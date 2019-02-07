<?php
    
    function theme_options(){
        add_menu_page( 'Theme Options', 'Theme Options', 'administrator', 'theme_options', 'theme_options_page');
    }
    add_action( 'admin_menu', 'theme_options' );

    function register_mysettings() { // whitelist options
      register_setting( 'theme_options', 'logo' );
      register_setting( 'theme_options', 'address' );
      register_setting( 'theme_options', 'phone' );
      register_setting( 'theme_options', 'email' );
      register_setting( 'theme_options', 'twitter' );
      register_setting( 'theme_options', 'facebook' );
      register_setting( 'theme_options', 'linkedin' );
      register_setting( 'theme_options', 'instagram' );
      register_setting( 'theme_options', 'insta_access_token' );
      register_setting( 'theme_options', 'hours-monday' );
      register_setting( 'theme_options', 'hours-tuesday' );
      register_setting( 'theme_options', 'hours-wednesday' );
      register_setting( 'theme_options', 'hours-thursday' );
      register_setting( 'theme_options', 'hours-friday' );
      register_setting( 'theme_options', 'hours-saturday' );
      register_setting( 'theme_options', 'hours-sunday' );
      register_setting( 'theme_options', 'copyright' );
    }
    add_action( 'admin_init', 'register_mysettings' );

    function theme_options_page(){
        if( function_exists( 'wp_enqueue_media' ) ){
            wp_enqueue_media();
        } else {
            wp_enqueue_style( 'thickbox' );
            wp_enqueue_script( 'media-upload' );
            wp_enqueue_script( 'thickbox' );
        } ?>
        <div class="wrap">
            <h1>Theme Options</h1>
            <form method="post" action="options.php">
                <?php settings_fields( 'theme_options' ); ?>
                <?php do_settings_sections( 'theme_options' ); ?>

                <table class="form-table">
                    <tr valign="top">
                        <th scope="row">Logo</th>
                        <td style="display: flex; flex-direction: column; align-items: flex-start;">
                            <img class="logo" src="<?php echo get_option('logo'); ?>" height="100"/>
                            <input class="logo_url" type="text" name="logo" size="60" value="<?php echo get_option('logo'); ?>">
                            <a href="#" class="logo_upload">Set Image</a>
                        </td>
                    </tr>
                </table>

                <script>
                    jQuery(document).ready(function($) {
                        $('.logo_upload').click(function(e) {
                            e.preventDefault();

                            var custom_uploader = wp.media({
                                title: 'Custom Image',
                                button: {
                                    text: 'Set Image'
                                },
                                multiple: false  // Set this to true to allow multiple files to be selected
                            })
                            .on('select', function() {
                                var attachment = custom_uploader.state().get('selection').first().toJSON();
                                $('.logo').attr('src', attachment.url);
                                $('.logo_url').val(attachment.url);

                            })
                            .open();
                        });
                    });
                </script>

                <hr />

                <h2>Contact Info</h2>
                <table class="form-table">
                    <tr valign="top">
                        <th scope="row">Address</th>
                        <td><input type="text" name="address" value="<?php echo esc_attr( get_option('address') ); ?>" size="60" /></td>
                    </tr>
                    
                    <tr valign="top">
                        <th scope="row">Phone</th>
                        <td><input type="text" name="phone" value="<?php echo esc_attr( get_option('phone') ); ?>" size="60" /></td>
                    </tr>

                    <tr valign="top">
                        <th scope="row">Email</th>
                        <td><input type="text" name="email" value="<?php echo esc_attr( get_option('email') ); ?>" size="60" /></td>
                    </tr>
                </table>

                <hr />

                <h2>Social</h2>
                <table class="form-table">
                    <tr valign="top">
                        <th scope="row">Twitter</th>
                        <td><input type="text" name="twitter" value="<?php echo esc_attr( get_option('twitter') ); ?>" size="60" /></td>
                    </tr>

                    <tr valign="top">
                        <th scope="row">Facebook</th>
                        <td><input type="text" name="facebook" value="<?php echo esc_attr( get_option('facebook') ); ?>" size="60" /></td>
                    </tr>

                    <tr valign="top">
                        <th scope="row">Linkedin</th>
                        <td><input type="text" name="linkedin" value="<?php echo esc_attr( get_option('linkedin') ); ?>" size="60" /></td>
                    </tr>

                    <tr valign="top">
                        <th scope="row">Instagram</th>
                        <td><input type="text" name="instagram" value="<?php echo esc_attr( get_option('instagram') ); ?>" size="60" /></td>
                    </tr>

                    <tr valign="top">
                        <th scope="row">Instagram Access Token</th>
                        <td><input type="text" name="insta_access_token" value="<?php echo esc_attr( get_option('insta_access_token') ); ?>" size="60" /></td>
                    </tr>
                </table>

                <hr />

                <h2>Hours</h2>
                <table class="form-table">
                    <tr valign="top">
                        <th scope="row">Monday</th>
                        <td><input type="text" name="hours-monday" value="<?php echo esc_attr( get_option('hours-monday') ); ?>" size="60" /></td>
                    </tr>

                    <tr valign="top">
                        <th scope="row">Tuesday</th>
                        <td><input type="text" name="hours-tuesday" value="<?php echo esc_attr( get_option('hours-tuesday') ); ?>" size="60" /></td>
                    </tr>

                    <tr valign="top">
                        <th scope="row">Wednesday</th>
                        <td><input type="text" name="hours-wednesday" value="<?php echo esc_attr( get_option('hours-wednesday') ); ?>" size="60" /></td>
                    </tr>

                    <tr valign="top">
                        <th scope="row">Thursday</th>
                        <td><input type="text" name="hours-thursday" value="<?php echo esc_attr( get_option('hours-thursday') ); ?>" size="60" /></td>
                    </tr>

                    <tr valign="top">
                        <th scope="row">Friday</th>
                        <td><input type="text" name="hours-friday" value="<?php echo esc_attr( get_option('hours-friday') ); ?>" size="60" /></td>
                    </tr>

                    <tr valign="top">
                        <th scope="row">Saturday</th>
                        <td><input type="text" name="hours-saturday" value="<?php echo esc_attr( get_option('hours-saturday') ); ?>" size="60" /></td>
                    </tr>

                    <tr valign="top">
                        <th scope="row">Sunday</th>
                        <td><input type="text" name="hours-sunday" value="<?php echo esc_attr( get_option('hours-sunday') ); ?>" size="60" /></td>
                    </tr>
                </table>

                <h2>Footer</h2>
                <table class="form-table">
                    <tr valign="top">
                        <th scope="row">Copyright</th>
                        <td><input type="text" name="copyright" value="<?php echo esc_attr( get_option('copyright') ); ?>" size="60" /></td>
                    </tr>
                </table>

                <?php submit_button(); ?>
            </form>
        </div>
    <?php } ?>