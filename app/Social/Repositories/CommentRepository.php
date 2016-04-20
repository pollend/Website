<?php


namespace PN\Social\Repositories;


use PN\Assets\Asset;
use PN\Foundation\Repositories\BaseRepository;
use PN\Social\Comment;

class CommentRepository extends BaseRepository implements CommentRepositoryInterface
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Comment::class;
    }

    public function add($entity)
    {
        $entity->save();

        \Cache::put('comments.'.$entity->id, $entity, 3600);
        \Cache::forget('comments.assets.'.$entity->asset_id);
    }

    public function edit($entity)
    {
        $entity->save();

        \Cache::put('comments.'.$entity->id, $entity, 3600);
        \Cache::forget('comments.assets.'.$entity->asset_id);
    }

    public function remove($entity)
    {
        $entity->delete();

        \Cache::forget('comments.'.$entity->id);
        \Cache::forget('comments.assets.'.$entity->asset_id);
    }

    /**
     * Gets all comments paginated & sorted descending for given asset
     *
     * @param Asset $asset
     * @return mixed
     */
    public function forAsset(Asset $asset)
    {
        return \Cache::remember('comments.assets.'.$asset->id, 3600, function() use ($asset) {
            return Comment::where('asset_id', $asset->id)
                ->orderBy('created_at', 'desc')
                ->paginate(10);
        });
    }
}