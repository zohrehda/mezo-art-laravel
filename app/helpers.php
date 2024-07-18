<?php

use Illuminate\Support\Str;

function modelResolve($value)
{
    if (!$value)
        return null;
    $model = 'App\\Models\\' . Str::studly(Str::singular($value));
    return ($value and class_exists($model)) ? $model : null;
}


if (!function_exists('apiAuth')) {

    function apiAuth()
    {
        $request = request();
        if (!$request->filled('dev_auth_id'))
            return auth()->user();

        $validator = Validator::make($request->all(), [
            'dev_auth_id' => 'exists:users,id'
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        $model = config('custom_helper.user_model');
        $user = new $model;
        return $user->find($request->dev_auth_id);
    }
}

if (!function_exists('get_nested_array_values')) {
    function get_nested_array_values($array, $values = [])
    {
        foreach ($array as $k => $value) {

            if (!is_array($value)) {
                $values[] = $value;
            } else {
                $values = get_nested_array_values($value, $values);
            }
        }

        return $values;
    }
}

function get_dpi($filename){
    $a = fopen($filename,'r');
    $string = fread($a,20);
    fclose($a);

    $data = bin2hex(substr($string,14,4));
    $x = substr($data,0,4);
    $y = substr($data,0,4);

    return array(hexdec($x),hexdec($y));
} 