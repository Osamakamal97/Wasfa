<?php

namespace App\Traits;

trait APITrait
{

    public function returnError($error_number, $message)
    {
        return response()->json([
            'status' => false,
            'errorNumber' => $error_number,
            'message' => $message
        ]);
    }

    public function returnSuccess($error_number = "S000", $message = "")
    {
        return response()->json([
            'status' => true,
            'errorNumber' => $error_number,
            'message' => $message
        ]);
    }

    public function returnData($key, $value, $message)
    {
        return response()->json([
            'status' => true,
            'errorNumber' => 'S000',
            'message' => $message,
            $key => $value
        ]);
    }

    public function returnValidationError($code = "E001", $validator)
    {
        return $this->returnError($code, $validator->errors()->first());
    }


    public function returnCodeAccordingToInput($validator)
    {
        $inputs = array_keys($validator->errors()->toArray());
        $code = $this->getErrorCode($inputs[0]);
        return $code;
    }

    public function getErrorCode($input)
    {
        if ($input == "name")
            return 'E0011';

        else if ($input == "password")
            return 'E002';

        else
            return "";
    }
}
