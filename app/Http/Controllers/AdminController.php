<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    protected $collectables = ['users', 'testimonials', 'offers', 'fees'];
    protected $current = null;

    const ADMIN_ELEMENTS_PER_PAGE = 5;

    public function index(Request $request) {
        $collections = $this->getCollectables($request);

        return view('pages.admin.dashboard', [
            'data' => $collections,
            'selected' => $this->current
        ]);
    }

    public function getCollectables(Request $request) {
        $collections = [];

        foreach($this->collectables as $key => $collectable) {
            $currentPage = $this->isCollectionRequested($collectable)
                            ? $request->query('page')
                            : 1;

            $collectionClass = 'App\\' . ucfirst($collectable) . 'Collection';
            $collection = new $collectionClass([], 'admin');

            $collections[$collectable] = $collection->paginate(self::ADMIN_ELEMENTS_PER_PAGE, null, $currentPage)->withPath(route('admin.' . $collectable));

            if ($this->isCollectionRequested($collectable)) {
                $this->current = $collectable;
                $currentPage = $request->query('page');

                if (method_exists($collection, 'hasSearchKeys')) {
                    if ($collection->hasSearchKeys()) {
                        $currentPage = null;

                        $collections[$collectable] = $collection->match()
                                                        ->paginate(self::ADMIN_ELEMENTS_PER_PAGE, null, $currentPage)
                                                        ->setPath(route('admin.' . $collectable))
                                                        ->appends('search', request()->query('search'));
                    }
                }
            };
        }

        return $collections;
    }

    private function isCollectionRequested($name) {
        return request()->segment(count(request()->segments())) === $name;
    }
}
