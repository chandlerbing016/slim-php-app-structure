<?php

defined('KIRK_BASE_ROOT') OR define('KIRK_BASE_ROOT', dirname(__FILE__) . '/../');

if(!function_exists('openssl_encrypt')) {
    throw new \Exception('module \'openssl_encrypt\' should be installed in your system');
}