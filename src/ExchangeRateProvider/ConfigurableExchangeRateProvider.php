<?php

namespace Brick\Money\ExchangeRateProvider;

use Brick\Money\ExchangeRateProvider;
use Brick\Money\Exception\CurrencyConversionException;

use Brick\Math\BigNumber;

/**
 * A configurable exchange rate provider.
 */
class ConfigurableExchangeRateProvider implements ExchangeRateProvider
{
    /**
     * @var array
     */
    private $exchangeRates = [];

    /**
     * @param string                  $sourceCurrencyCode
     * @param string                  $targetCurrencyCode
     * @param BigNumber|number|string $exchangeRate
     *
     * @return ConfigurableExchangeRateProvider
     */
    public function setExchangeRate($sourceCurrencyCode, $targetCurrencyCode, $exchangeRate)
    {
        $this->exchangeRates[$sourceCurrencyCode][$targetCurrencyCode] = $exchangeRate;
    }

    /**
     * {@inheritdoc}
     */
    public function getExchangeRate($sourceCurrencyCode, $targetCurrencyCode)
    {
        if (isset($this->exchangeRates[$sourceCurrencyCode][$targetCurrencyCode])) {
            return $this->exchangeRates[$sourceCurrencyCode][$targetCurrencyCode];
        }

        throw CurrencyConversionException::exchangeRateNotAvailable($sourceCurrencyCode, $targetCurrencyCode);
    }
}
