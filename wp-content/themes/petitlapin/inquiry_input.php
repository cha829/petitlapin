<?php
  /* Template Name: お問い合わせフォーム */

  // セッションスタート
  session_start();

  // 暗号学的的に安全なランダムなバイナリを生成し、それを16進数に変換することでASCII文字列に変換します
  $toke_byte = openssl_random_pseudo_bytes(16);
  $csrf_token = bin2hex($toke_byte);
  // 生成したトークンをセッションに保存します
  $_SESSION['csrf_token'] = $csrf_token;

  // ヘッダー呼び出し
  get_header();
  ?>

<main>
  <script src="https://ajaxzip3.github.io/ajaxzip3.js" charset="UTF-8"></script>
  <script src="js/ajaxzip3.js" charset="UTF-8"></script>
  <div class="container">
    <div class="row">
      <div class="col-6 offset-3">
        <header>
          <h2>お問い合わせ入力フォーム</h2>
        </header>
        <form action = "http://localhost/wordpress/inquiry-confirm/" method = "post">
          <input type="hidden" name="csrf_token" value="<?=$csrf_token?>">
          <div class="form-group">
            <label for = "user_name">お名前<span class="badge badge-danger">必須</span></label>
            <input type="text" name="user_name" required="required" value="<?php echo $_SESSION['user_name']; ?>">
          </div>
          <div class="form-group">
            <label for = "mail">メールアドレス<span class="badge badge-danger">必須</span></label>
            <input type="email" name="mail" required="required" value="<?php echo $_SESSION['mail']; ?>">
          </div>
          <div class="form-group">
            <label for = "inquiry">お問い合わせ内容<span class="badge badge-danger">必須</span></label>
            <textarea name="inquiry" rows="10"></textarea>
          </div>
          <div class="form-group">
            <button type="sumbit" name="confirm" class="btn btn-info w-50 mt-2">入力確認</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</main>

<?php
  // フッター呼び出し
  get_footer();
?>
