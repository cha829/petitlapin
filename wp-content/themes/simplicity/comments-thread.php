<div id="comments-thread">
  <?php
if(have_comments()):
?>
  <h3 id="comments">『<?php the_title(); ?>』へのコメント</h3>
  <ol class="commets-list">
    <?php wp_list_comments('callback=mytheme_comment'); ?>
  </ol>
  <?php
endif;

if (is_comment_form_freeze()) {//コメントを凍結
    echo get_theme_text_comment_freeze_label();
} else {//コメント欄を表示
  $args=array('title_reply' => get_theme_text_comment_reply_title(),
      'label_submit' => get_theme_text_comment_submit_label(),
  );
  comment_form($args);
}


?>
</div>
<!-- END div#comments-thread -->