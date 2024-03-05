<?php

require_once 'config.php';

$mail_list = imap_search($mailbox, 'ALL');

$num_emails = imap_num_msg($mailbox);
echo $num_emails . "<hr>";

if ($mail_list) {
    foreach ($mail_list as $mail) {
        $overview = imap_fetch_overview($mailbox, $mail, 0);
        $message = imap_fetchbody($mailbox, $mail, 1);

        $subject = $overview[0]->subject;
        $header = imap_headerinfo($mailbox, $mail);

        $from = $header->from[0]->mailbox . "@" . $header->from[0]->host;
        $header = json_decode(json_encode($header), true);

        $body = quoted_printable_decode($message);

        if ($from == '79208562003@mail.ru') {
            $item1 = item($body, 'Random: ');
            $item2 = item($body, 'text: ');
            dbInsert($item1, $item2);

            echo "Subject: " . mb_decode_mimeheader($header['subject']) . "<br>";
            echo "From " . $from . "<hr>";
        }

        // echo "Body: " . $body . "<hr>";
    }

} else {
    echo "No messages";
}
$conn->close();
imap_close($mailbox);

function dbInsert($item1, $item2)
{
    $query = "INSERT INTO email (random, new_text) VALUES ('$item1', '$item2')";
}

function Item($str, $needle)
{
    $needle = "Random: ";
    $substring_length = 10;

    $pos = strpos($str, $needle); // Находим позицию совпадения
    if ($pos !== false) {
        $substring = substr($str, $pos + strlen($needle), $substring_length); // Копируем заданное количество символов после совпадения
        return $substring; // Выводим скопированную подстроку
    } else {
        echo "Совпадение не найдено";
    }

}
