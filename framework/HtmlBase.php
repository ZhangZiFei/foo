<?php
header('Content-Type:text/html;charset=utf-8');
include __DIR__ . '/Base.php';

// class HtmlBase
// {
// }

//自定义异常处理
set_exception_handler(function($e){
    try {
        http_response_code(521); 
        ob_clean();
        ?><pre><?php var_dump($e); ?></pre><?php
        die();
    } catch (\Throwable $th) {
        echo '<pre>' . $th->__toString() . '</pre>';
    }
});
set_error_handler(function(int $errno, string $errstr, string $errfile, int $errline, array $errcontext = []){
    try {
        http_response_code(522);
        $e = [
            '错误级别' => $errno,
            '错误信息' => $errstr,
            '错误文件' => $errfile,
            '错误行号' => $errline,
            'errcontext' => $errcontext
        ];
        ob_clean();
        ?><pre><?php var_dump($e); ?></pre><?php
        die();
    } catch (\Throwable $th) {
        echo '<pre>' . $th->__toString() . '</pre>';
    }
});