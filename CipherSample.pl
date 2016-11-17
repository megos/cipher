use strict;

use Crypt::ECB;
use MIME::Base64;

my $cipher = Crypt::ECB->new({
	'key'            => 'abcdefghijklmnop', # 暗号化キー（128bit -> 16文字
	'cipher'         => 'Rijndael',         # 暗号化方式
	'padding'        => 'standard'          # パディング方式（standard -> PCSK#5)
});

# 平文
my $plaintext = "hello";

# 暗号化
my $ciphertext = $cipher->encrypt($plaintext);

# 復号
my $decrypttext = $cipher->decrypt($ciphertext);

print "Plain text  : ", $plaintext, "\n";
print "Cipher text : ", encode_base64($ciphertext);
print "Decrypt text: ", $decrypttext, "\n"
