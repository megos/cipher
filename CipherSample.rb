require 'openssl'
require 'base64'

# 暗号化
def encrypt(data, key, iv)
	enc = OpenSSL::Cipher.new("AES-128-ECB")
	enc.encrypt

	enc.key = key
	enc.iv = iv   # 初期化ベクトルは不要だが、エラー回避のためにセット

	# 暗号化
	encrypted_data = ""
	encrypted_data << enc.update(data)
	encrypted_data << enc.final

	return encrypted_data
end

# 復号化
def decrypt(data, key, iv)
	dec = OpenSSL::Cipher.new("AES-128-ECB")
	dec.decrypt

	dec.key = key
	dec.iv = iv   # 初期化ベクトルは不要だが、エラー回避のためにセット

	# 復号化
	decrypted_data = ""
	decrypted_data << dec.update(data)
	decrypted_data << dec.final

	return decrypted_data
end


data = "hello"
key = "abcdefghijklmnop"
iv  = "0000000000000000"

p "Original: " + data
encrypted_data = encrypt(data, key, iv)
p "Encript : " + Base64.encode64(encrypted_data)
p "Decript : " + decrypt(encrypted_data, key, iv)