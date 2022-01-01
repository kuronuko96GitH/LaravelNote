<?php

namespace App\Http\Middleware;

use Illuminate\Http\Middleware\TrustProxies as Middleware;
use Illuminate\Http\Request;

class TrustProxies extends Middleware
{
    /**
     * The trusted proxies for this application.
     *
     * @var array<int, string>|string|null
     */
//    protected $proxies;
    // 暫定対応
    // httpsだと、保護されてない通信と表示されて嫌な気分になるので、
    // $proxiesに信用するプロキシのIPアドレスを追加します。
    // '*'は全プロキシを信用するという設定です。
    // HerokuのプロキシのIPアドレスが分からず、Herokuのセキュリティレベルならこれでも大丈夫そうということで、これを採用しました。
    protected $proxies = '*';

    /**
     * The headers that should be used to detect proxies.
     *
     * @var int
     */
    protected $headers =
        Request::HEADER_X_FORWARDED_FOR |
        Request::HEADER_X_FORWARDED_HOST |
        Request::HEADER_X_FORWARDED_PORT |
        Request::HEADER_X_FORWARDED_PROTO |
        Request::HEADER_X_FORWARDED_AWS_ELB;
}
