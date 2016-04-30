<?php

namespace PN\Forum\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use PN\Forum\Events\UserViewingCategory;
use PN\Forum\Events\UserViewingIndex;
use PN\Forum\Forum;

class CategoryController extends BaseController
{
    /**
     * GET: Return an index of categories view (the forum index).
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = $this->api('category.index');

        $categories = $categories->parameters(['where' => ['category_id' => 0], 'orderBy' => 'weight', 'with' => ['children']]);

        $categories = $categories->get();

        event(new UserViewingIndex);

        return view('forum.category.index', compact('categories'));
    }

    /**
     * GET: Return a category view.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $category = $this->api('category.fetch', $request->route('category'))->get();

        event(new UserViewingCategory($category));

        $categories = [];
        if (Gate::allows('moveCategories')) {
            $categories = $this->api('category.index')->parameters(['where' => ['category_id' => 0]])->get();
        }

        return view('forum.category.show', compact('categories', 'category', 'threads'));
    }

    /**
     * POST: Store a new category.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $category = $this->api('category.store')->parameters($request->all())->post();

        Forum::alert('success', 'categories.created');

        return redirect($category->route);
    }

    /**
     * PATCH: Update a category.
     *
     * @param  int  $id
     * @param  Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id, Request $request)
    {
        $action = $request->input('action');

        $category = $this->api("category.{$action}", $id)->parameters($request->all())->patch();

        Forum::alert('success', 'categories.updated', 1);

        return redirect($category->route);
    }

    /**
     * DELETE: Delete a category.
     *
     * @param  int  $id
     * @param  Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id, Request $request)
    {
        $this->api('category.delete', $id)->parameters($request->all())->delete();

        Forum::alert('success', 'categories.deleted', 1);

        return redirect(config('forum.routing.root'));
    }
}
