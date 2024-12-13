<?php function getRealIpUser()
{
switch (true) {
    // id máy truy cập
case (!empty($_SERVER['HTTP_X_REAL_IP'])):
return $_SERVER['HTTP_X_REAL_IP'];
case (!empty($_SERVER['HTTP_CLIENT_IP'])):
return $_SERVER['HTTP_CLIENT_IP'];
case (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])):
return $_SERVER['HTTP_X_FORWARDED_FOR'];
default:
return $_SERVER['REMOTE_ADDR'];
}
}
?>