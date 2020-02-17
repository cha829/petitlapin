<?php
  /* Template Name: お問い合わせ完了 */

  // セッションスタート
  session_start();

  // ヘッダー呼び出し
  get_header();

  // グローバル宣言（データベース）
  global $wpdb;

  // セッション変数を変数へ代入
  $id = $_SESSION['mail'];
  $user_name = $_SESSION['user_name'];
  $inquiry = $_SESSION['inquiry'];

  // データベースへ登録（テーブル名：wpinquiry）
  $wpdb->insert(
          'wpinquiry',
            array(
              'id' => $id,
              'name' => $user_name,
              'inquiry' => $inquiry
            ),
            array(
              '%s',
              '%s',
              '%s'
            )
          );

  // メール自動送信
  mb_language("Japanese");
  mb_internal_encoding("UTF-8");
  // メールタイトル
  $title = 'お問い合わせ受付致しました';
  // メール本文
  $content = 'お問い合わせありがとうございます。<br>'.
              '下記内容にて受付致しました。<br>'.
              'お名前：'.$user_name.'<br>'.
              'メールアドレス：'.$id.'<br>'.
              'お問い合わせ内容：'.$inquiry.'<br>'.
              '<br>'.
              '<br>'.
              'petitlapin'.'<br>';
  // メール送信元
  $header = 'From: iida@b-answer.jp';
  mb_send_mail($id, $title, $content, $header); // $id=メール送信先
?>

<main>
  <div class="container">
    <div class="row">
      <div class="col-6 offset-3">
        <header>
          <h2>お問い合わせ完了</h2>
        </header>
        <div>
          お問い合わせありがとうございます。<br>
          お問い合わせ内容の詳細を　<?php echo $id; ?>　宛へ送信致しました。
      </div>
    </div>
  </div>
</main>

<?php
  // セッション変数削除
  $_SESSION = array();

  // フッター呼び出し
  get_footer();
?>
