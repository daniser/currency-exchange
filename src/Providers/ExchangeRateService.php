<?php

declare(strict_types=1);

namespace TTBooking\CurrencyExchange\Providers;

use TTBooking\CurrencyExchange\Contracts\CurrencyPair;
use TTBooking\CurrencyExchange\Contracts\ExchangeRateService as ExchangeRateServiceContract;
use TTBooking\CurrencyExchange\ExchangeRate;

abstract class ExchangeRateService implements ExchangeRateServiceContract
{
    /**
     * Creates an exchange rate.
     */
    protected function createRate(CurrencyPair $currencyPair, float $rate, \DateTimeInterface $date): ExchangeRate
    {
        return new ExchangeRate($currencyPair, $rate, $date, $this->getName());
    }
}
