<?php 

/*
 *
 * Log in popup
 *
 */

$popup_args = array(
        'echo' => true,
        'form_id' => 'loginform',
        'label_username' => __( 'Username', 'quark' ),
        'label_password' => __( 'Password', 'quark' ),
        'label_remember' => __( 'Remember Me', 'quark' ),
        'label_log_in' => __( 'Log in', 'quark' ),
        'id_username' => 'user_login',
        'id_password' => 'user_pass',
        'id_remember' => 'rememberme',
        'id_submit' => 'wp-submit',
        'remember' => true,
        'value_username' => NULL,
        'value_remember' => false 
);

?>
<div id="gk-popup-login" class="gk-popup">      
        <div id="gk-login">
                <?php if ( is_user_logged_in() ) : ?>
                        <h3><?php _e('Your Account', 'quark'); ?></h3>
                        
                        <?php  
                                global $current_user;
                                get_currentuserinfo();
                        ?>
                        
                        <p>
                                <?php echo __('Hi, ', 'quark') . ($current_user->user_firstname) . ' ' . ($current_user->user_lastname) . ' (' . ($current_user->user_login) . ') '; ?>
                        </p>
                        <p>
                                 <a href="<?php echo wp_logout_url(); ?>" class="button invert" title="<?php _e('Logout', 'quark'); ?>">
                                         <?php _e('Logout', 'quark'); ?>
                                 </a>
                        </p>
                
                <?php else : ?>
                        <h3><?php _e('Log In', 'quark'); ?></h3>
                    
                        <?php wp_login_form($popup_args); ?>   

                        <div id="login-forgot">
                             <a class="inverse" href="<?php echo home_url(); ?>/wp-login.php?action=lostpassword" title="<?php _e('Password Lost and Found', 'quark'); ?>"><?php _e('Lost your password?', 'quark'); ?></a>

                        </div>

                         <a class="btn-border full" href="<?php echo home_url(); ?>/wp-login.php?action=register" title="<?php _e('Not a member? Register', 'quark'); ?>"><?php _e(' Don\'t have an account?', 'quark'); ?></a>

                <?php endif; ?>
        </div>
</div>

<?php
// EOF