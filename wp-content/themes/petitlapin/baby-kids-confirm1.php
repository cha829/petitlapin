<?php
  /* Template Name: bk予約内容確認1 */

  // セッションスタート
  session_start();

  // POSTでcsrf_tokenの項目名でパラメーターが送信されていること且つ、
  // セッションに保存された値と一致する場合は正常なリクエストとして処理を行います
  if (isset($_POST["csrf_token"]) && $_POST["csrf_token"] === $_SESSION['csrf_token']) {

    // リクエストが正常な場合セッション変数へ代入
    $_SESSION['holding_day'] = $_POST['holding_day'];
    $_SESSION['holding_place'] = $_POST['holding_place'];
    $_SESSION['holding_time'] = $_POST['holding_time'];
    $_SESSION['user_name'] = $_POST['user_name'];
    $_SESSION['user_name_kana'] = $_POST['user_name_kana'];
    $_SESSION['tel'] = $_POST['tel'];
    $_SESSION['mail'] = $_POST['mail'];
    $_SESSION['child_name'] = $_POST['child_name'];
    $_SESSION['child_name_kana'] = $_POST['child_name_kana'];
    $_SESSION['child_sex'] = $_POST['child_sex'];
    $_SESSION['child_birth'] = $_POST['child_birth'];

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
        <form action = "http://localhost/wordpress/baby-kids-comp/" method = "post">
          <div class="form-group">
            開催日：<?php echo $_SESSION['holding_day'] ?>
          </div>
          <div class="form-group">
            開催場所：<?php echo $_SESSION['holding_place'] ?>
          </div>
          <div class="form-group">
            ご希望時間帯：<?php echo $_SESSION['holding_time'] ?>
          </div>
          <div class="form-group">
            ご予約者お名前：<?php echo $_SESSION['user_name'] ?>
          </div>
          <div class="form-group">
            ご予約者フリガナ：<?php echo $_SESSION['user_name_kana'] ?>
          </div>
          <div class="form-group">
            ご予約者電話番号：<?php echo $_SESSION['tel'] ?>
          </div>
          <div class="form-group">
            ご予約者メールアドレス：<?php echo $_SESSION['mail'] ?>
          </div>
          <div class="form-group">
            お子様のお名前：<?php echo $_SESSION['child_name'] ?>
          </div>
          <div class="form-group">
            お子様のフリガナ：<?php echo $_SESSION['child_name_kana'] ?>
          </div>
          <div class="form-group">
            お子様の性別：<?php echo $_SESSION['child_sex'] ?>
          </div>
          <div class="form-group">
            お子様の誕生日：<?php echo $_SESSION['child_birth'] ?>
          </div>
          <div class="form-group">
            <button type="sumbit" name="comp" class="btn btn-success w-50 mt-2">送信</button>
          </div>
        </form>
        <form action = "http://localhost/wordpress/baby-kids-1-input/" method = "post">
          <input type="hidden" name="holding_day" value="<?php $_SESSION['holding_day']; ?>">
          <input type="hidden" name="holding_place" value="<?php $_SESSION['holding_place']; ?>">
          <input type="hidden" name="holding_time" value="<?php $_SESSION['holding_time']; ?>">
          <input type="hidden" name="user_name" value="<?php $_SESSION['user_name']; ?>">
          <input type="hidden" name="user_name_kana" value="<?php $_SESSION['user_name_kana']; ?>">
          <input type="hidden" name="tel" value="<?php $_SESSION['tel']; ?>">
          <input type="hidden" name="mail" value="<?php $_SESSION['mail']; ?>">
          <input type="hidden" name="child_name" value="<?php $_SESSION['child_name']; ?>">
          <input type="hidden" name="child_name_kana" value="<?php $_SESSION['child_name_kana']; ?>">
          <input type="hidden" name="child_sex" value="<?php $_SESSION['child_sex']; ?>">
          <input type="hidden" name="child_birth" value="<?php $_SESSION['child_birth']; ?>">
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
