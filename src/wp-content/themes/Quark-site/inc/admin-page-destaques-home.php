<?php

add_action('admin_menu', function(){
    DestaquesHome::register();
});

class DestaquesHome{
    static protected $idsCache = [];

    static function register(){


        add_submenu_page( 'themes.php', 'Destaques', 'Destaques', 'manage_options', 'noticias-destaques', [__CLASS__, 'renderPage'] );
    }

    static function getOption($lang){
        $option_name = "cfg::{$lang}";

        return get_option($option_name, [
            'destaque' => '',
            'links' => [
                [
                    'titulo' => 'TECLADO INDÍGENA',
                    'url' => '',
                    'img' => '/wp-content/uploads/2015/10/teclado-indigena.png'
                ],
                [
                    'titulo' => 'BIBLIOTECA DIGITAL',
                    'url' => '',
                    'img' => '/wp-content/uploads/2015/10/biblioteca-digital.png'
                ],
                [
                    'titulo' => 'BOLETIM POVOS ISOLADOS NA AMAZÔNIA',
                    'url' => '',
                    'img' => '/wp-content/uploads/2015/10/boletins-digitais.png'
                ]
            ],
            'campanha' => '',
            'video' => ''
        ]);
    }


    static function renderPage() {
        
        $lang_slugs = pll_languages_list(['fields' => 'slug']);
        $lang_names = pll_languages_list(['fields' => 'name']);

        
        if(isset($_POST['cfg'])){
            foreach($lang_slugs as $lang){
                $option_name = "cfg::{$lang}";

                if(!get_option($option_name)){
                    add_option($option_name, $_POST['cfg'][$lang],'','no');
                } else {
                    update_option($option_name, $_POST['cfg'][$lang]);
                }

            }
        }


        ?>
        <style>
            .cfg{
                margin-bottom:20px;
            }
            
            .cfg label {
                font-size: 13px;
                display:block;
            }

            .cfg input[type="text"] {
                width: 80%;
            }

            .cfg small {
                right:25%;
                display:inline-block;
                position:absolute;
            }

            .cfg .link {
                width:32%;
                float:left;
            }

            .cfg .link input[type="text"] {
                width: 90%;
            }

            .wrap form section {
                background: rgba(0,0,0,.1);
                padding: 5px 15px 15px 15px;
                margin:5px;
                margin-bottom:15px;
                
                border-radius: 5px;
            }
        </style>
        <div class="wrap"><div id="icon-tools" class="icon32"></div>
            <form method="POST">
                <?php foreach($lang_slugs as $index => $lang):
                    $lang_name = $lang_names[$index];
                    $cfg = self::getOption($lang);
                ?>
                    <section>
                        <h2>Configurações da home em <?php echo $lang_name ?></h2>
                        <p class="cfg">
                            <label for="destaque-<?php echo $lang ?>">URL do post destacado:</label>
                            <input id="destaque-<?php echo $lang ?>" type="text" name="cfg[<?php echo $lang ?>][destaque]" value="<?php echo $cfg['destaque'] ?>" placeholder="Cole aqui o link do post destacado"><br>
                        </p>

                        <div class="cfg">
                            <?php foreach([0,1,2] as $num): ?>
                            <div class="link">
                                <strong>Link <?php echo $num + 1 ?></strong><br/>

                                <label for="link-titulo-<?php echo $num ?>-<?php echo $lang ?>">Título:</label>
                                <input id="link-titulo-<?php echo $num ?>-<?php echo $lang ?>" type="text" name="cfg[<?php echo $lang ?>][links][<?php echo $num ?>][titulo]" value="<?php echo $cfg['links'][$num]['titulo'] ?>" placeholder="Título do link <?php echo $num + 1 ?>"><br>

                                <label for="link-url-<?php echo $num ?>-<?php echo $lang ?>">URL:</label>
                                <input id="link-url-<?php echo $num ?>-<?php echo $lang ?>" type="text" name="cfg[<?php echo $lang ?>][links][<?php echo $num ?>][url]" value="<?php echo $cfg['links'][$num]['url'] ?>" placeholder="URL do link <?php echo $num + 1 ?>"><br>

                                <label for="link-img-<?php echo $num ?>-<?php echo $lang ?>">URL da imagem:</label>
                                <input id="link-img-<?php echo $num ?>-<?php echo $lang ?>" type="text" name="cfg[<?php echo $lang ?>][links][<?php echo $num ?>][img]" value="<?php echo $cfg['links'][$num]['img'] ?>" placeholder="URL da imagem do link <?php echo $num + 1 ?>"><br>
                            </div>
                            <?php endforeach; ?>
                            <div class="clear"></div>
                        </div>

                        <p class="cfg">
                            <label for="destaque-<?php echo $lang ?>">URL campanha:</label>
                            <input id="destaque-<?php echo $lang ?>" type="text" name="cfg[<?php echo $lang ?>][campanha]" value="<?php echo $cfg['campanha'] ?>" placeholder="Cole aqui o link do post da campanha"><br>
                        </p>

                        <p class="cfg">
                            <label for="destaque-<?php echo $lang ?>">Código de incorporação do vídeo:</label>
                            <input id="destaque-<?php echo $lang ?>" type="text" name="cfg[<?php echo $lang ?>][video]" value="<?php echo htmlentities(stripslashes($cfg['video'])) ?>" placeholder="Cole aqui o link do vídeo"><br>
                        </p>

                    </section>
                <?php endforeach; ?>
                <input type="submit" class="button button-primary button-large" value="salvar"/>
            </form>
        </div>
        <?php
    }

    static function getPostId($type, $lang = null){
        if(is_null($lang)){
            $lang = pll_current_language();
        }

        if($type != 'destaque' && $type != 'campanha'){
            return null;
        }

        $cfg = self::getOption($lang);

        $url = $cfg[$type];
        $post_id = url_to_postid($url);

        return $post_id;
    }

    static function getPost($type, $lang = null){
        $post_id = self::getPostId($type, $lang);

        return get_post($post_id);
    }

}