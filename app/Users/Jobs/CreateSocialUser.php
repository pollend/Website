<?php

namespace PN\Users\Jobs;


use Illuminate\Foundation\Bus\DispatchesJobs;
use PN\Jobs\Job;

class CreateSocialUser extends Job
{
    use DispatchesJobs;

    private $name;

    private $email;

    private $avatar;

    private $socialId;

    private $socialProvider;

    /**
     * CreateSocialUser constructor.
     * @param $name
     * @param $email
     * @param $avatar
     * @param $socialId
     * @param $socialProvider
     */
    public function __construct($name, $email, $avatar, $socialId, $socialProvider)
    {
        $this->name = $name;
        $this->email = $email;
        $this->avatar = $avatar;
        $this->socialId = $socialId;
        $this->socialProvider = $socialProvider;
    }


    public function handle()
    {
        if ($this->email == null) {
            $this->email = $this->socialId . '@' . $this->socialProvider . '.com';
        }

        if ($this->avatar != null) {
            switch ($this->socialProvider) {
                case 'facebook':
                    $this->avatar = str_replace('type=normal', 'type=large', $this->avatar);
                    break;
                case 'google':
                    $this->avatar = str_replace('sz=50', 'sz=128', $this->avatar);
                    break;
            }
        }

        $user = $this->dispatch(app(RegisterUser::class, [
            '',
            $this->name,
            $this->email,
            str_random(32),
            true
        ]));

        $user = $user->fill([
            'social_id' => $this->socialId,
            'social_name' => $this->socialProvider,
            'avatar' => $this->avatar
        ]);

        \UserRepo::add($user);

        $this->dispatch(new ConfirmUser($user));

//        $this->dispatch(app(SetDefaultRole::class, [$user->id]));

        return $user;
    }
}
