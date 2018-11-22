<?php
/**
 * Created by PhpStorm.
 * User: SIGTTD
 * Date: 11.09.2018
 * Time: 22:11
 */

setcookie('login', '', -10, '/');
setcookie('password', '', -10, '/');
header('Location: /index.php');