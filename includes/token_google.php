<?php

declare(strict_types=1);
    $secret = 'XVQ2UIGO75XRUKJO';
    $QRCode = \Sonata\GoogleAuthenticator\GoogleQrUrl::generate('gbc', $secret, 'animarium');
    $g = new \Sonata\GoogleAuthenticator\GoogleAuthenticator();



?>