<?php

namespace App\Services;

use App\Contracts\QuotesProvider;
use Exception;
use Illuminate\Support\Collection;
use Storage;

/**
 * Class JsonQuotes
 * @package App\Services
 */
class JsonQuotes implements QuotesProvider
{
    /**
     * @var string Path of Json file with quotes
     */
    protected $path;

    /**
     * JsonQuotes constructor.
     */
    public function __construct()
    {
        $this->path = config('app.quotes_path');
    }

    /**
     * Get Shouted Quotes.
     *
     * @param string $name
     * @param int $limit
     * @return Collection
     * @throws Exception
     */
    public function getShoutedQuotes(string $name, int $limit): Collection
    {
        $quotes = $this->loadFile($this->path);
        $filteredQuotes = $this->filterByName($quotes, $name);
        $shoutedQuotes = $this->shoutQuotes($filteredQuotes);

        return $shoutedQuotes->take($limit);
    }

    /**
     * Check for file existence.
     *
     * @param string $path
     * @throws Exception
     */
    private function checkFileExists(string $path): void
    {
        if ( ! Storage::exists($path)) {
            throw new Exception("{$this->path} File not found");
        }
    }

    /**
     * Load data from Json file.
     *
     * @param $path
     * @return Collection
     * @throws Exception
     */
    private function loadFile($path): Collection
    {
        $this->checkFileExists($this->path);

        $quotesRaw = Storage::get($path);
        $quotesObject = json_decode($quotesRaw);

        return collect($quotesObject->quotes);
    }

    /**
     * Filter quotes collection by author name.
     *
     * @param Collection $quotes
     * @param string $name
     * @return Collection
     */
    private function filterByName(Collection $quotes, string $name): Collection
    {
        return $quotes->filter(function ($value) use ($name) {
            return strpos(strtoupper($value->author), strtoupper(str_replace('-', ' ', $name))) !== false;
        });
    }

    /**
     * 'Shout' quotes.
     *
     * @param Collection $quotes
     * @return Collection
     */
    private function shoutQuotes(Collection $quotes): Collection
    {
        $onlyText = collect();
        foreach ($quotes as $quote) {
            $quoteText = $quote->quote;
            if (substr($quote->quote, -1, 1) !== self::EXCLAMATION_CHARACTER) {
                $quoteText = substr($quoteText, 0, -1) . self::EXCLAMATION_CHARACTER;
            }
            $onlyText->add(mb_strtoupper($quoteText));
        }

        return $onlyText;
    }
}
