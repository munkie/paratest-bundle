<?php

namespace ParatestBundle\TestToken;

/**
 * Provider to retrieve test token from environment variable
 */
class TestTokenProvider
{
    /**
     * Test thread token name environment variable name
     *
     * @var string
     */
    protected $tokenName = 'TEST_TOKEN';

    /**
     * @param string $tokenName
     */
    public function __construct($tokenName = null)
    {
        if (null !== $tokenName) {
            $this->tokenName = $tokenName;
        }
    }

    /**
     * @return bool
     */
    public function hasToken()
    {
        return false !== getenv($this->tokenName);
    }

    /**
     * Get test thread token value
     *
     * @return string
     */
    public function getToken()
    {
        return $this->hasToken() ? getenv($this->tokenName) : '';
    }
}
