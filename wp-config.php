<?php
/**
 * WordPress の基本設定
 *
 * このファイルは、インストール時に wp-config.php 作成ウィザードが利用します。
 * ウィザードを介さずにこのファイルを "wp-config.php" という名前でコピーして
 * 直接編集して値を入力してもかまいません。
 *
 * このファイルは、以下の設定を含みます。
 *
 * * MySQL 設定
 * * 秘密鍵
 * * データベーステーブル接頭辞
 * * ABSPATH
 *
 * @link http://wpdocs.osdn.jp/wp-config.php_%E3%81%AE%E7%B7%A8%E9%9B%86
 *
 * @package WordPress
 */

// 注意:
// Windows の "メモ帳" でこのファイルを編集しないでください !
// 問題なく使えるテキストエディタ
// (http://wpdocs.osdn.jp/%E7%94%A8%E8%AA%9E%E9%9B%86#.E3.83.86.E3.82.AD.E3.82.B9.E3.83.88.E3.82.A8.E3.83.87.E3.82.A3.E3.82.BF 参照)
// を使用し、必ず UTF-8 の BOM なし (UTF-8N) で保存してください。

// ** MySQL 設定 - この情報はホスティング先から入手してください。 ** //
/** WordPress のためのデータベース名 */
define( 'DB_NAME', 'petitlapin' );

/** MySQL データベースのユーザー名 */
define( 'DB_USER', 'root' );

/** MySQL データベースのパスワード */
define( 'DB_PASSWORD', 'best4861' );

/** MySQL のホスト名 */
define( 'DB_HOST', '127.0.0.1' );

/** データベースのテーブルを作成する際のデータベースの文字セット */
define( 'DB_CHARSET', 'utf8mb4' );

/** データベースの照合順序 (ほとんどの場合変更する必要はありません) */
define('DB_COLLATE', '');

/**#@+
 * 認証用ユニークキー
 *
 * それぞれを異なるユニーク (一意) な文字列に変更してください。
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org の秘密鍵サービス} で自動生成することもできます。
 * 後でいつでも変更して、既存のすべての cookie を無効にできます。これにより、すべてのユーザーを強制的に再ログインさせることになります。
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '.2KgHUIm#5q{<J.8(]!*~>&d<zzt]Tu8XM0*eGre)jymvK%cl!7T$xor*|>;`)@ ' );
define( 'SECURE_AUTH_KEY',  'ooj0{Ay{P~JIFi!wB0QIt KFtyvgKf~?N:eEObf3Aj$%yPN050PLY5jEoyUSTbze' );
define( 'LOGGED_IN_KEY',    'W=p)H[mHvlb4($py`m_z+ZWOd%M2Zl]*miqeS;loq(a-Utk[:p<3UR6/MuQr$_A!' );
define( 'NONCE_KEY',        'g?&cr!B_cy/4GclvnTE(ba*?9d,d_VJ-<KA@D/^x</Z?~@(Z8{RZ<`a>=TrLL:i1' );
define( 'AUTH_SALT',        'oCYoABn~G{2CwoYt#K_h2H%wo}0QV?3~QkcoxTW0P@k:=BP?3@*O!argc6r4&Q[u' );
define( 'SECURE_AUTH_SALT', '>^1L;lA!?^S$Ll0ccHHV~<;AxBxW+=|P Z-O_@bdY1JbW+Yv$gs,X,ROhYyS<t]H' );
define( 'LOGGED_IN_SALT',   'oLOAWemdgIvKzv<Q1|XIuaVo,K$xvWx&7-V`g<U>)am01uv#>S:9Jk_7h3^]|,gr' );
define( 'NONCE_SALT',       'Bv$B}LhH_rYrnSd.OxIT3MhjzCo[@wN~{|;V`TTXIEc oqCwL0MGT QbMigm{JK1' );

/**#@-*/

/**
 * WordPress データベーステーブルの接頭辞
 *
 * それぞれにユニーク (一意) な接頭辞を与えることで一つのデータベースに複数の WordPress を
 * インストールすることができます。半角英数字と下線のみを使用してください。
 */
$table_prefix = 'wp';

/**
 * 開発者へ: WordPress デバッグモード
 *
 * この値を true にすると、開発中に注意 (notice) を表示します。
 * テーマおよびプラグインの開発者には、その開発環境においてこの WP_DEBUG を使用することを強く推奨します。
 *
 * その他のデバッグに利用できる定数については Codex をご覧ください。
 *
 * @link http://wpdocs.osdn.jp/WordPress%E3%81%A7%E3%81%AE%E3%83%87%E3%83%90%E3%83%83%E3%82%B0
 */
define('WP_DEBUG', false);

/* 編集が必要なのはここまでです ! WordPress でのパブリッシングをお楽しみください。 */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
