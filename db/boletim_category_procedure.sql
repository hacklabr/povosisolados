DELIMITER //
DROP PROCEDURE IF EXISTS wp_3_P_create_boletim_category //
CREATE PROCEDURE wp_3_P_create_boletim_category(IN post_ID BIGINT(20) UNSIGNED)
BEGIN
    DECLARE current_theme VARCHAR(128) DEFAULT '';
    DECLARE category_slug VARCHAR(200) DEFAULT '';
    DECLARE cat_term_id BIGINT(20) UNSIGNED DEFAULT 0;
    DECLARE tra_term_id BIGINT(20) UNSIGNED DEFAULT 0;
    DECLARE tra_refs_id BIGINT(20) UNSIGNED DEFAULT 0;
    DECLARE tra_term_slug VARCHAR(32) DEFAULT '';
    DECLARE tra_term_desc VARCHAR(64) DEFAULT '';
    DECLARE language VARCHAR(2) DEFAULT 'pt';
    DECLARE cat_exists TINYINT DEFAULT 0;

    SELECT option_value INTO current_theme
        FROM wp_3_options
        WHERE option_name='current_theme';

    IF (current_theme = 'Quark-Boletim') THEN
        --
        -- -- Os metas não existem na primeira vinda da pagina
        --
        -- SELECT p.post_name INTO category_slug
        --     FROM wp_3_posts p
        --     INNER JOIN wp_3_postmeta pm on p.ID=pm.post_id
        --     WHERE p.post_type='page'
        --         AND pm.meta_key='is_boletim'
        --         AND pm.meta_value='boletim'
        --         AND p.ID=post_ID;

        SELECT p.post_name INTO category_slug
            FROM wp_3_posts p
            WHERE p.post_type='page'
                AND p.ID=post_ID
                AND LCASE(p.post_name) REGEXP '^(edicao|edicion|issue)-[0-9]+$';

        IF (length(category_slug) > 0) THEN
            SELECT count(1) > 0 INTO cat_exists
                FROM wp_3_terms t
                INNER JOIN wp_3_term_taxonomy tt
                    ON t.term_id=tt.term_id
                WHERE tt.taxonomy='category' AND t.slug=category_slug;

            IF (cat_exists=0) THEN
                -- Insere termo e guarda id em cat_term_id
                INSERT INTO wp_3_terms(name, slug)
                    VALUES(category_slug, category_slug);
                SELECT last_insert_id() INTO cat_term_id;

                -- Insere termo para tradução e guarda id em tra_term_id
                SELECT concat('pll_', substring( md5(category_slug), 20)) INTO tra_term_slug;
                INSERT INTO wp_3_terms(name, slug)
                    VALUES(tra_term_slug, tra_term_slug);
                SELECT last_insert_id() INTO tra_term_id;

                -- Verifica se eh ingles ou espanhol
                IF ( category_slug LIKE 'edicion%' ) THEN
                    SET language = 'es';
                ELSEIF ( category_slug LIKE 'issue%' ) THEN
                    SET language = 'en';
                END IF;

                -- Busca qual o termo do polylang vamos associar ao nosso
                SELECT t.term_id INTO tra_refs_id
                    FROM wp_3_terms t
                    INNER JOIN wp_3_term_taxonomy tt
                        ON t.term_id=tt.term_id
                    WHERE tt.taxonomy='term_language'
                        AND t.slug=CONCAT('pll_', language);

                -- cria no formato polylang
                SET tra_term_desc = CONCAT('a:1:{s:2:"',language,'";i:',cat_term_id,';}');

                -- insere termos como taxonomias
                INSERT INTO wp_3_term_taxonomy(term_id, taxonomy, description)
                    VALUES
                        (cat_term_id, 'category', ''),
                        (tra_term_id, 'term_translations', tra_term_desc);

                INSERT INTO wp_3_term_relationships (object_id, term_taxonomy_id)
                    VALUES
                        (cat_term_id, tra_term_id),
                        (cat_term_id, tra_refs_id);
            END IF;

        END IF;
    END IF;
END //

DROP TRIGGER IF EXISTS wp_3_T_create_boletim_category_update //
CREATE TRIGGER wp_3_T_create_boletim_category_update
    AFTER UPDATE ON wp_3_posts
    FOR EACH ROW
BEGIN
    CALL wp_3_P_create_boletim_category(NEW.ID);
END //

DROP TRIGGER IF EXISTS wp_3_T_create_boletim_category_insert //
CREATE TRIGGER wp_3_T_create_boletim_category_insert
    AFTER INSERT ON wp_3_posts
    FOR EACH ROW
BEGIN
    CALL wp_3_P_create_boletim_category(NEW.ID);
END //
DELIMITER ;
