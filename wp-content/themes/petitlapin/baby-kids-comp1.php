<?php
  /* Template Name: bk予約完了 */

  // セッションスタート
  session_start();

  // ヘッダー呼び出し
  get_header();

  // グローバル宣言（データベース）
  global $wpdb;

  // セッション変数を変数へ代入
  $id = $_SESSION['mail'];
  $user_name = $_SESSION['user_name'];
  $user_name_kana = $_SESSION['user_name_kana'];
  $tel = $_SESSION['tel'];
  $holding_day = $_SESSION['holding_day'];
  $holding_place = $_SESSION['holding_place'];
  $holding_time = $_SESSION['holding_time'];
  $child_name = $_SESSION['child_name'];
  $child_name_kana = $_SESSION['child_name_kana'];
  $child_birth = $_SESSION['child_birth'];

  // セッション変数削除
  $_SESSION = array();

  // wpuserテーブルにidが登録されているかの確認
  $results = $wpdb->get_results("SELECT * FROM wpbk_user");
  foreach($results as $result) {
    $result_id = $result->id;
    if($result_id !== $id) {
      // idが登録されていなかったら、wpbk_userとwpbabykidsテーブルへ登録
      // データベースへ登録（テーブル名：wpbk_user）
      $wpdb->insert(
              'wpbk_user',
                array(
                  'id' => $id,
                  'name' => $user_name,
                  'name_kana' => $user_name_kana,
                  'tel' => $tel
                ),
                array(
                  '%s',
                  '%s',
                  '%s',
                  '%s'
                )
              );
      // データベースへ登録（テーブル名：wpbabykids）
      $wpdb->insert(
              'wpbabykids',
                array(
                  'id' => $id,
                  'name' => $user_name,
                  'holding_day' => $holding_day,
                  'holding_place' => $holding_place,
                  'holding_time' => $holding_time,
                  'child_name' => $child_name,
                  'child_name_kana' => $child_name_kana,
                  'child_birth' => $child_birth

                ),
                array(
                  '%s',
                  '%s',
                  '%s',
                  '%s',
                  '%s',
                  '%s',
                  '%s',
                  '%s'
                )
              );
    } else {
      // idが登録されていたら、wpbabykidsテーブルのみ登録
      // データベースへ登録（テーブル名：wpbabykids）
      $wpdb->insert(
              'wpbabykids',
                array(
                  'id' => $id,
                  'name' => $user_name,
                  'holding_day' => $holding_day,
                  'holding_place' => $holding_place,
                  'holding_time' => $holding_time,
                  'child_name' => $child_name,
                  'child_name_kana' => $child_name_kana,
                  'child_birth' => $child_birth

                ),
                array(
                  '%s',
                  '%s',
                  '%s',
                  '%s',
                  '%s',
                  '%s',
                  '%s',
                  '%s'
                )
              );
    }
  }
?>

<main>
  <div class="container">
    <div class="row">
      <div class="col-6 offset-3">
        <header>
          <h2>予約完了</h2>
        </header>
        <div>
          ご予約ありがとうございました。<br>
          ご予約内容の詳細を　<?php echo $id; ?>　宛へ送信致しました。
      </div>
    </div>
  </div>
</main>

<?php
  // フッター呼び出し
  get_footer();
?>
