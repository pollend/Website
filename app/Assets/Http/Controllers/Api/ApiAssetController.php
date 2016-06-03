<?php


namespace PN\Assets\Http\Controllers\Api;


use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use League\Fractal\Serializer\ArraySerializer;
use PN\Assets\Transformers\AssetTransformer;
use PN\Foundation\Http\Controllers\Controller;

class ApiAssetController extends Controller
{
    public function index()
    {
        $fractal = new Manager();

        $assets = \AssetRepo::all();

        $resource = new Collection($assets, new AssetTransformer());

        $fractal->parseIncludes(request('include', []));

        return \Response::json($fractal->createData($resource)->toArray());
    }

    public function show($identifier)
    {
        $fractal = new Manager();

        $asset = \AssetRepo::findByIdentifier($identifier);

        $resource = new Item($asset, new AssetTransformer());

        $fractal->parseIncludes(request('include', []));

        return \Response::json($fractal->createData($resource)->toArray());
    }

    public function required()
    {
        $optionRepo = \OptionRepo::find('required_assets');

        $ids = explode(',', $optionRepo->value);

        return \Response::json(['data' => $ids]);
    }
}