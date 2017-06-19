<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use FCM;
use LaravelFCM\Message\Topics;
class FCMController extends Controller
{
   static function notification($title,$body) {
        $notificationBuilder = new PayloadNotificationBuilder($title);
        $notificationBuilder->setBody($body)
                            ->setSound('default')
                            ->setIcon('not');
                            
        $notification = $notificationBuilder->build();

        $topic = new Topics();
        $topic->topic('provfarm');

        $topicResponse = FCM::sendToTopic($topic, null, $notification, null);

        $topicResponse->isSuccess();
        $topicResponse->shouldRetry();
        $topicResponse->error();
        
    }

    
}
