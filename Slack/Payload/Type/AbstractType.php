<?php

/*
 * This file is part of the CLSlackBundle.
 *
 * (c) Cas Leentfaar <info@casleentfaar.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CL\Bundle\SlackBundle\Slack\Payload\Type;

use CL\Bundle\SlackBundle\Slack\Payload\PayloadInterface;
use CL\Bundle\SlackBundle\Slack\Payload\Transport\TransportInterface;
use Guzzle\Http\Message\Request;

/**
 * @author Cas Leentfaar <info@casleentfaar.com>
 */
abstract class AbstractType implements TypeInterface
{
    /**
     * @param PayloadInterface   $payload
     * @param TransportInterface $transport
     *
     * @return Request
     */
    public function createRequest(PayloadInterface $payload, TransportInterface $transport)
    {
        $client  = $transport->getHttpClient();
        $body    = json_encode($payload->getOptions());
        $headers = [
            'content-type' => 'application/json',
        ];
        $request = $client->createRequest('post', $client->getBaseUrl(), $headers, $body);

        return $request;
    }
}
