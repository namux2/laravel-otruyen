<?php

namespace YourVendor\Otruyen\Jobs;

use GuzzleHttp\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use YourVendor\Otruyen\Models\Comic;

class CrawlComicJob implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(protected string $slug, protected bool $store = false)
    {
    }

    public function handle(): void
    {
        $client = new Client(['base_uri' => config('otruyen.base_url')]);
        $response = $client->get("/v1/api/truyen/{$this->slug}");
        $data = json_decode($response->getBody()->getContents(), true);

        if ($this->store && isset($data['data'])) {
            Comic::updateOrCreate(
                ['slug' => $this->slug],
                ['title' => $data['data']['name'] ?? $this->slug]
            );
        }
    }
}
