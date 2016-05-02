<?php
/*
Template Name: Contact Page
*/

// check if reCAPTCHA isn't loaded earlier by other plugin
if (!class_exists('ReCaptcha') && !function_exists('_recaptcha_qsencode')) {
    get_template_part('addons/class.recaptchalib');
}

$publickey = get_theme_mod('quark_contact_public_key','');
$privatekey = get_theme_mod('quark_contact_private_key','');

// The response from reCAPTCHA
$resp = null;
// The error code from reCAPTCHA, if any
$error = null;

$params_name = true;
$params_email = true;
$params_copy = true;


// flag used to detect if the page is validated
$validated = true;
// flag to detect if e-mail was sent
$messageSent = false;
// variable to store the errors, empty string means no error
$errors = array(
    "name" => '',
    "email" => '',
    "message" => '',
    "recaptcha" => ''
);
// variable for the input fields output
$output = array(
    "name" => '',
    "email" => '',
    "message" => ''
);
// if the form was sent
if(isset($_POST['message-send'])) {
    // check the name
    if($params_name) {
        if(trim($_POST['contact-name']) === '') {
            $validated = false;
            $errors['name'] = __('Por favor entre com seu nome', 'quark');
        } else {
            $output['name'] = trim($_POST['contact-name']);
        }
    }
    // check the e-mail
    if($params_email) {
        if(trim($_POST['email']) === '' || !eregi("^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,4}$", trim($_POST['email']))) {
            $validated = false;
            $errors['email'] = __('Por favor entre com seu email.', 'quark');
        } else {
            $output['email'] = trim($_POST['email']);
        }
    }
    // check the message content
    if(trim($_POST['comment-text']) === '') {
        $validated = false;
        $errors['message'] = __('Por favor entre com o texto.', 'quark');
    } else {
        $output['message'] = stripslashes(trim(htmlspecialchars($_POST['comment-text'])));
    }
    // reCAPTCHA validation
    if(
        get_theme_mod('quark_contact_enable_captcha', 0) == 1 &&
        $publickey != '' &&
        $privatekey != ''
    ) {
        $reCaptcha = new ReCaptcha("$publickey");
        if ($_POST["g-recaptcha-response"]) {
        $resp = $reCaptcha->verifyResponse(
                        $_SERVER["REMOTE_ADDR"],
                        $_POST["g-recaptcha-response"]
                    );
        } else {
                    $validated = false;
                    $errors['recaptcha'] = __("O reCAPTCHA não foi preenchido corretamente. Volte e tente de novo.", 'quark');
        }
    }
    // if the all fields was correct
    if($validated) {
        // send an e-mail
        $email = get_theme_mod('quark_contact_email','');
        // if the user specified blank e-mail or not specified it
        if(trim($email) == '') {
            $email = get_option('admin_email');
        }
        // e-mail structure
        if($params_name) {
            $subject = __('De ', 'quark') . $output['name'];
        } else if(!$params_name && $params_email) {
            $subject = __('De ', 'quark') . $output['email'];
        } else {
            $subject = __('De ', 'quark') . get_bloginfo('name');
        }

        $body = "<html>";
        $body .= "<body>";
        $body .= "<h1 style=\"font-size: 24px; border-bottom: 4px solid #EEE; margin: 10px 0; padding: 10px 0; font-weight: normal; font-style: italic;\">".__('Mensagem de', 'quark')." <strong>".get_bloginfo('name')."</strong></h1>";

        if($params_name) {
            $body .= "<div>";
            $body .= "<h2 style=\"font-size: 16px; font-weight: normal; border-bottom: 1px solid #EEE; padding: 5px 0; margin: 10px 0;\">".__('Nome:', 'quark')."</h2>";
            $body .= "<p>".$output['name']."</p>";
            $body .= "</div>";
        }

        if($params_email) {
            $body .= "<div>";
            $body .= "<h2 style=\"font-size: 16px; font-weight: normal; border-bottom: 1px solid #EEE; padding: 5px 0; margin: 10px 0;\">".__('E-mail:', 'quark')."</h2>";
            $body .= "<p>".$output['email']."</p>";
            $body .= "</div>";
        }

        $body .= "<div>";
        $body .= "<h2 style=\"font-size: 16px; font-weight: normal; border-bottom: 1px solid #EEE; padding: 5px 0; margin: 10px 0;\">".__('Mensagem:', 'quark')."</h2>";
        $body .= $output['message'];
        $body .= "</div>";
        $body .= "</body>";
        $body .= "</html>";

        if($params_name && $params_email) {
            $headers[] = 'From: '.$output['name'].' <'.$output['email'].'>';
            $headers[] = 'Reply-To: ' . $output['email'];
            $headers[] = 'Content-type: text/html';
        } else if($params_name && !$params_email) {
            $headers[] = 'From: '.$output['name'];
            $headers[] = 'Content-type: text/html';
        } else if(!$params_name && $params_email) {
            $headers[] = 'From: '.$output['email'].' <'.$output['email'].'>';
            $headers[] = 'Reply-To: ' . $output['email'];
            $headers[] = 'Content-type: text/html';
        } else {
            $headers[] = 'Content-type: text/html';
        }

        wp_mail($email, $subject, $body, $headers);

        if($params_copy && $params_email && isset($_POST['send_copy'])) {
            wp_mail($output['email'], $subject, $body, $headers);
        }

        $messageSent = true;
    }

}

