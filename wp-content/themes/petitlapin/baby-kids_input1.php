<?php
  /* Template Name: bk撮影会入力フォーム1 */

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
    <div class="container">
      <div class="row">
        <div class="col-6 offset-3">
          <header>
            <h2>ベビー＆キッズ撮影会予約フォーム</h2>
          </header>
          <form action = "http://localhost/wordpress/baby-kids-1-confirm/" method = "post">
            <input type="hidden" name="csrf_token" value="<?=$csrf_token?>">
            <div class="form-group">
              <label for="holding_day">開催日</label>
              <input type="text" name="holding_day" required="required" value="2020年1月30日（木）" readonly>
            </div>
            <div class="form-group">
              <label for="holding_place" >開催場所</label>
              <input type="text" name="holding_place" required="required" value="ピーくんガーデン（足立区谷中2-22-8）" readonly>
            </div>
            <div class="form-group">
              <label for="holding_time">ご希望時間帯<span class="badge badge-danger">必須</span></label>
              <select name="holding_time" required="required" value="<?php echo $_SESSION['time']; ?>">
                <option value="">選択してください</option>
                <option value="10：00～">10：00～</option>
                <option value="11：00～">11：00～</option>
                <option value="12：00～">12：00～</option>
                <option value="13：00～">13：00～</option>
                <option value="14：00～">14：00～</option>
              </select>
            </div>
            <div class="form-group">
              <label for = "user_name">ご予約者お名前<span class="badge badge-danger">必須</span></label>
              <input type="text" name="user_name" required="required" value="<?php echo $_SESSION['user_name']; ?>">
            </div>
            <div class="form-group">
              <label for = "user_name_kana">ご予約者フリガナ<span class="badge badge-danger">必須</span></label>
              <input type="text" name="user_name_kana" required="required" value="<?php echo $_SESSION['user_name_kana']; ?>">
            </div>
            <div class="form-group">
              <label for = "tel">ご予約者電話番号<span class="badge badge-danger">必須</span></label>
              <input type="tel" name="tel" required="required" value="<?php echo $_SESSION['tel']; ?>">
            </div>
            <div class="form-group">
              <label for = "mail">ご予約者メールアドレス<span class="badge badge-danger">必須</span></label>
              <input type="email" name="mail" required="required" value="<?php echo $_SESSION['mail']; ?>">
            </div>
            <div class="form-group">
              <label for = "child_name">お子様のお名前<span class="badge badge-danger">必須</span></label>
              <input type="text" name="child_name" required="required" value="<?php echo $_SESSION['child_name']; ?>">
            </div>
            <div class="form-group">
              <label for = "child_name_kana">お子様のフリガナ<span class="badge badge-danger">必須</span></label>
              <input type="text" name="child_name_kana" required="required" value="<?php echo $_SESSION['child_name_kana']; ?>">
            </div>
            <div class="form-group">
              <label for="sex">お子様の性別<span class="badge badge-danger">必須</span></label>
              <select name="child_sex" required="required" value="<?php echo $_SESSION['child_sex']; ?>">
                <option value="">選択してください</option>
                <option value="男">男</option>
                <option value="女">女</option>
              </select>
            </div>
            <div class="form-group">
              <label for = "child_birth">お子様の誕生日<span class="badge badge-danger">必須</span></label>
              <input type="date" name="child_birth" required="required" class="form-control" value="<?php echo $_SESSION['child_birth']; ?>">
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
