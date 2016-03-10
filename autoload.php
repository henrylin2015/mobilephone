<?php
/**
 * @description: 自动加载类
 * @author:henry
 * @create 2016年03月10日10:11:08
 */
class autoload{
     public static function load( $fileName ){
                        $filePath = sprintf( "%s.php",str_replace( '\\','/',$fileName ));
                        if( is_file( $filePath ) ) require_once $filePath;
            }
}
/**
 * 自动注册函数
 */
spl_autoload_register( [ 'autoload','load' ] );