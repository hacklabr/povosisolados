DELIMITER //
CREATE PROCEDURE wp_3_P_create_boletim_category(IN post_ID BIGINT(20) UNSIGNED)
    BEGIN
        DECLARE current_theme VARCHAR(128) DEFAULT '';
        DECLARE category_slug VARCHAR(200) DEFAULT '';
        DECLARE cat_term_id BIGINT(20) UNSIGNED DEFAULT 0;
        DECLARE cat_exists TINYINT DEFAULT 0;

        SELECT option_value INTO current_theme
            FROM wp_3_options
            WHERE option_name='current_theme';

        IF (current_theme = 'Quark-Boletim') THEN
            SELECT p.post_name INTO category_slug
                FROM wp_3_posts p
                INNER JOIN wp_3_postmeta pm on p.ID=pm.post_id
                WHERE p.post_type='page'
                    AND pm.meta_key='is_boletim'
                    AND pm.meta_value='boletim'
                    AND p.ID=post_ID;

            IF (length(category_slug) > 0) THEN
                SELECT count(1) > 0 INTO cat_exists
                    FROM wp_3_terms t
                    INNER JOIN wp_3_term_taxonomy tt
                        ON t.term_id=tt.term_id
                    WHERE tt.taxonomy='category' AND t.slug=category_slug;

                IF (cat_exists=0) THEN
                    INSERT INTO wp_3_terms(name, slug)
                        VALUES(category_slug, category_slug);

                    SELECT last_insert_id() INTO cat_term_id;

                    INSERT INTO wp_3_term_taxonomy(term_id, taxonomy)
                        VALUES(cat_term_id, 'category');
                END IF;

            END IF;
        END IF;
    END //
DELIMITER ;


DELIMITER //
CREATE TRIGGER wp_3_T_create_boletim_category
    AFTER UPDATE ON wp_3_posts
    FOR EACH ROW
BEGIN
    CALL wp_3_P_create_boletim_category(OLD.ID);
END //
DELIMITER ;
