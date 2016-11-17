# cipher
Encrypted in various languages

## Table of contents
- [Java](#java)
- [Ruby](#ruby)
- [PHP](#php)
- [Perl](#perl)

## Java
- Required Java 8 Higher

#### Usage

```
$ javac -encoding UTF8 CipherSample.java
$ java CipherSample
```

#### Result
```
CAX/zDb/Vdu/063a7fE+qQ==
hello
```

## Ruby
- Required Ruby 2.0.0

#### Usage

```
$ ruby CipherSample.rb
```

#### Result
```
"Original: hello"
"Encript : CAX/zDb/Vdu/063a7fE+qQ==\n"
"Decript : hello"
```

## PHP
- Required PHP 5.1.6

#### Usage

```
$ php CipherSample.php
```


#### Result
```
Original Data : hello
Encrypted Data : CAX/zDb/Vdu/063a7fE+qQ==
Decrypted Data : hello
```


## Perl
#### Require
- perl 5.8.8
- Crypt::ECB
- Crypt::Rijndael

#### Usage

```
$ perl CipherSample.pl
```


#### Result
```
Plain text  : hello
Cipher text : CAX/zDb/Vdu/063a7fE+qQ==
Decrypt text: hello
```