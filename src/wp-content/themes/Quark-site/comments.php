<?php

/**
 *
 * Comments part
 *
 **/

?>
<?php if ( post_password_required() ) : ?>
<section id="comments">
	<p class="no-password"><?php _e( 'Esse post é protegido por senha. Entre com a senha para visualizar quaisquer comentários.', 'quark' ); ?></p>
</section>
<?php
	return;/* Stop the rest of comments.php from being processed */
	endif;
?>
<?php if(comments_open() || get_comments_number()) : ?>
<div id="comments" class="comments-area">
	<?php if ( have_comments() ) : ?>
		<h3 class="comments-title">
			<?php if(get_comments_number() == 1) : ?>
			<?php _e( '1 Comentário', 'quark'); ?>
			<?php elseif(get_comments_number() == 2) : ?>
			<?php _e( '2 Comentários', 'quark'); ?>
			<?php elseif(get_comments_number() > 2) : ?>
			<?php printf(__( '%1$s Comentários', 'quark'), number_format_i18n(get_comments_number())); ?>
			<?php endif; ?>
		</h3>

		<ol class="comment-list">
			<?php wp_list_comments(
									array(
											'avatar_size' => 80,
											'callback' => 'quark_comment_template',
											'style' => 'ol'
									)
			); ?>
		</ol><!-- .comment-list -->

		<?php
			// Are there comments to navigate through?
			if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
		?>
		<nav>
			<h1 class="screen-reader-text section-heading"><?php _e( 'Navegação de comentários', 'quark' ); ?></h1>
			<div class="nav-prev"><?php previous_comments_link( __( '&larr; Comentários Antigos', 'quark' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Novos Comentários &rarr;', 'quark' ) ); ?></div>
		</nav><!-- .comment-navigation -->
		<?php endif; ?>

		<?php if (!comments_open() && get_comments_number()) : ?>
		<p class="no-comments"><?php _e( 'Comentários estão fechados.' , 'quark' ); ?></p>
		<?php endif; ?>

	<?php endif; // have_comments() ?>

	<?php comment_form(array(
        'title_reply' => _e("<h3>Deixe um comentário</h3><p>Os comentários enviados às matérias aqui veiculadas serão publicados levando em conta a relevância para as discussões às quais elas se propõem. A responsabilidade sobre cada comentário é de exclusividade do autor e não representa posição do Centro de Trabalho Indigenista. Por esse motivo, incentivamos a identificação dos autores. São bem-vindas colaborações críticas que enriqueçam o debate. Agressões, insultos ou declarações de cunho preconceituoso não serão aceitos.</p>", "quark"),	)); ?>
</div><!-- #comments -->
<?php endif;

// EOF
