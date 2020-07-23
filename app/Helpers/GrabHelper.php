<?php


namespace App\Helpers;


use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Symfony\Component\DomCrawler\Crawler;

class GrabHelper
{
    public static function htmlGrabber(string $url) : Crawler{
        $client   = new Client();
        $request  = new Request('GET', $url);
        $response = $client->send($request);
        $html     = $response->getBody()->getContents();
        return new Crawler($html);
    }
}
