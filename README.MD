###Default template

<div style="padding: 20px;">
    <?= $body?>
</div>

###Regular template

<h2>In the online store "<?=$shopName?>" you ordered a product №<?=$item?>!</h2>
<p>Thanks, Online store "<?=$shopName?>"<p>

## Basic Usage

```php
<?php

use App\Transport\MailTransport;

$config = [
    'smtp'=>'smtp.gmail.com',
    'port' => 465,
    'encryption'=>'ssl',
    'pathTemplates'=> '/templates/',
    'defaultTemplate'=> '/templates/default.php',
    'username'=>'',
    'email'=>'info@gmail.com',
    'password'=> '',
];
$pathLog = '/logs/log.log';

$transport = new MailTransport($config);
$transport->setLogs($pathLog, 'Alex Goncharov');

$params = [
    'shopName' => "Apple Shop",
    'item' => "2718",
];
$title = "Your purchase";

$transport->send('order', 'info@gmail.com', 'user', $title, $params);
