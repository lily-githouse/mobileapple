<?php
$password='qwerty';
$pass=md5(crypt($password,md5('wuif1907-2')));
echo $pass;
