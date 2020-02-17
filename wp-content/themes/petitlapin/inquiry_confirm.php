<?php
  /* Template Name: お問い合わせ内容確認 */

  // セッションスタート
  session_start();

  // POSTでcsrf_tokenの項目名でパラメーターが送信されていること且つ、
  // セッションに保存された値と一致する場合は正常なリクエストとして処理を行います
  if (isset($_POST["csrf_token"]) && $_POST["csrf_token"] === $_SESSION['csrf_token']) {

    // リクエストが正常な場合セッション変数へ代入
    $_SESSION['user_name'] = $_POST['user_name'];
    $_SESSION['mail'] = $_POST['mail'];
    $_SESSION['inquiry'] = $_POST['inquiry'];

  // ヘッダー呼び出し
  get_header();
?>

<main>
  <div class="container">
    <div class="row">
      <div class="col-6 offset-3">
        <header>
          <h2>お問い合わせ内容確認</h2>
        </header>
        <form action = "http://localhost/wordpress/inquiry-comp/" method = "post">
          <div class="form-group">
            お名前：<?php echo $_SESSION['user_name'] ?>
          </div>
          <div class="form-group">
            メールアドレス：<?php echo $_SESSION['mail'] ?>
            <input type="hidden" name="mail">
          </div>
          <div class="form-group">
            お問い合わせ内容：<?php echo $_SESSION['inquiry'] ?>
            <input type="hidden" name="inquiry">
          </div>
          <div class="form-group">
            <button type="sumbit" name="comp" class="btn btn-success w-50 mt-2">送信</button>
          </div>
        </form>
        <div class="form-group">
          <form action = "http://localhost/wordpress/inquiry-input/" method = "post">
            <input type="hidden" name="user_name" value="<?php $_SESSION['user_name']; ?>">
            <input type="hidden" name="mail" value="<?php $_SESSION['mail']; ?>">
            <input type="hidden" name="inquiry" value="<?php $_SESSION['inquiry']; ?>">
            <button type="sumbit" name="input" class="btn btn-warning w-50 mt-2">戻る</button>
          </form>
        </div>
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
