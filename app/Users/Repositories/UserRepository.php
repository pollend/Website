<?php

namespace PN\Users\Repositories;


use PN\Foundation\Repositories\BaseRepository;
use PN\Users\User;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return User::class;
    }

    public function findByEmail($email)
    {
        return $this->findByField('email', $email)->first();
    }

    public function validateCredentials($email, $password)
    {
        $user = $this->findWhere([
            'email' => $email
        ])->first();

        if($user != null) {
            return \Hash::check($password, $user->password);
        }

        return false;
    }

    public function findBySocial($id, $name, $email)
    {
        $user = $this->findWhere([
            'social' => $id,
            'social_name' => $name,
        ])->first();

        if($user == null) {
            $user = $this->findWhere([
                'email' => $email
            ])->first();
        }

        return $user;
    }
}
