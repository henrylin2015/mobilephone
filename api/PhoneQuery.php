<?php
namespace api;

use libs\HttpRequest;

class PhoneQuery{

     const PHONE_API = 'https://tcc.taobao.com/cc/json/mobile_tel_segment.htm';

     const QUERY_PHONE = 'PHONE:INFO:';



     public static function formatData($data){
                             $ret = null;
                             if (!empty($data)) {
                                  preg_match_all("/(\w+):'([^']+)/", $data, $res);
                                  $items = array_combine($res[1], $res[2]);
                                  foreach ($items as $itemKey => $itemVal) {
                                       $ret[$itemKey] = iconv('GB2312', 'UTF-8', $itemVal);
                                  }
                             }
                             return $ret;
                        }
     
     /**
      * @功能:查询电话号码
      * @author:henry
      * @time 2016年03月10日09:52:57
      */
     public static function  query( $phone ){
                        $phoneData = null;
                        if( self::verifyPhone( $phone ) ){
                             $response = HttpRequest::request( self::PHONE_API,[ 'tel'=>$phone ] );
                             $phoneData = self::formatData( $response );
                             $phoneData['msg'] = 'henry';
                        }else{
                             $phoneData[ 'msg' ]='电话号码错误！！！';
                        }
                        return $phoneData;
            }
     /**
      * @description:验证电话号码是否正确
      * @author:henry
      * @create 2016年03月10日10:33:41
      */
     public static function verifyPhone( $phone ){
                        if( preg_match( '/^1[34578]{1}\d{9}$/',$phone ) ){
                             return true;
                        }else{
                             return false;
                        }
                   }
}