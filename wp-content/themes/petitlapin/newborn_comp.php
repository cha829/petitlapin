<?php
  /* Template Name: nb予約完了 */

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
  $postal_code = $_SESSION['zip11'];
  $address = $_SESSION['addr11'];
  $tel = $_SESSION['tel'];
  $child_birth = $_SESSION['child_birth'];
  $reserv_day = $_SESSION['reserv_day'];
  $twins_plan = $_SESSION['twins'];
  $family_plan = $_SESSION['family_plan'];
  $family = $_SESSION['family'];
  $line_coupon = $_SESSION['line_coupon'];
  $line_consul = $_SESSION['line_consul'];

  $row = 0;
  // wpnb_userテーブルにidが登録されているかの確認
  $items = $wpdb->get_results("SELECT id FROM wpnb_user");
  foreach($items as $item) {
    if($item->id == $id) {
      // idが登録されていたら、wpnewbornphotoテーブルのみ登録
      // データベースへ登録（テーブル名：wpnewbornphoto）
      $wpdb->insert(
              'wpnewbornphoto',
                array(
                  'id' => $id,
                  'name' => $user_name,
                  'child_birth' => $child_birth,
                  'reserv_day' => $reserv_day,
                  'twins_plan' => $twins_plan,
                  'family_plan' => $family_plan,
                  'family' => $family,
                  'line_coupon' => $line_coupon,
                  'line_consul' => $line_consul
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
      $row = $row + 1;
    }
  }
  if($row == 0) {
    // idが登録されていなかったら、wpnb_userとwpnewbornphotoテーブルへ登録
    // データベースへ登録（テーブル名：wpnb_user）
    $wpdb->insert(
            'wpnb_user',
              array(
                'id' => $id,
                'name' => $user_name,
                'name_kana' => $user_name_kana,
                'postal_code' => $postal_code,
                'address' => $address,
                'tel' => $tel
              ),
              array(
                '%s',
                '%s',
                '%s',
                '%s',
                '%s',
                '%s'
              )
            );
    // データベースへ登録（テーブル名：wpnewbornphoto）
    $wpdb->insert(
            'wpnewbornphoto',
              array(
                'id' => $id,
                'name' => $user_name,
                'child_birth' => $child_birth,
                'reserv_day' => $reserv_day,
                'twins_plan' => $twins_plan,
                'family_plan' => $family_plan,
                'family' => $family,
                'line_coupon' => $line_coupon,
                'line_consul' => $line_consul
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
    $title = '出張ニューボーンフォト予約受付致しました';
    // メール本文
    $content = 'ご予約ありがとうございます。<br>'.
                '下記内容にて受付致しました。<br>'.
                'お名前：'.$user_name.'<br>'.
                'フリガナ：'.$user_name_kana.'<br>'.
                '郵便番号：'.$postal_code.'<br>'.
                '住所：'.$address.'<br>'.
                '電話番号：'.$tel.'<br>'.
                'メールアドレス：'.$id.'<br>'.
                'お子様の誕生日（産前の方は出産予定日）：'.$child_birth.'<br>'.
                '撮影希望日：'.$reserv_day.'<br>'.
                '双子ちゃんプラン 有 or 無（有：+4000円）：'.$twins_plan.'<br>'.
                '家族プラン 有 or 無（有：+2000円）：'.$family_plan.'<br>'.
                '撮影希望ご家族：'.$family.'<br>'.
                'LINE＠クーポン利用状況（-800円）：'.$line_coupon.'<br>'.
                '事前にLINEでイメージの相談を希望：'.$line_consul.'<br>'.
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
