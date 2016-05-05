<?php


namespace PN\Client\Http\Controllers;


use PN\Client\Jobs\RegisterLog;
use PN\Foundation\Http\Controllers\Controller;

class ClientController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateWin()
    {
        $this->dispatch(new RegisterLog(\Request::getClientIp(), 'check', \Request::header('X-ParkitectNexusInstaller-Version', '0')));

        return \Response::json([
            'version' => getenv('WIN_CLIENT_VERSION'),
            'download_url' => route('client.downloadwin')
        ]);
    }
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateOsx()
    {
        $this->dispatch(new RegisterLog(\Request::getClientIp(), 'check', \Request::header('X-ParkitectNexusInstaller-Version', '0')));

        return \Response::json([
            'version' => getenv('OSX_CLIENT_VERSION'),
            'download_url' => route('client.downloadosx')
        ]);
    }
    /**
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function downloadWin()
    {
        // check if the request is coming from the client with this header
        if (\Request::header('X-ParkitectNexusInstaller-Version', false) != false || !isset($_SERVER['HTTP_USER_AGENT'])) {
            $this->dispatch(new RegisterLog(\Request::getClientIp(), 'update', \Request::header('X-ParkitectNexusInstaller-Version', '1.0.0.0')));

            // client wants an uncompressed installer
            return \Response::download(storage_path('client/parkitectnexus-client-' . getenv('WIN_CLIENT_VERSION') . '.msi'));
        } else {
            $this->dispatch(new RegisterLog(\Request::getClientIp(), 'download', ''));

            \Log::info('Client download!');

            return \Response::download(storage_path('client/zips/parkitectnexus-client-' . getenv('WIN_CLIENT_VERSION') . '.rar'),
                'parkitectnexus-client.rar');
        }
    }
    /**
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function downloadOsx()
    {
        // check if the request is coming from the client with this header
        if (\Request::header('X-ParkitectNexusInstaller-Version', false) != false || !isset($_SERVER['HTTP_USER_AGENT'])) {
            $this->dispatch(new RegisterLog(\Request::getClientIp(), 'update', \Request::header('X-ParkitectNexusInstaller-Version', '1.0.0.0')));
        } else {
            $this->dispatch(new RegisterLog(\Request::getClientIp(), 'download', ''));
        }

        return \Response::download(storage_path('client/parkitectnexus-client-' . getenv('OSX_CLIENT_VERSION') . '.dmg'));
    }
    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function downloadPage()
    {
        $page = \PageRepo::find('client');

        $view = 'client.clientwin';

        if(\Agent::is('OS X')){
            $view = 'client.clientosx';
        }

        return view($view, compact('page'));
    }
    /**
     * @param $username
     * @param $repo
     * @return \Illuminate\Http\RedirectResponse
     */
    public function redirect($username, $repo)
    {
        $mod = \ResourceRepo::findMod($username, $repo);

        if ($mod != null) {
            return \Redirect::to(route('asset.detail', [$mod->getAsset()->identifier, $mod->getAsset()->slug], true));
        }

        abort(404);
    }
}
