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
  $child_sex = $_SESSION['child_sex'];
  $child_birth = $_SESSION['child_birth'];

  $row = 0;
  // wpbk_userテーブルにidが登録されているかの確認
  $items = $wpdb->get_results("SELECT id FROM wpbk_user");
    foreach($items as $item) {
      if($item->id == $id) {
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
                    'child_sex' => $child_sex,
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
                    '%s',
                    '%s'
                  )
                );
        $row = $row +1;
      }
    }
    if($row == 0) {
      // idが登録されていなかったら、wpbk_userとwpbabykidsへ登録
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
                    'child_sex' => $child_sex,
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
                    '%s',
                    '%s'
                  )
              );
    }

  // メール自動送信
  mb_language("Japanese");
  mb_internal_encoding("UTF-8");
    // メールタイトル
    $title = 'ベビー＆キッズ撮影会予約受付致しました';
    // メール本文
    $content = 'ご予約ありがとうございます。<br>'.
                '下記内容にて受付致しました。<br>'.
                '開催日：'.$holding_day.'<br>'.
                '開催場所：'.$holding_place.'<br>'.
                'ご希望時間帯：'.$holding_time.'<br>'.
                'ご予約者お名前：'.$user_name.'<br>'.
                'ご予約者フリガナ：'.$user_name_kana.'<br>'.
                'ご予約者電話番号：'.$tel.'<br>'.
                'ご予約者メールアドレス：'.$id.'<br>'.
                'お子様のお名前：'.$child_name.'<br>'.
                'お子様のフリガナ：'.$child_name_kana.'<br>'.
                'お子様の性別：'.$child_sex.'<br>'.
                'お子様の誕生日：'.$child_birth.'<br>'.
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
  // セッション変数削除
  $_SESSION = array();

  // フッター呼び出し
  get_footer();
?>
