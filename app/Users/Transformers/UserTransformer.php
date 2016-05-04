<?php


namespace PN\Users\Transformers;


use League\Fractal\TransformerAbstract;
use PN\Users\User;

class UserTransformer extends TransformerAbstract
{
    public function transform(User $user)
    {
        return [
            'identifier' => $user->identifier,
            'username' => $user->username
        ];
    }
}