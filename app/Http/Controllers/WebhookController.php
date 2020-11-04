<?php

namespace App\Http\Controllers;

use Openpay;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WebhookController extends Controller
{
    public function webhook()
    {
        $openpay = Openpay::getInstance('m4gx48zqyw8xs4en1z1u', 'sk_d70ffc17846544e39488869d11fac3dc');
        $webhook = array(
            'url' => 'https://hooks.slack.com/services/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',
            'event_types' => array(
                'charge.refunded',
                'charge.failed',
                'charge.cancelled',
                'charge.created',
                'chargeback.accepted'
            )
        );
        $webhook = $openpay->webhooks->add($webhook);
        return $webhook->id;
    }

    public function getWebHook(){
        $openpay = Openpay::getInstance('m4gx48zqyw8xs4en1z1u', 'sk_d70ffc17846544e39488869d11fac3dc');
        $webhook = $openpay->webhooks->get('wq1aahugwn4ewzbgsosd');

        return json_encode($webhook->status);
    }
}
