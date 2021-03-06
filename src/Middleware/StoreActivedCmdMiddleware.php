<?php

namespace LineMob\Core\Middleware;

use League\Tactician\Middleware;
use LineMob\Core\Command\AbstractCommand;

class StoreActivedCmdMiddleware implements Middleware
{
    /**
     * @param AbstractCommand $command
     *
     * {@inheritdoc}
     */
    public function execute($command, callable $next)
    {
        if ($command->actived) {
            if (!$command->storage) {
                throw new \RuntimeException("Require storage before using this middleware!");
            }

            $command->storage->setLineActivedCmd($command->cmd);
        }

        return $next($command);
    }
}
