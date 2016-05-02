<?php


namespace PN\Social\Listeners;


use Illuminate\Support\Collection;

class MentionScanner
{
    protected function getUsers(string $text)
    {
        $users = new Collection();

        // find all mention syntaxes
        preg_match_all('/[\@]([a-zA-Z0-9-]+)/', $text, $mentions);

        foreach ($mentions[1] as $username) {
            try {
                $user = \UserRepo::findByUsername($username);

                $users->push($user);
            } catch (\Exception $e) {
                //ignore
            }
        }

        return $users;
    }
}