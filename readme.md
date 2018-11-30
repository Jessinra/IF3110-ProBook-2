# Pro-Books: Online Bookstore

A website for book e-commerce written in plain PHP and Javascript for application, using SOAP as book web service written in Java and RESTFUL as bank web service written in Node.JS.

## Basis Data

### Pro-book

Pada basis data pro-book, terdapat tabel:

####1. Auth
    
    Untuk menyimpan access token
    
####2. User

    Untuk menyimpan data pengguna
    
####3. Book_order

    Untuk menyimpan data pembelian buku
    
####4. Book_review

    Untuk menyimpan review dari buku yang telah dibeli

### Web Service Bank

Pada basis data web service bank, terdapat tabel:

####1. Nasabah
    
    Untuk menyimpan akun nasabah pengguna beserta nomor kartu dan saldo
    
####2. Transaksi

    Untuk menyimpan data transaksi transfer antara satu akun nasabah dengan akun nasabah lain
    
####3. OTP

    Untuk menyimpan kode otp untuk transaksi



7. [DELIVERABLE] Berikan penjelasan mengenai hal di bawah ini pada bagian **Penjelasan** dari *readme* repository git Anda:
    - Basis data dari sistem yang Anda buat, yaitu basis data aplkasi pro-book, webservice bank, dan webservice buku.
    - Konsep *shared session* dengan menggunakan REST.
    - Mekanisme pembangkitan token dan expiry time pada aplikasi Anda.
    - Kelebihan dan kelemahan dari arsitektur aplikasi tugas ini, dibandingkan dengan aplikasi monolitik (login, CRUD DB, dll jadi dalam satu aplikasi)

## Pembagian Tugas

**Contributors**
1. Ayrton Cyril / 13516019
2. Jessin Donnyson / 13516117
3. Nicholas Wijaya / 13516121

REST :
1. Validasi nomor kartu : 13516019
2. Transfer             : 13516121
3. Transfer with HTOP   : 13516117

SOAP :
1. Search Book          : 13516117
2. Book recommendation  : 13516121
3. Buy book             : 13516019

Perubahan Web app :
1. Halaman Search       : 13516121
2. Halaman Register     : 13516019
3. Halaman Detail       : 13516121
4. Halaman Edit Profile : 13516019
5. Halaman Profile      : 13516019
6. Halaman History      : 13516019
7. Halaman Review       : 13516019
8. Book Recommendation  : 13516121
9. Modal HTOP           : 13516117

Bonus :
1. Pembangkitan token HTOP/TOTP : 13516117
2. Validasi token               : 13516117