<?php

namespace Centagon\PauseableQueue;

use Illuminate\Queue\Worker;

/**
 * Description of PausableConnector
 *
 * @author rene
 */
class PauseableWorker extends Worker {

    /**
     * Get the next job from the queue connection.
     *
     * @param  \Illuminate\Contracts\Queue\Queue  $connection
     * @param  string  $queue
     * @return \Illuminate\Contracts\Queue\Job|null
     */
    protected function getNextJob($connection, $queue)
    {
        if ($this->queueIsPaused($connection, $queue)) {
            return null;
        }
        
        return parent::getNextJob($connection, $queue);
    }
    
    protected function queueIsPaused($connection, $queue)
    {
        if (!$this->cache) {
            return false;
        }
        // maybe in the future we want to pause specific queues
        // $name = $connection->getConnectionName();
        // return $this->cache->has("queue:paused:{$name}:{$queue}");
        return $this->cache->has("illuminate:queue:pause");
    }

}
