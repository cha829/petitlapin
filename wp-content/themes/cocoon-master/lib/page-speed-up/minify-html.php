<?php //HTML縮小化用
/**
 * Cocoon WordPress Theme
 * @author: yhira
 * @link: https://wp-cocoon.com/
 * @license: http://www.gnu.org/licenses/gpl-2.0.html GPL v2 or later
 */
if ( !defined( 'ABSPATH' ) ) exit;

//HTMLソースコードの縮小化
if ( !function_exists( 'code_minify_call_back' ) ):
function code_minify_call_back($buffer) {
  global $post;
  //_v($post);
  if (is_admin() || is_feed() || !$post) {
    return $buffer;
  }
  //何故かa開始タグがpタグでラップされるのを修正
  $buffer = preg_replace('{<p>(<a[^>]+?>)</p>}i', "$1", $buffer);
  //何故かa終了タグがpタグでラップされるのを修正
  $buffer = preg_replace('{<p>(</a>)</p>}i', "$1", $buffer);

  //HTMLの縮小化
  //global $_IS_HTTP_MINIFY;
  //_v($_SERVER);
  // if (is_html_minify_enable() && !$_IS_HTTP_MINIFY) {
  if (is_html_minify_enable()) {
    $buffer = minify_html($buffer);
    //$_IS_HTTP_MINIFY = true;
    //_v('minify_html');
  }

  ///////////////////////////////////////////
  // Lazy Load
  ///////////////////////////////////////////
  if (is_lazy_load_enable() && !is_login_page()) {
    //画像の変換
    $buffer = convert_lazy_load_tag($buffer, 'img');
    //iframeの変換
    $buffer = convert_lazy_load_tag($buffer, 'iframe');
  }

  //「Warning: Attribute aria-required is unnecessary for elements that have attribute required.」対策
  $buffer = str_replace('aria-required="true" required>', 'aria-required="true">', $buffer);
  $buffer = str_replace('aria-required="true" required="required">', 'aria-required="true">', $buffer);

  ///////////////////////////////////////
  // HTML5エラー除外
  ///////////////////////////////////////
  //Alt属性がないIMGタグにalt=""を追加する
  $buffer = preg_replace('/<img((?![^>]*alt=)[^>]*)>/i', '<img alt=""${1}>', $buffer);
  //画像タグの border="0"を削除する
  $buffer = str_replace(' border="0"', '', $buffer);

  //wpForoのHTML5エラー
  if (is_wpforo_exist()) {
    $buffer = str_replace(' id="wpf-widget-recent-replies"', '', $buffer);
  }
  //BuddyPressのHTML5エラー
  if (is_buddypress_exist()) {
    $buffer = str_replace('<label for="bp-login-widget-rememberme">', '<label>', $buffer);
  }

  //JavaScriptの縮小化
  if (is_amp() && is_js_minify_enable()) {
    $pattern = '{<script[^>]*?>(.*?)</script>}is';
    $subject = $buffer;
    $res = preg_match_all($pattern, $subject, $m);
    //_v($m);
    if ($res && isset($m[1])) {
      foreach ($m[1] as $match) {
        if (empty($match)) {
          continue;
        }
        //_v($match);
        $buffer = str_replace($match, minify_js($match), $buffer);
      }
    }
  }

  //タブボックスのタブ変換
  $buffer = preg_replace('#<div class="(.*?)blank-box bb-tab bb-(.+?)".*?>#', '$0<div class="bb-label"><span class="fa"></span></div>', $buffer);

  // //モバイルボタンのロゴメニュー対応
  // $res = preg_match('{<ul class="mobile-header-menu-buttons mobile-menu-buttons".+?</ul>}s', $buffer, $m);
  // if ($res) {
  //   _v($m);
  // }

  //Font Awesome5変換
  $buffer = change_fa($buffer);

  //_v($buffer);
  return apply_filters('code_minify_call_back', $buffer);
}
endif;

