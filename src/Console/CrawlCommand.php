<?php

namespace YourVendor\Otruyen\Console;

use GuzzleHttp\Client;
use Illuminate\Console\Command;
use YourVendor\Otruyen\Jobs\CrawlComicJob;

class CrawlCommand extends Command
{
    protected $signature = 'otruyen:crawl {--store : Luu du lieu vao database}';
    protected $description = 'Fetch latest comics from OTruyen API';

    public function handle(): int
    {
        $client = new Client(['base_uri' => config('otruyen.base_url')]);
        $response = $client->get('/v1/list/truyen-moi');
        $data = json_decode($response->getBody()->getContents(), true);

        foreach ($data['data'] ?? [] as $item) {
            CrawlComicJob::dispatch($item['slug'], $this->option('store'));
        }

        $this->info('Dispatched crawl jobs.');

        return self::SUCCESS;
    }
}
