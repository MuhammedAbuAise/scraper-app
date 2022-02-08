<?php

namespace App\Http\Services;

use Goutte\Client;

/**
 * Class OfferService
 *
 * @package App\Http\Services
 * @author Mahammad Mammadov <muhammed.mammadov.89@gmail.com>
 */
class ScraperService
{
    /**
     * @var array
     */
    private $scraperResult = [];

    /**
     * client url
     * @var string
     */
    private $url="https://news.ycombinator.com/";

    /**
     * Parse Html document
     *
     * @param Client $client
     * @return array
     */
    public function parseScraper(Client $client): array
    {
        $crawler = $client->request("GET", $this->url);

        $crawler->filter(".itemlist")->each(function ($item) {
            $item->filter(".athing")->each(function ($subItem, $i) {
                try {
                    $this->scraperResult[$i] = [
                        //'id' => (int)$subItem->filter('.rank')->text(),
                        'title' => $subItem->filter('.title a')->text(),
                        'link' => $subItem->filter('.title a')->attr('href'),
                    ];
                } catch (\InvalidArgumentException $e) { // I guess its InvalidArgumentException in this case
                    $this->scraperResult[$i] = [
                        'id' => null,
                        'title' => null,
                        'link' => null,
                    ];
                }
            });

            $item->filter('.subtext')->each(function($subItem, $i) {
                try {
                    $this->scraperResult[$i] = array_slice($this->scraperResult[$i], 0, count($this->scraperResult[$i]))
                        +  array('point' => (int)$subItem->filter('.score')->text(),
                            'created' =>\Carbon\Carbon::parse($subItem->filter('.age')->attr('title'))->format('Y-m-d H:i:s'))
                        + array_slice($this->scraperResult[$i], count($this->scraperResult[$i]));
                } catch (\InvalidArgumentException $e) { // I guess its InvalidArgumentException in this case
                    $this->scraperResult[$i] = array_slice($this->scraperResult[$i], 0, count($this->scraperResult[$i]))
                        +  array('point' => 0,'created' =>\Carbon\Carbon::parse($subItem->filter('.age')->attr('title'))->format('Y-m-d H:i:s'))
                        + array_slice($this->scraperResult[$i], count($this->scraperResult[$i]));
                }
            });
        });

        return $this->scraperResult;
    }
}