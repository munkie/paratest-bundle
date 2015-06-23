<?php

namespace Munkie\ParatestBundle\Doctrine\DBAL;

use Doctrine\Bundle\DoctrineBundle\ConnectionFactory as BaseConnectionFactory;
use Doctrine\Common\EventManager;
use Doctrine\DBAL\Configuration;
use ParatestBundle\TestToken\TestTokenProvider;

/**
 *
 */
class ConnectionFactory extends BaseConnectionFactory
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
     * @inheritdoc
     */
    public function createConnection(
        array $params,
        Configuration $config = null,
        EventManager $eventManager = null,
        array $mappingTypes = array()
    ) {
        if ($this->tokenProvider->hasToken()) {
            $params['dbname'].= $this->tokenProvider->getToken();
        }
        return parent::createConnection($params, $config, $eventManager, $mappingTypes);
    }
}
