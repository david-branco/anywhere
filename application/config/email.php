<?php

/*
 * What protocol to use?
 * mail, sendmail, smtp
 */
$config['protocol'] = 'smtp';

/*
 * SMTP server address and port
 */
$config['smtp_host'] = 'ssl://smtp.googlemail.com';
$config['smtp_port'] = '465';

/*
 * SMTP username and password.
 */
$config['smtp_user'] = 'el2014pi@gmail.com';
$config['smtp_pass'] = 'el2014piel2014pi';


/*
 * Heroku Sendgrid information.
 */
/*
$config['protocol'] = 'smtp';
$config['smtp_host'] = 'smtp.sendgrid.net';
$config['smtp_port'] = 587;
$config['smtp_user'] = $_SERVER['SENDGRID_USERNAME'];
$config['smtp_pass'] = $_SERVER['SENDGRID_PASSWORD'];
*/

$config['mailtype'] = 'html';
$config['charset'] = 'iso-8859-1';
$config['wordwrap'] = TRUE;
