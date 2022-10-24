<?php

declare(strict_types=1);

namespace TTBooking\CurrencyExchange\Providers;

use TTBooking\CurrencyExchange\Contracts\ExchangeRateProvider;
use TTBooking\CurrencyExchange\Contracts\ExchangeRateQuery;
use TTBooking\CurrencyExchange\Exceptions\UnsupportedExchangeQueryException;

class ExchangeRateNullProvider implements ExchangeRateProvider
{
    public function has(ExchangeRateQuery $query): bool
    {
        return false;
    }

    public function get(ExchangeRateQuery $query): never
    {
        throw new UnsupportedExchangeQueryException;
    }
}
