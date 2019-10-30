<?php

namespace App\Adapters;

use App\Contracts\QuotesProvider;
use Cache;
use Exception;
use Illuminate\Support\Collection;

/**
 * Class CachingQuotes
 * @package App\Adapters
 */
class CachingQuotes implements QuotesProvider
{
    /**
     * @var QuotesProvider
     */
    protected $quotesProvider;

    protected $cacheLifetime;

    /**
     * CachingQuotes constructor.
     * @param QuotesProvider $quotesProvider
     */
    public function __construct(QuotesProvider $quotesProvider)
    {
        $this->quotesProvider = $quotesProvider;
        $this->cacheLifetime = config('app.cache_lifetime');
    }

    /**
     * Get Shouted Quotes.
     *
     * @param string $name
     * @param int $limits
     * @return Collection
     * @throws Exception
     */
    public function getShoutedQuotes(string $name, int $limit): Collection
    {
        return Cache::remember('shouted.quotes.all', $this->cacheLifetime, function () use ($name, $limit) {
            return $this->quotesProvider->getShoutedQuotes($name, $limit);
        });
    }
}
