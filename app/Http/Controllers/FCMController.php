<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use FCM;
class FCMController extends Controller
{
    function notification() {
            
        $optionBuiler = new OptionsBuilder();
        $optionBuiler->setTimeToLive(60 * 20);

        $notificationBuilder = new PayloadNotificationBuilder("Prueba ");
        $notificationBuilder->setBody("Prueba de la notificacion")
            ->setSound('');
        
        $dataarray = [];
        $dataBuilder = new PayloadDataBuilder();
        $dataBuilder->addData($dataarray);

        $option = $optionBuiler->build();
        $notification = $notificationBuilder->build();
        $data = $dataBuilder->build();

        $token = $token;

        $downstreamResponse = FCM::sendTo($token, $option, $notification, $data);

        return new JsonResponse(
            [
                'status' =>'1',
                 'sucess' =>$downstreamResponse->numberSuccess(), 
                 'fail' => $downstreamResponse->numberFailure(),
                  'msg' => $downstreamResponse->tokensWithError(),
                 200]);

    }

    
}
