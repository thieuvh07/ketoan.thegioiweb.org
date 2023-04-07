<?php
header('Content-Type: text/html; charset=utf-8');
date_default_timezone_set('Asia/Ho_Chi_Minh');
define('BACKEND_DIRECTORY', 'admin');
define('AUTH', 'HTVIETNAM_');
define('BASE_URL', 'http://ketoan.thegioiweb.org/');
define('HTSUFFIX', '.html');
define('DEBUG', 0);
define('COMPRESS', 0);
define('CODE', 'HTCODE');

define('CODE_CONSTRUCTION', 'CT');
define('CODE_IMPORT', 'IM');
define('CODE_REPAY', 'RE');
define('CODE_EXPORT', 'EX');
define('CODE_PRODUCT', 'SP');
define('CODE_SUPPLIER', 'NCC');
define('CODE_CUSTOMER', 'KH');

define('HTDBHOST', 'localhost');
define('HTDBUSER', 'root');
define('HTDBPASS', '');
define('HTDBNAME', 'ketoan_data');

define('SECREST', 'qJB0rGtIn5UB1xG03efyCp');
define('TOKEN_PATH', 'token.json');

define('PRE_PASS', false);
define('IMG_NOT_FOUND', 'template/backend/not-found.png');
define('API_URL', 'http://api.thegioiweb.org/v1.0/');
define('SRC_IMG', '/upload/image/');
define('SRC_THUMB', '/upload/thumb/');