//縮小化して良いページかどうか
if ( !function_exists( 'is_minify_page' ) ):
function is_minify_page(){
  if (is_admin()) return false;
  if (includes_wp_admin_in_request_uri()) return false;
  if (includes_wp_cron_php_in_request_uri()) return false;
  if (includes_service_worker_js_in_http_referer()) return false;
  if (is_server_request_post()) return false;
  if (is_server_request_uri_backup_download_php()) return false;
  if (is_robots_txt_page()) return false;
  if (is_analytics_access_php_page()) return false;
  if (is_feed()) return false;
  // _v($_SERVER);
  //_v(time());
  return true;
}
endif;

//最終HTML取得開始
add_action('get_header', 'code_minify_buffer_start', 99999999);
add_action('get_template_part_tmp/amp-header', 'code_minify_buffer_start', 99999999);//AMP
if ( !function_exists( 'code_minify_buffer_start' ) ):
function code_minify_buffer_start() {
  // if (!is_minify_page()) return;

  ob_start('code_minify_call_back');
}
endif;

//最終HTML取得終了
add_action('shutdown', 'code_minify_buffer_end');
if ( !function_exists( 'code_minify_buffer_end' ) ):
function code_minify_buffer_end() {
  // if (!is_minify_page()) return;

  if (ob_get_length()){
    ob_end_flush();
  }
}
endif;


///////////////////////////////////////
// 出力フィルタリングフック
///////////////////////////////////////

// wp_head 出力フィルタリング・ハンドラ追加
add_action( 'wp_head', 'wp_head_buffer_start', 1 );
add_action( 'wp_head', 'wp_head_buffer_end', 99999999 );
// wp_footer 出力フィルタリング・ハンドラ追加
add_action( 'wp_footer', 'wp_footer_buffer_start', 1 );
add_action( 'wp_footer', 'wp_footer_buffer_end', 99999999 );


///////////////////////////////////////
// バッファリング開始
///////////////////////////////////////
if ( !function_exists( 'wp_head_buffer_start' ) ):
function wp_head_buffer_start() {
  ob_start( 'wp_head_minify' );
}
endif;
if ( !function_exists( 'wp_footer_buffer_start' ) ):
function wp_footer_buffer_start() {
  ob_start( 'wp_footer_minify' );
}
endif;

///////////////////////////////////////
// バッファリング終了
///////////////////////////////////////
if ( !function_exists( 'wp_head_buffer_end' ) ):
function wp_head_buffer_end() {
  if (ob_get_length()) ob_end_flush();
}
endif;
if ( !function_exists( 'wp_footer_buffer_end' ) ):
function wp_footer_buffer_end() {
  if (ob_get_length())  ob_end_flush();
}
endif;


///////////////////////////////////////
// フィルター
///////////////////////////////////////
if ( !function_exists( 'wp_head_minify' ) ):
function wp_head_minify($buffer) {

  //ヘッダーコードのCSS縮小化
  if (is_css_minify_enable()) {
    $buffer = tag_code_to_minify_css($buffer);
  }

  //ヘッダーコードのJS縮小化
  if (is_js_minify_enable()) {
    $buffer = tag_code_to_minify_js($buffer);
  }
  //WordPressが出力する type='text/javascript'を削除
  $buffer = str_replace(" type='text/javascript'", '', $buffer);
  $buffer = str_replace(' type="text/javascript"', '', $buffer);
  //WordPressが出力する type='text/css'を削除
  $buffer = str_replace(" type='text/css'", '', $buffer);
  $buffer = str_replace(' type="text/css"', '', $buffer);

  //_v($buffer);
  return apply_filters('wp_head_minify', $buffer);
}
endif;

if ( !function_exists( 'wp_footer_minify' ) ):
function wp_footer_minify($buffer) {
  //_v($buffer);
  //フッターコードのCSS縮小化
  if (is_css_minify_enable()) {
    $buffer = tag_code_to_minify_css($buffer);
  }

  //フッターコードのJS縮小化
  if (is_js_minify_enable()) {
    $buffer = tag_code_to_minify_js($buffer);
  }

  //WordPressが出力する type='text/javascript'を削除
  $buffer = str_replace(" type='text/javascript'", '', $buffer);
  $buffer = str_replace(' type="text/javascript"', '', $buffer);

  //_v($buffer);
  return apply_filters('wp_footer_minify', $buffer);
}
endif;

