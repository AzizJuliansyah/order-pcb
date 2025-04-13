<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config['protocol'] = 'mail';  // Gunakan 'mail' alih-alih 'smtp'
$config['mailtype'] = 'html';  // Tipe email (html atau teks)
$config['charset']  = 'utf-8'; // Charset email
$config['wordwrap'] = TRUE;    // Pembungkusan kata
$config['newline']  = "\r\n";  // Garis baru untuk email
?>