get_header("frontpage"); ?>

    <div id="primary" class="content-area">
        <div id="content" class="site-content contact" role="main">
            <?php the_post(); ?>
            <?php do_action('quark_before_content'); ?>
            <article class="one-page">
                <header class="entry-header<?php if ( '' == get_the_post_thumbnail()) : ?> no-image<?php endif; ?>">
                    <?php if ( has_post_thumbnail() && !post_password_required() ) : ?>
                        <?php do_action('quark_before_post_image'); ?>
                        <?php the_post_thumbnail(); ?>
                        <?php do_action('quark_after_post_image'); ?>
                    <?php endif; ?>

                    <div class="entry-title-wrap">
                        <h1 data-sr="enter bottom and move 50px" class="entry-title"><?php the_title(); ?></h1>

                        <?php if(get_theme_mod('quark_contact_email_header','contato@trabalhoindigenista.org.br') != '') : ?>
                        <h2 data-sr="enter bottom and move 50px and wait .15s" class="entry-title">
                            <?php echo get_theme_mod('quark_contact_email_header','contato@trabalhoindigenista.org.br'); ?>
                        </h2>
                        <?php endif; ?>

                        <!-- ?php if(get_theme_mod('quark_contact_fb','#') != '' || get_theme_mod('quark_contact_twitter','#') != '' || get_theme_mod('quark_contact_gplus','#') != '') : ?>
                        <div class="gk-social-icons-block" data-sr="enter bottom and move 50px and wait .3s">
                            < ?php if(get_theme_mod('quark_contact_fb','#') != '') : ?><a href="< ?php echo get_theme_mod('quark_contact_fb','#');?>"><i class="gkicon-fb"></i></a>< ?php endif ;?>
                            < ?php if(get_theme_mod('quark_contact_twitter','#') != '') : ?><a href="< ?php echo get_theme_mod('quark_contact_twitter','#');?>"><i class="gkicon-twitter"></i></a>< ?php endif ;?>
                            < ?php if(get_theme_mod('quark_contact_gplus','#') != '') : ?><a href="< ?php echo get_theme_mod('quark_contact_gplus','#');?>"><i class="gkicon-gplus"></i></a>< ?php endif ;?>
                        </div>
                        < ?php endif; ? -->
                    </div>

                    <!-- ?php if(get_theme_mod('quark_contact_map_url','https://www.google.com.br/maps/@-23.5441027,-46.6914086,17z?hl=pt-BR') != '') : ?>
                        <p><a href="< ?php echo get_theme_mod('quark_contact_map_url','https://www.google.com.br/maps/@-23.5441027,-46.6914086,17z?hl=pt-BR');?>" class="gk-map-icon"><i class="gkicon-marker"></i>< ?php _e('Ver no Google Maps','quark'); ?></a></p>
                    < ?php endif; ? -->

                </header>

                <div class="site">
                    <div class="contact-form">
                    <?php if($messageSent == true) : ?>
                    <p class="gk-success"><?php _e('Sua mensagem foi enviada com sucesso.', 'quark'); ?></p>
                    <p><a href="<?php echo home_url(); ?>"><?php _e('Voltar para a página', 'quark'); ?></a></p>
                    <?php else : ?>

                        <?php if(!$validated) : ?>
                        <p class="gk-error"><?php _e('Desculpe, ocorreu um erro.', 'quark'); ?></p>
                        <?php endif; ?>

                        <form action="<?php the_permalink(); ?>" id="gk-contact" method="post">
                            <dl>
                                <?php if($params_name) : ?>
                                <dt>
                                    <label for="contact-name"><?php _e('Name:', 'quark'); ?></label>
                                    <?php if($errors['name'] != '') : ?>
                                    <span class="error"><?php echo $errors['name'];?></span>
                                    <?php endif; ?>
                                </dt>
                                <dd>
                                    <input type="text" name="contact-name" id="contact-name" value="<?php echo $output['name'];?>" />
                                </dd>
                                <?php endif; ?>

                                <?php if($params_email) : ?>
                                <dt>
                                    <label for="email"><?php _e('Email:', 'quark'); ?></label>
                                    <?php if($errors['email'] != '') : ?>
                                    <span class="error"><?php echo $errors['email'];?></span>
                                    <?php endif; ?>
                                </dt>
                                <dd>
                                    <input type="text" name="email" id="email" value="<?php echo $output['email'];?>" />
                                </dd>
                                <?php endif; ?>

                                <dt class="gk-message">
                                    <label for="comment-text"><?php _e('Message:', 'quark'); ?></label>
                                    <?php if($errors['message'] != '') : ?>
                                    <span class="error"><?php echo $errors['message'];?></span>
                                    <?php endif; ?>
                                </dt>
                                <dd>
                                    <textarea name="comment-text" id="comment-text" rows="6" cols="30"><?php echo $output['message']; ?></textarea>
                                </dd>
                            </dl>

                            <?php if($params_copy && $params_email) : ?>
                            <p>
                                <label>
                                    <input type="checkbox" name="send_copy" />
                                    <?php _e('Enviar cópia para si mesmo', 'quark'); ?>
                                </label>
                            </p>
                            <?php endif; ?>


                            <?php if(
                                    get_theme_mod('quark_contact_enable_captcha', 0) == 1 &&
                                    $publickey != '' &&
                                    $privatekey != ''
                                ) :
                                wp_enqueue_script( 'gk-captcha-script', 'https://www.google.com/recaptcha/api.js', array( 'jquery' ), false, false);
                                ?>
                                <p>
                                    <?php if($errors['recaptcha'] != '') : ?>
                                    <span class="error"><?php echo $errors['recaptcha'];?></span>
                                    <?php endif; ?>
                                </p>

                                <div class="g-recaptcha" data-sitekey="<?php echo $publickey; ?>"></div>
                            <?php endif; ?>

                            <p>
                                <input type="submit" value="<?php _e('Enviar mensagem', 'quark'); ?>" />
                            </p>
                            <input type="hidden" name="message-send" id="message-send" value="true" />
                        </form>
                    <?php endif; ?>
                    </div>

                    <div class="contact-details">
                        <?php the_content(); ?>
                    </div>
                </div>
            </article>
            <?php do_action('quark_after_content'); ?>

        </div><!-- #content -->
    </div><!-- #primary -->

<?php get_footer("frontpage"); ?>
