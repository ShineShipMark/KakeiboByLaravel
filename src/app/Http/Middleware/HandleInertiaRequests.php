<?php

namespace App\Http\Middleware;

use App\Data\Category\CategoryResponseData;
use App\Models\Category;
use Illuminate\Foundation\Inspiring;
use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        return array_merge(parent::share($request), [
            'auth' => [
                'user' => $request->user(),
            ],
            // ★ここで渡した値が、Vue側の usePage().props に自動的にセットされます
            'categories' => fn () => CategoryResponseData::collect(
                    Category::with('children')->whereNull('parent_id')->get()
                ),
            'flash' => [
                'message' => fn () => $request->session()->get('message'),
            ],
        ]);
    
    }
}
