<?php


namespace PN\Users\Jobs;


use PN\Jobs\Job;
use PN\Users\User;

/**
 * Class SetPaymentMethods
 * @package PN\Users\Jobs
 */
class SetPaymentMethods extends Job
{
    /**
     * @var User
     */
    private $user;

    /**
     * @var string
     */
    private $paypal;

    /**
     * @var string
     */
    private $bitcoin;

    /**
     * SetPaymentMethods constructor.
     * @param User $user
     * @param string $paypal
     * @param string $bitcoin
     */
    public function __construct(User $user, string $paypal, string $bitcoin)
    {
        $this->user = $user;
        $this->paypal = $paypal;
        $this->bitcoin = $bitcoin;
    }

    public function handle()
    {
        $this->user->paypal = $this->paypal;
        $this->user->bitcoin = $this->bitcoin;

        \UserRepo::edit($this->user);
    }
}