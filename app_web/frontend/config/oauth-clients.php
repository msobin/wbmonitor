<?php

$googleClientID = getenv('OAUTH_GOOGLE_CLIENT_ID');
$googleClientSecret = getenv('OAUTH_GOOGLE_CLIENT_SECRET');

$facebookClientID = getenv('OAUTH_FACEBOOK_CLIENT_ID');
$facebookClientSecret = getenv('OAUTH_FACEBOOK_CLIENT_SECRET');

$clients = [];

if ($googleClientID && $googleClientSecret) {
    $clients['google'] = [
        'class' => \yii\authclient\clients\Google::class,
        'clientId' => $googleClientID,
        'clientSecret' => $googleClientSecret,
    ];
}

if ($facebookClientID && $facebookClientSecret) {
    $clients['facebook'] = [
        'class' => \yii\authclient\clients\Facebook::class,
        'clientId' => $facebookClientID,
        'clientSecret' => $facebookClientSecret,
    ];
}

return $clients;
