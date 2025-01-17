<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Events\DataReceived; // Custom event to broadcast data
use Ratchet\Client\WebSocket;
use Ratchet\Client\Connector;
use React\EventLoop\Loop;

class ListenToDhanWebSocket extends Command
{
    protected $signature = 'websocket:listen-dhan';
    protected $description = 'Listen to Dhan WebSocket and broadcast data';

    public function handle()
    {
        // $loop = \React\EventLoop\Factory::create();
        $loop = Loop::get();
        $connector = new Connector($loop);
        $token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiJ9.eyJpc3MiOiJkaGFuIiwicGFydG5lcklkIjoiIiwiZXhwIjoxNzM4MDQ5OTE5LCJ0b2tlbkNvbnN1bWVyVHlwZSI6IlNFTEYiLCJ3ZWJob29rVXJsIjoiIiwiZGhhbkNsaWVudElkIjoiMTEwMTE5MzI2NSJ9.I-8S0LPd-1CQ7D8iKSyBZ2XF9SeC9HkLqJhsbihL7VP4-PTtv2bkF-wZmtNc27Z5uz-xWIxG0nySvnpbUZ5AAQ";
        $clientID = "update your clinet id";
        $websocketUrl = "wss://api-feed.dhan.co?version=2&token=".$token."&clientId=".$clientID."&authType=2";
        // $websocketUrl = "wss://ws.pusherapp.com";

        $connector($websocketUrl)->then(
            function (WebSocket $conn) {
                $this->info('Connected to Dhan WebSocket');

                // Send initial subscription request
                $conn->send(json_encode([
                    "RequestCode" => 15,
                    "InstrumentCount" => 2,
                    "InstrumentList" => [
                        ["ExchangeSegment" => "NSE_EQ", "SecurityId" => "1333"],
                        ["ExchangeSegment" => "BSE_EQ", "SecurityId" => "532540"]
                    ],
                ]));

                // Handle incoming messages
                $conn->on('message', function ($message) {
                    $data = json_decode($message, true);
                    broadcast(new DataReceived($data)); // Broadcast using Reverb
                });

                $conn->on('close', function () {
                    $this->error('Connection closed');
                });
            },
            function ($e) use ($loop) {
                echo "hello"; die;
                $this->error('Could not connect: ' . $e->getMessage());
                $loop->stop();
            }
        );

        $loop->run();
    }
}
