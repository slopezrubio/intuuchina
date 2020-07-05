<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    protected $collectables = ['users', 'testimonials', 'offers', 'fees'];
    protected $current = null;

    use ResetsPasswords;

    const ADMIN_ELEMENTS_PER_PAGE = 9;

    public function index(Request $request) {
        $collections = $this->getCollectables($request);

        if ($request->ajax()) {
            $show_method = 'show' . Str::studly($this->requestedCollection());

            return $this->$show_method($collections[$this->requestedCollection()]);
        }

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

            $collectionClass = $this->getCollectionClass($collectable);
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

                if (method_exists($collection, 'hasFilter')) {
                    if ($collection->hasFilter()) {
                        $currentPage = null;

                        $collections[$collectable] = $collection->filterBy('status', $request->query('filter'))
                                                                ->paginate(self::ADMIN_ELEMENTS_PER_PAGE, null, $currentPage)
                                                                ->setPath(route('admin.' . $collectable))
                                                                ->appends('filter', request()->query('filter'));

                    }
                }
            };
        }

        return $collections;
    }

    public function showUsers($collection) {
        return response()->json(view('components.accordion-list', [
            'id' => 'users',
            'info' => trans_choice('messages.items found', $collection->total(), ['value' => $collection->total(), 'name' => $collection->total() > 1 ? Str::plural('user') : 'user']),
            'items' => $collection,
            'body' => 'partials.forms.admin._users-list',
            'pagination' => $collection->links('vendor.pagination.semantic-ui')
        ])->render());
    }

    public function showChangePasswordForm() {
        return view('auth.passwords.change');
    }

    private function getCollectionClass($collectable) {
        return 'App\\' . ucfirst($collectable) . 'Collection';
    }

    private function isCollectionRequested($name) {
        return $this->requestedCollection() === $name;
    }

    private function requestedCollection() {
        return request()->segment(count(request()->segments()));
    }
}
