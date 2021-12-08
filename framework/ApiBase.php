<?php
header('application/json;charset=utf-8');
include __DIR__ . '/Base.php';

class ApiBase
{
    /**
     * @var ApiBase
     */
    public static $api;

    /**
     * 接口返回的数据
     */
    public static $ret = [];

    /**
     * 接口异常
     * 
     * `eCode`通常情况下设置为大于等于0的数字,小于0的数字仅被ApiBase.php使用
     * 
     * > eCode = -1 //set_error_handler error
     * >
     * > eCode = -2 //set_exception_handler error
     * >
     * > eCode = -3 //php error
     * 
     * eg:
     * 
     * ```php
     * $e = new Exception()
     * ApiBase::Error($e->getCode(), get_class($e), $e->getMessage());
     * ```
     * 
     * @param integer $eCode 异常代码
     * @param string $eType 异常类型
     * @param string $eMsg 异常信息
     * @return void
     */
    public static function Error(int $eCode, string $eType, string $eMsg)
    {
        self::$ret = [
            'eCode' => $eCode,
            'eType' => $eType,
            'eMsg' => $eMsg
        ];
        die();
    }

    /**
     * 接口异常
     *
     * @param Exception $e
     * @return void
     */
    public static function Exception(Exception $e)
    {
        self::Error($e->getCode(), get_class($e), $e->getMessage());
    }

    //------------------------------------------------

    public function __destruct()
    {
        echo json_encode(self::$ret);
    }
}

ApiBase::$api = new ApiBase();

//自定義異常處理
set_exception_handler(function ($e) {
    try {
        http_response_code(530);
        ApiBase::Error($e->getCode(), get_class($e), $e->getMessage());
    } catch (\Throwable $th) {
        ApiBase::Error(-2, 'set_exception_handler', $th->getMessage());
    }
});
set_error_handler(function (int $errno, string $errstr, string $errfile, int $errline, array $errcontext = []) {
    try {
        http_response_code(530);
        ApiBase::Error(-3, 'php error', $errstr);
    } catch (\Throwable $th) {
        ApiBase::Error(-1, 'set_error_handler', $th->getMessage());
    }
});
