<h3>Posts</h3>
<table class="form-table">
    <tr>
        <th>Posts</th>
        <td>
            <?php $controls->checkbox('theme_posts', 'Add latest posts'); ?>
            <br>
            <?php $controls->checkbox('theme_thumbnails', 'Add post thumbnails'); ?>
            <br>
            <?php $controls->checkbox('theme_excerpts', 'Add post excerpts'); ?>
        </td>
    </tr>
    <tr>
        <th>Post types to include</th>
        <td>
            <?php $controls->post_types('theme_post_types'); ?>
            <div class="hints">Leave all unchecked for default behaviour.</div>
        </td>
    </tr>
    <tr>
        <th>Categories</th>
        <td>
            <?php $controls->categories_group('theme_categories'); ?>
        </td>
    </tr>
    <tr>
        <th>Max posts</th>
        <td>
            <?php $controls->text('theme_max_posts', 4); ?>
        </td>
    </tr>
</table>
<!--</div>-->
<!--<div id="tab-posts">-->
<!--</div>-->
<!--</div>-->