<?php
// phpinfo();

$mailbox=imap_open('{imap.mail.ru:993/imap/ssl}INBOX',
                        '79208562003@mail.ru','eViPPC7QwhWQ9trTiQSJ');

$mail_list=imap_search($mailbox, 'ALL');


$num_emails = imap_num_msg($mailbox);
    echo $num_emails."<hr>";

if($mail_list)
{
    foreach ($mail_list as $mail)
     {
        $overview=imap_fetch_overview($mailbox, $mail, 0);
        $message=imap_fetchbody($mailbox, $mail,1);

        $subject=$overview[0]->subject;
      $header=imap_headerinfo($mailbox, $mail);
      $header=json_decode(json_encode($header), true);

        $body=quoted_printable_decode($message);


        echo "Subject: ". mb_decode_mimeheader($header['subject'])  ."<br>";
        echo "Body: ". $body."<br>";
    }
   
}

 else echo "No messages";
 
imap_close($mailbox);