//リストにマッチするか
if ( !function_exists( 'has_match_list_text' ) ):
function has_match_list_text($text, $list){
  $excludes = list_text_to_array($list);
  foreach ($excludes as $exclude_str) {
    if (strpos($text, $exclude_str) !== false) {
      return true;
    }
  }
}
endif;

//imgタグをLazy Load用の画像タグに変換
if ( !function_exists( 'convert_lazy_load_tag' ) ):
function convert_lazy_load_tag($the_content, $media){
  //AMP・アクセス解析ページでは実行しない
  if (is_amp() || is_analytics_access_php_page() || is_feed()) {
    return $the_content;
  }

  $is_img = ($media == 'img');
  $is_iframe = !$is_img;
  if ($is_iframe) {
    //YouTube高速化がある場合はiframeは処理しない
    if (includes_string($the_content, ' data-iframe=')) {
      return $the_content;
    }
  }

  $pattern = '{<'.$media.'.+?>}is';

  if ($is_iframe) {
    $pattern = '{<iframe.+?>.*?</iframe>}is';
  }

  //imgタグをamp-imgタグに変更する
  $res = preg_match_all($pattern, $the_content, $m);
  // _v($res);
  //_v($m);
  // if ($media == 'iframe') {
  //   //_v($pattern);
  //   _v($m);
  // }
  //_v($m);
  if ($res) {//画像タグがある場合
    //_v($m);
    //置換するタグ格納用
    $img_tags = array();
    foreach ($m[0] as $match) {
      //文字列が1024バイト以上の場合はスキップ
      if (strlen($match) > 1024) {
        continue;
      }

      //URLが含まれていない場合はスキップ
      if (!preg_match(URL_REG, $match)) {
        continue;
      }

      //重複置換を避ける
      if (in_array($match, $img_tags, true)) {
        continue;
      }

      //タグマネージャ用のものは避ける
      if (includes_string($match, '<iframe src="https://www.googletagmanager.com/ns.html?id=')) {
        continue;
      }

      //置換するタグを格納してく
      $img_tags[] = $match;
      ///////////////////////////////////////////
      // 除外設定
      ///////////////////////////////////////////
      if (
        //サイトロゴ
        includes_string($match, 'header-site-logo-image')
        // //アイキャッチ
        // || includes_string($match, ' eye-catch-image ')
        //Jetpackの統計グラフ
        || (is_user_logged_in() && includes_string($match, 'admin-bar-hours-scale'))
      ) {
        continue;
      }
      //除外リストにマッチする文字列はLazy Loadしない
      $exclude_list = get_lazy_load_exclude_list();
      if ($exclude_list && has_match_list_text($match, $exclude_list)) {
        continue;
      }

      //変数の初期化
      $src_attr = null;
      $url = null;
      //var_dump(htmlspecialchars($match));
      $tag = $match;

      //Lazy Load：画像URLの入れ替え
      $search = '{ src=["\'](.+?)["\']}i';
      //$replace = ' src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="$1"';
      $replace = ' data-src="$1"';
      $tag = preg_replace($search, $replace, $tag);
      //$tag = convert_src_to_data_src($tag);

      //クラスの変更
      //挿入するクラス
      $classes = 'lozad lozad-'.$media;
      $chrome_lazy = 'loading="lazy"';
      if (preg_match('/class=/i', $tag)) {
        $search = '{class=["\'](.+?)["\']}i';
        $replace = 'class="$1 '.$classes.'" '.$chrome_lazy;
        $tag = preg_replace($search, $replace, $tag);
      } else {
        $search = '<'.$media;
        $replace = '<'.$media.' class="'.$classes.'" '.$chrome_lazy;
        $tag = str_replace($search, $replace, $tag);
      }

      //srcsetの変換宇
      $tag = str_replace(' srcset=', ' data-srcset=', $tag);

      //noscriptタグの追加
      $tag = $tag.'<noscript>'.$match.'</noscript>';

      //imgタグをLazy Load対応に置換
      $the_content = preg_replace('{'.preg_quote($match).'(?!<noscript>)}', $tag , $the_content);
    }
  }
  return apply_filters('convert_lazy_load_tag', $the_content, $media);
}
endif;
