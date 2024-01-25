<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    function validationError($array)
    {
        $array = $array->toArray();
        foreach ($array as $key => $value) {
            foreach ($value as $k => $v) {
                return $this->error($v);
            }
        }
    }

    function error($code = 1)
    {
        if (is_int($code))
            return $code;
        elseif (is_string($code))
            return response()->json(['status' => false, 'data' => [], 'message' => ['uz' => $code, 'ru' => $code, 'en' => $code,]]);
        return response()->json(['status' => false, 'data' => [], 'message' => $code]);
    }
    function successes($data=[]): \Illuminate\Http\JsonResponse
    {
        return response()->json(['status' => true, 'data' => $data, 'message' => ['uz' => 'Muvaffaqiyatli!','en' => 'Successful!', 'ru' => 'Успешно!',]]);
    }


    public static function good($origin = 'user', $result = [], $serverCode = 200, $extra = [])
    {
        return response()->json([
            'jsonrpc' => "2.0",
            'status' => true,
            'origin' => $origin,
            'result' => $result,
            'host' => self::host()
        ], 200);
    }

    public static function fail($origin = 'connection', $result = [], $serverCode = 200)
    {
        return response()->json([
            'jsonrpc' => "2.0",
            'status' => false,
            'origin' => $origin,
            'error' => $result,
            'host' => self::host()
        ], $serverCode);
    }

    public static function success($origin = 'user', $result = [], $serverCode = 200, $extra = []): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'jsonrpc' => "2.0",
            'status' => true,
            'origin' => $origin,
            'result' => $result,
            'host' => self::host()
        ], 200);
    }

    public static function host()
    {

        return array(
            "host" => "Quramiz",
            "time_stamp" => self::id(1)
        );

    }

    public static function id($type = 0)
    {
        $time = time();
        switch ($type) {
            case 0:
                return $time;
                break;
            case 1:
                $time = time() + (5 * 60 * 60);
                return gmdate("Y-m-d H:i:s", $time);
                break;
        }
    }

    public static function phone($number){
        $number = str_replace([' ','(',')','+'],'',$number);
        if( strlen($number) == 9 ){
            return "998" . $number;
        }
        return $number;
    }
    public static function method($name, $delim = ".")
    {
        $array = explode($delim, $name);
        $name = "";

        for ($i = 0; $i < count($array); $i++) {
            if ($i == 0) {
                $name = $name . $array[$i];
            } else {
                $name = $name . ucwords($array[$i]);
            }

        }

        return $name;
    }

}
