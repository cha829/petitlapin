<?php
  /* Template Name: nb予約フォーム */

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
          <h2>出張ニューボーンフォト予約フォーム</h2>
        </header>
        <form action = "http://localhost/wordpress/newbornphoto-confirm/" method = "post">
          <input type="hidden" name="csrf_token" value="<?=$csrf_token?>">
          <div class="form-group">
            <label for = "user_name">お名前<span class="badge badge-danger">必須</span></label>
            <input type="text" name="user_name" required="required" value="<?php echo $_SESSION['user_name']; ?>">
          </div>
          <div class="form-group">
            <label for = "user_name_kana">フリガナ<span class="badge badge-danger">必須</span></label>
            <input type="text" name="user_name_kana" required="required" value="<?php echo $_SESSION['user_name_kana']; ?>">
          </div>
          <div class="form-group">
            <label for = "postal_code">郵便番号<span class="badge badge-danger">必須</span></label>
            <input type="text" name="zip11" size="10" maxlength="8" onKeyUp="AjaxZip3.zip2addr(this,'','addr11','addr11');" required="required" value="<?php echo $_SESSION['zip11']; ?>">
          </div>
          <div class="form-group">
            <label for = "add">ご住所<span class="badge badge-danger">必須</span></label>
            <input type="text" name="addr11" size="60" required="required" value="<?php echo $_SESSION['addr11']; ?>">
          </div>
          <div class="form-group">
            <label for = "tel">電話番号<span class="badge badge-danger">必須</span></label>
            <input type="tel" name="tel" required="required" value="<?php echo $_SESSION['tel']; ?>">
          </div>
          <div class="form-group">
            <label for = "mail">メールアドレス<span class="badge badge-danger">必須</span></label>
            <input type="email" name="mail" required="required" value="<?php echo $_SESSION['mail']; ?>">
          </div>
          <div class="form-group">
            <label for = "child_birth">お子様のお誕生日(産前の方は出産予定日)<span class="badge badge-danger">必須</span></label><br>
            <input type="date" name="child_birth" required="required" class="form-control" value="<?php echo $_SESSION['child_birth']; ?>">
          </div>
          <div class="form-group">
            <label for = "reserv_day">撮影希望日<span class="badge badge-danger">必須</span></label><br>
            <input type="date" name="reserv_day" required="required" class="form-control" value="<?php echo $_SESSION['reserv_day']; ?>">
            ※お時間の決定は相談の上で行います<br>
          </div>
          <div class="form-group">
            <label for = "twins">双子ちゃんプラン 有 or 無（有：+4000円）<span class="badge badge-danger">必須</span></label>
            <select name="twins" required="required" value="<?php echo $_SESSION['twins']; ?>">
              <option value="">選択してください</option>
              <option value="有">有</option>
              <option value="無">無</option>
            </select>
          </div>
          <div class="form-group">
            <label for = "family_plan">家族プラン 有 or 無（有：+2000円）<span class="badge badge-danger">必須</span></label>
            <select name="family_plan" required="required" value="<?php echo $_SESSION['family_plan']; ?>">
              <option value="">選択してください</option>
              <option value="有">有</option>
              <option value="無">無</option>
            </select><br>
            ※家族プラン”有”の方は下記に撮影希望のご家族をご記入ください
            <textarea name="family" cols="20" rows="5" placeholder="例）パパ、ママ、兄(4歳)"></textarea>
          </div>
          <div class="form-group">
            <label for = "line_coupon">LINE＠クーポン利用状況（-800円）<span class="badge badge-danger">必須</span></label>
            <select name="line_coupon" required="required" value="<?php echo $_SESSION['line_coupon']; ?>">
              <option value="">選択してください</option>
              <option value="有">有</option>
              <option value="無">無</option>
            </select>
          </div>
          <div class="form-group">
            <label for = "line_consul">事前にLINEでイメージの相談を希望<span class="badge badge-danger">必須</span></label>
            <select name="line_consul" required="required" value="<?php echo $_SESSION['line_consul']; ?>">
              <option value="">選択してください</option>
              <option value="する">する</option>
              <option value="しない">しない</option>
            </select>
            ※”する”を選択された方は、確定メールでLINE＠トークにお名前をつぶやいて下さい
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
