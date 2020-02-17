<?php
  /* Template Name: nb予約内容確認 */

  // セッションスタート
  session_start();

  // POSTでcsrf_tokenの項目名でパラメーターが送信されていること且つ、
  // セッションに保存された値と一致する場合は正常なリクエストとして処理を行います
  if (isset($_POST["csrf_token"]) && $_POST["csrf_token"] === $_SESSION['csrf_token']) {

    // リクエストが正常な場合セッション変数へ代入
    $_SESSION['user_name'] = $_POST['user_name'];
    $_SESSION['user_name_kana'] = $_POST['user_name_kana'];
    $_SESSION['zip11'] = $_POST['zip11'];
    $_SESSION['addr11'] = $_POST['addr11'];
    $_SESSION['tel'] = $_POST['tel'];
    $_SESSION['mail'] = $_POST['mail'];
    $_SESSION['child_birth'] = $_POST['child_birth'];
    $_SESSION['reserv_day'] = $_POST['reserv_day'];
    $_SESSION['twins'] = $_POST['twins'];
    $_SESSION['family_plan'] = $_POST['family_plan'];
    $_SESSION['family'] = $_POST['family'];
    $_SESSION['line_coupon'] = $_POST['line_coupon'];
    $_SESSION['line_consul'] = $_POST['line_consul'];

  // ヘッダー呼び出し
  get_header();
?>

<main>
  <div class="container">
    <div class="row">
      <div class="col-6 offset-3">
        <header>
          <h2>予約内容確認</h2>
        </header>
        <form action = "http://localhost/wordpress/newbornphoto-comp/" method = "post">
          <div class="form-group">
            お名前：<?php echo $_SESSION['user_name'] ?>
          </div>
          <div class="form-group">
            フリガナ：<?php echo $_SESSION['user_name_kana'] ?>
          </div>
          <div class="form-group">
            郵便番号：<?php echo $_SESSION['zip11'] ?>
          </div>
          <div class="form-group">
            ご住所：<?php echo $_SESSION['addr11'] ?>
          </div>
          <div class="form-group">
            電話番号：<?php echo $_SESSION['tel'] ?>
          </div>
          <div class="form-group">
            メールアドレス：<?php echo $_SESSION['mail'] ?>
          </div>
          <div class="form-group">
            お子様のお誕生日(産前の方は出産予定日)：<?php echo $_SESSION['child_birth'] ?>
          </div>
          <div class="form-group">
            撮影希望日：<?php echo $_SESSION['reserv_day'] ?>
          </div>
          <div class="form-group">
            双子ちゃんプラン 有 or 無（有：+4000円）：<?php echo $_SESSION['twins'] ?>
          </div>
          <div class="form-group">
            家族プラン 有 or 無（有：+2000円）：<?php echo $_SESSION['family_plan'] ?>
          </div>
          <div class="form-group">
            撮影希望ご家族：<?php echo $_SESSION['family'] ?>
          </div>
          <div class="form-group">
            LINE＠クーポン利用状況（-800円）：<?php echo $_SESSION['line_coupon'] ?>
          </div>
          <div class="form-group">
            事前にLINEでイメージの相談を希望：<?php echo $_SESSION['line_consul'] ?>
          </div>
          <div class="form-group">
            <button type="sumbit" name="comp" class="btn btn-success w-50 mt-2">送信</button>
          </div>
        </form>
        <form action = "http://localhost/wordpress/newbornphoto-input/" method = "post">
          <input type="hidden" name="user_name" value="<?php $_SESSION['user_name']; ?>">
          <input type="hidden" name="user_name_kana" value="<?php $_SESSION['user_name_kana']; ?>">
          <input type="hidden" name="zip11" value="<?php $_SESSION['zip11']; ?>">
          <input type="hidden" name="addr11" value="<?php $_SESSION['addr11']; ?>">
          <input type="hidden" name="tel" value="<?php $_SESSION['tel']; ?>">
          <input type="hidden" name="mail" value="<?php $_SESSION['mail']; ?>">
          <input type="hidden" name="child_birth" value="<?php $_SESSION['child_birth']; ?>">
          <input type="hidden" name="reserv_day" value="<?php $_SESSION['reserv_day']; ?>">
          <input type="hidden" name="twins" value="<?php $_SESSION['twins']; ?>">
          <input type="hidden" name="family_plan" value="<?php $_SESSION['family_plan']; ?>">
          <input type="hidden" name="family" value="<?php $_SESSION['family']; ?>">
          <input type="hidden" name="line_coupon" value="<?php $_SESSION['line_coupon']; ?>">
          <input type="hidden" name="line_consul" value="<?php $_SESSION['line_consul']; ?>">
          <div class="form-group">
            <button type="sumbit" name="input" class="btn btn-warning w-50 mt-2">戻る</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</main>

<?php
    } else {
      echo "不正なリクエストです";
    }
?>
<?php
  // フッター呼び出し
  get_footer();
?>
