import java.util.Base64;

import javax.crypto.Cipher;
import javax.crypto.spec.SecretKeySpec;

public class CipherSample {

  private static final String KEY_SPEC = "AES";

  private static final String CIPHER_MODE = "AES/ECB/PKCS5Padding";

  public static void main(String[] args) {
    String key = "abcdefghijklmnop"; // <-128bit = 16文字のキー
    byte[] keyBytes = key.getBytes(); // バイト列に変換

    CipherSample cs = new CipherSample();

    byte[] enBytes = cs.encryptECB("hello".getBytes(), keyBytes);

     // Base64して表示
    System.out.println(Base64.getEncoder().encodeToString(enBytes));

    byte[] deBytes = cs.decryptECB(enBytes, keyBytes);

    System.out.println(new String(deBytes));

  }


  public byte[] encryptECB(byte[] data, byte[] secret_key) {

    SecretKeySpec sKey = new SecretKeySpec(secret_key, KEY_SPEC);
    try {
      Cipher cipher = Cipher.getInstance(CIPHER_MODE);
      cipher.init(Cipher.ENCRYPT_MODE, sKey);
      return cipher.doFinal(data);

    } catch (Exception e) {
      e.printStackTrace();
    }
    return new byte[0];
  }

  public byte[] decryptECB(byte[] encData, byte[] secret_key) {

    SecretKeySpec sKey = new SecretKeySpec(secret_key, KEY_SPEC);
    try {
      Cipher cipher = Cipher.getInstance(CIPHER_MODE);
      cipher.init(Cipher.DECRYPT_MODE, sKey);
      return cipher.doFinal(encData);
    } catch (Exception e) {
      e.printStackTrace();
    }
    return new byte[0];
  }
}