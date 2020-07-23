<?php


namespace App\Jobs;


use App\Helpers\GrabHelper;
use App\News;
use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;

class NewsJob
{
    const URL_GRAB       = 'https://www.rbc.ru/';
    const HOST_PRO       = 'pro.rbc.ru';
    const HOST_SPORT     = 'sport.rbc.ru';
    const HOST_PLUS      = 'plus.rbc.ru';
    const HOST_QUOTE     = 'quote.rbc.ru';
    const NUMBER_OF_NEWS = 25;

    public function handle(): void
    {
        $crawler = GrabHelper::htmlGrabber(self::URL_GRAB);

        $firstNews = $crawler->filter('.js-news-feed-list > a')->first();
        $news      = collect($firstNews->attr('href'));
        $time      = $firstNews->attr('data-modif');
        $client    = new Client();
        $response  = $client->get(sprintf(self::URL_GRAB . 'v10/ajax/get-news-feed/project/rbcnews/lastDate/%s/limit/35', $time));
        $json      = $response->getBody()->getContents();
        foreach (json_decode($json, true)['items'] as $value) {
            $crawler = new Crawler($value['html']);
            $newsUrl = $crawler->filter('a')->first()->attr('href');

            in_array(parse_url($newsUrl)['host'],
                [
                    parse_url(self::URL_GRAB)['host'],
                    self::HOST_PRO,
                    self::HOST_SPORT,
                    self::HOST_PLUS,
                    self::HOST_QUOTE
                ]) ? $news->push($newsUrl) : null;

            if ($news->count() >= self::NUMBER_OF_NEWS){
                break;
            }
        }

        $news->each(function ($url) {
            $crawler = GrabHelper::htmlGrabber($url);

            $seletorText  = '.article__text > p';
            $seletorTitle = '.article__header__title > h1';
            $seletorImg   = '.article__main-image__wrap > img';

            switch (parse_url($url)['host']) {
                case self::HOST_PRO:
                    $seletorText = '.article__text__pro';
                    break;
                case self::HOST_SPORT:
                    $seletorTitle = '.article__header__title > span';
                    $seletorImg   = '.article__main-image__link > img';
                    break;
            }

            $title = $crawler->filter($seletorTitle)->first();
            if ($title->count()) {
                $title = $title->text();
            } else return true;

            $img = $crawler->filter($seletorImg)->first();
            $img = $img->count() > 0 ? $img->attr('src') : null;

            $text = $crawler->filter($seletorText)->each(function ($node) {
                /** @var Crawler $node */
                return $node->text();
            });
            $text = implode(' ', $text);

            News::firstOrCreate(
                ['url' => $url],
                [
                    'title' => $title,
                    'text'  => $text,
                    'img'   => $img,
                    'url'   => $url,
                ]);
        });
    }
}
