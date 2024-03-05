<?php

$dbhost = 'localhost';
$username = 'user';
$password = 'poiuy';
$dbname = 'email';

$conn = new mysqli($dbhost, $username, $password, $dbname);

if ($conn->connect_error) {
    die('Connection lost: ' . $conn->connect_error);
}

$mail_host = '{imap.mail.ru:993/imap/ssl}INBOX';
$mail_user = '79208562003@mail.ru';
$mail_pass = 'eViPPC7QwhWQ9trTiQSJ';

$mailbox = imap_open($mail_host, $mail_user, $mail_pass);
