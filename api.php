<?php

require_once 'autoload.php';

use api\PhoneQuery;
/**
ini_set("display_errors", "On");
error_reporting(E_ALL | E_STRICT);


$res = PhoneQuery::query( '18721186620' );
echo "<pre>";
var_dump( $res );
*/
$params = $_POST;
$phone = $params['phone'];
$response = PhoneQuery::query($phone);
if (is_array($response) and isset($response['province'])) {
    $response['phone'] = $phone;
    $response['code'] = 200;
} else {
    $response['code'] = 400;
    $response['msg'] = '手机号码错误';
}
echo json_encode($response);

