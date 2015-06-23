<?php

namespace Munkie\ParatestBundle\Doctrine\MongoDB;

use Doctrine\MongoDB\Connection as BaseConnection;
use ParatestBundle\TestToken\TestTokenProvider;

/**
 *
 */
class Connection extends BaseConnection
{
    /**
     * @var TestTokenProvider
     */
    protected $tokenProvider;

    /**
     * @param TestTokenProvider $tokenProvider
     */
    public function setTokenProvider(TestTokenProvider $tokenProvider)
    {
        $this->tokenProvider = $tokenProvider;
    }

    /**
     * @param string $name
     * @return \Doctrine\MongoDB\Database
     */
    protected function doSelectDatabase($name)
    {
        if ($this->tokenProvider->hasToken()) {
            $name .= $this->tokenProvider->getToken();
        }
        return parent::doSelectDatabase($name);
    }
}
