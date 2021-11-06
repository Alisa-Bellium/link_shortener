<?php

namespace App\Http\Controllers;

use App\Http\Requests\LinksRequest;
use App\Models\Link;
use App\Service\LinkService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

/**
 *
 */
class MainController extends Controller
{

    /**
     * @return Application|Factory|View
     */
    public function show()
    {
        return view('index');
    }

    /**
     * @param LinksRequest $request
     * @param LinkService $service
     * @return RedirectResponse
     */
    public function send(LinksRequest $request, LinkService $service): RedirectResponse
    {
        $url = $request->input('url');
        $urlPrefix = $service->getLinkPrefixGenerate();

        $link = Link::query()->create([
            'source_link' => $url,
            'link_key' => $urlPrefix
        ]);

        return back()->with('success', route('links.away', ['prefix' => $urlPrefix]));

    }

    /**
     * @param string $prefix
     * @return RedirectResponse|void
     */
    public function away(string $prefix)
    {
        $link = Link::query()->where(['link_key' => $prefix])->firstOrFail();

        return redirect()->away($link->source_link);
    }
}
