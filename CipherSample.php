<?php
// Original http://pentan.info/php/sample/mcrypt.html
// 暗号化を行う
function cipher_encrypt($input, $key) {
  // 指定した暗号のブロックサイズを得る
  $size = mcrypt_get_block_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_ECB);
  // PKCS5Padding ブロック長に満たないサイズを埋める
  $input = pkcs5_pad($input, $size);
  // 使用するアルゴリズムおよびモードのモジュールをオープンする
  $td = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '',  MCRYPT_MODE_ECB, '');
  // オープンされたアルゴリズムの IV の大きさを返す
  $ivsize = mcrypt_enc_get_iv_size($td);
  // MCRYPT_RAND の初期化を行う
  srand();
  // 乱数ソースから初期化ベクトル(IV)を生成する
  // ECB以外では復号にこのIV(初期化ベクトル)が必要です。
  // ECBではIVは使用されませんが、IVがないとエラーが出ます。
  $iv = mcrypt_create_iv($ivsize, MCRYPT_RAND);
  // 暗号化に必要な全てのバッファを初期化する
  mcrypt_generic_init($td, $key, $iv);
  // データを暗号化する
  $data = mcrypt_generic($td, $input);
  // 暗号化モジュールを終了する
  mcrypt_generic_deinit($td);
  // mcrypt モジュールを閉じる
  mcrypt_module_close($td);
  return $data;
}

// 複合化を行う
function cipher_decrypt($input, $key) {
  // 指定した暗号のブロックサイズを得る
  $size = mcrypt_get_block_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_ECB);
  // 使用するアルゴリズムおよびモードのモジュールをオープンする
  $td = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '',  MCRYPT_MODE_ECB, '');
  // オープンされたアルゴリズムの IV の大きさを返す
  $ivsize = mcrypt_enc_get_iv_size($td);
  // MCRYPT_RAND の初期化を行う
  srand();
  // 乱数ソースから初期化ベクトル(IV)を生成する
  // ECB以外では暗号化に用いたIV(初期化ベクトル)が必要です。
  // ECBではIVは使用されませんが、IVがないとエラーが出ます。
  $iv = mcrypt_create_iv($ivsize, MCRYPT_RAND);
  // 暗号化に必要な全てのバッファを初期化する
  mcrypt_generic_init($td, $key, $iv);
  // データを復号する
  $data = mdecrypt_generic($td, $input);
  // 暗号化モジュールを終了する
  mcrypt_generic_deinit($td);
  // mcrypt モジュールを閉じる
  mcrypt_module_close($td);
  // PKCS5Padding 埋められたバイト値を除く
  $data = pkcs5_unpad($data, $size);
  return $data;
}

// PKCS5Padding
// ブロック長に満たないサイズを埋める
function pkcs5_pad($text, $blocksize) {
  $pad = $blocksize - (strlen($text) % $blocksize);
  return $text . str_repeat(chr($pad), $pad);
}

// PKCS5Padding
// 埋められたバイト値を除く
function pkcs5_unpad($text) {
  $pad = ord($text{strlen($text)-1});
  if ($pad > strlen($text)) return false;
  if (strspn($text, chr($pad), strlen($text) - $pad) != $pad) return false;
  return substr($text, 0, -1 * $pad);
}

/******************
暗号化例
******************/
// 暗号化するデータ
$data = "hello";
// 暗号キー
$key = "abcdefghijklmnop";

echo "Original Data  : " . $data;
echo "\n";
$encrypt = cipher_encrypt($data, $key);
echo "Encrypted Data : " . base64_encode($encrypt);
echo "\n";
$decrypt = cipher_decrypt($encrypt, $key);
echo "Decrypted Data : " . $decrypt;
echo "\n";
