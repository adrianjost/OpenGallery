<?php
function RandomIDGenerator($len = 5) {
    $base='abcdefghjkmnpqrstwxyzABCDEFGHKLMNOPQRSTWXYZ0123456789';
    $activatecode='';
    mt_srand((double)microtime()*1000000);
    while (strlen($activatecode)<$len)
        $activatecode.=$base{mt_rand(0,strlen($base)-1)};
    return $activatecode;
}
?>