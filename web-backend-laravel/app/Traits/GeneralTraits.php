<?php

namespace App\Traits;

trait GeneralTraits
{

    public function returnSuccessMessage($errNum = "er000", $msg = "")
    {

        return response()->json([
            'status' => true,
            'errNum' => $errNum,
            'msg' => $msg,

        ]);
    }

    public function returnErrors($errNum, $msg)
    {

        return response()->json([
            'status' => false,
            'errNum' => $errNum,
            'msg' => $msg,

        ]);
    }

    public function returnData($key, $value, $msg = "")
    {

        return response()->json([
            'status' => true,
            'errNum' => "er000",
            'msg' => $msg,
            $key => $value,

        ]);
    }

    public function returnDataPointCount($key, $value, $allpoint, $yesvisit, $msg = "")
    {

        return response()->json([
            'status' => true,
            'allpoint' => $allpoint,
            'yesvisit' => $yesvisit,
            'errNum' => "er000",
            'msg' => $msg,
            $key => $value,

        ]);
    }


    public function returnDataWithCountVisit($key, $value,  $yesvisit)
    {

        return response()->json([
            'status' => true,
            'yesvisit' => $yesvisit,
            'errNum' => "er000",
            $key => $value,

        ]);
    }

    public  function  returnDataPointCountDashboard($allpoint, $yesvisit, $msg = "")
    {

        return response()->json([
            'status' => true,
            'allpoint' => $allpoint,
            'yesvisit' => $yesvisit,
            'msg' => $msg,

        ]);
    }


}
