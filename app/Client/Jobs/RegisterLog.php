<?php


namespace PN\Client\Jobs;


use PN\Client\ClientLog;

class RegisterLog
{
    private $ip;

    private $action;

    private $version;

    /**
     * RegisterLog constructor.
     * @param $ip
     * @param $action
     * @param $version
     */
    public function __construct($ip, $action, $version)
    {
        $this->ip = $ip;
        $this->action = $action;
        $this->version = $version;
    }

    public function handle()
    {
        $clientLog = new ClientLog();

        $clientLog->fill([
            'ip' => $this->ip,
            'action' => $this->action,
            'version' => $this->version
        ]);

        \ClientRepo::add($clientLog);
    }
}