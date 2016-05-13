<?php


namespace PN\Resources;


use Carbon\Carbon;
use Github\Client;
use Github\Exception\RuntimeException;
use Github\HttpClient\CachedHttpClient;
use PN\Foundation\Presenters\Presenter;

class ModPresenter extends Presenter implements ResourcePresenterInterface
{
    public function getStatGroups()
    {
        return [];
    }

    private function getLatestTag()
    {
        return \Cache::remember(sprintf('resources.%s.version', $this->model->id), 10, function () {
            $client = new Client(new CachedHttpClient(array('cache_dir' => '/tmp/github-api-cache')));

            $client->authenticate(env('GITHUB_USER_TOKEN'), null, Client::AUTH_HTTP_TOKEN);

            $parts = explode('/', $this->model->source);

            $repo = array_pop($parts);
            $user = array_pop($parts);

            try {
                $tags = $client->api('repo')->tags($user, $repo);

                $tag = array_shift($tags);
            } catch (\Exception $e) {
                return [];
            }

            return $tag;
        });
    }

    public function isReleasable()
    {
        return true;
    }

    public function getVersion()
    {
        try {
            return $this->getLatestTag()['name'];
        } catch (\Exception $e) {
            \Log::error($e);

            return null;
        }
    }

    public function getZipBallUrl()
    {
        try {
            return $this->getLatestTag()['zipball_url'];
        } catch (\Exception $e) {
            \Log::error($e);

            return null;
        }
    }
}