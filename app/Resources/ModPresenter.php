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

    private function getLatestRelease()
    {
        return \Cache::remember(sprintf('resources.%s.version', $this->model->id), 10, function () {
            $client = new Client(new CachedHttpClient(array('cache_dir' => '/tmp/github-api-cache')));

            $client->authenticate(env('GITHUB_USER_TOKEN'), null, Client::AUTH_HTTP_TOKEN);

            $parts = explode('/', $this->model->source);

            $repo = array_pop($parts);
            $user = array_pop($parts);

            try {
                $release = $client->api('repo')->tags()->latest($user, $repo);
            } catch (RuntimeException $e) {
                return [];
            }

            return $release;
        });
    }

    public function isReleasable()
    {
        return true;
    }

    public function getVersion()
    {
        try {
            return $this->getLatestRelease()['tag_name'];
        } catch (\Exception $e) {
            \Log::error($e);

            return null;
        }
    }

    public function getReleaseDate()
    {
        try {
            return date('Y-m-d H:i:s', strtotime($this->getLatestRelease()['published_at']));
        } catch (\Exception $e) {
            \Log::error($e);

            return null;
        }
    }
}