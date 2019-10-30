<?php

namespace App\Contracts;

use Exception;
use Illuminate\Support\Collection;

/**
 * Interface QuotesProvider
 * @package App\Contracts
 */
interface QuotesProvider
{
    /**
     * Exclamation Character
     */
    public const EXCLAMATION_CHARACTER = '!';

    /**
     * Get Shouted Quotes.
     *
     * @param string $name
     * @param int $limit
     * @return Collection
     * @throws Exception
     */
    public function getShoutedQuotes(string $name, int $limit): Collection;
}
