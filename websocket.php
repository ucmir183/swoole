<?php
/**
 * Created by PhpStorm.
 * User: ADMIN
 * Date: 2016/8/4
 * Time: 13:15
 */

$ws = new swoole_websocket_server('0.0.0.0',9502);

$ws->on('open',function (swoole_websocket_server $ws,$request) {
    $ws->push($request->fd,"hello,welcome \n");
});

$ws->on('message',function (swoole_websocket_server $ws,$frame){
    echo "Message:{$frame->data}\n";
    foreach ( $ws->connections as $fd ) {
        $ws->push($fd,"{$frame->fd}:{$frame->data}");
    }

});

$ws->on('close',function (swoole_websocket_server $ws,$fd){
    echo "client-{$fd} is clsed\n";

});

$ws->start();
