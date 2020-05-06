<?php

namespace App;

use App\Notifications\NewUserNotification;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use Illuminate\Http\File as UploadedFile;
use Illuminate\Support\Facades\Storage;
use Laravel\Cashier\Billable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Auth\MustVerifyEmail as VerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Carbon\Carbon;
use Carbon\Translator;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    use VerifyEmail;
    use Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'id', 'name', 'surnames', 'email','phone_number', 'type', 'cv', 'nationality', 'status_id', 'program_id', /*'industry', 'study', 'university'*/ 'password', 'api_token',
    ];

    /**
     * The attributes that are uploadables.
     */
    protected $uploadable = [
        'cv'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'current_password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'phone_number' => 'array',
    ];

    protected static function boot() {
        parent::boot();

        static::saving(function($model) {
            $model->saveUploadables()
                    ->savePhoneNumber();
        });
    }

    public function categories() {
        return $this->belongsToMany('App\Category');
    }

    public function status() {
        return $this->belongsTo('App\Status');
    }

    public function program() {
        return $this->belongsTo('App\Program');
    }

    /**
     * Save all the files belonging to the uploadable fields.
     *
     * @return $this
     */
    public function saveUploadables() {
        foreach ($this->uploadable as $value) {
            if (request()->file($value) !== null) {

                if (Storage::exists($this->$value)) {
                    Storage::delete($this->$value);
                }

                $this->$value = $this->saveFileToProfile(request()->file($value));
            }

            if (request()->file($value) === null && $this->$value === null) {
                $this->$value = Storage::putFile($this->profilePath(), new UploadedFile(storage_path('app/profiles/default_' . $value . '.docx')));
            }
        }

        return $this;
    }

    public function savePhoneNumber() {
        if (request()->get('phone_number') !== null && request()->get('phone_number')) {
            $this->phone_number = [
                'prefix' => request()->get('prefix'),
                'number' => request()->get('phone_number'),
            ];
        }

        return $this;
    }

    public static function admins() {
        return User::where('type', 'admin')
            ->get();
    }

    public function getFormattedPhoneNumber() {
        return '(' . __('prefixes.' . $this->phone_number['prefix'] . '.prefix') . ')' . $this->phone_number['number'];
    }

    public function sendEmailVerificationNotification() {
        $this->notify(new NewUserNotification($this));
    }

    public function update(array $attributes = [], array $options = []) {
        if (isset($attributes['categories'])) {
            $categories = [];

            foreach ($attributes['categories'] as $key => $category) {
                foreach (Category::find($category)->programs as $program) {
                    if ($program->is(Program::find($attributes['program_id']))) {
                        array_push($categories, $category);
                    }
                }
            }

            $this->categories()->sync($categories);
        }

        $this->fill($attributes)->save($options);
    }

    /**
     * Adds a new preference according to the type
     * specified (industry, study, or university) by the user.
     * If the given preference already exist, nothing gets updated.
     *
     * @param $type
     * @param $preference
     */
    public function addPreference($type, $preference) {
        // Creates an array with the current users preferences.
        $preferences = json_decode(User::where('id', $this->id)->get()[0]->{$type}) !== null
                        ? json_decode(User::where('id', $this->id)->get()[0]->{$type})
                        : [];

        if (array_search($preference, $preferences) === false) {
            array_unshift($preferences, $preference);
            $this->update([$type => json_encode($preferences)]);
        }
    }

    public function getFirstCategory() {
        if ($this->categories->count() > 0) {
            return $this->categories->first();
        }

        return $this->program->categories->first();
    }

    public static function getLastUserCreated() {
        return DB::table('users')
            ->orderByDesc('id')
            ->get()->first();
    }

    public function profilePath() {
        return 'profiles/' . $this->id;
    }

    public function saveFileToProfile($file) {
        if ($file !== null) {
            return $file->store($this->profilePath());
        }

        return null;
    }

    public function destroyAssociatedFiles() {
        if (file_exists(Storage::url('profile/' . $this->id))) {
            File::deleteDirectory(Storage::url('profile/' . $this->id));
        }

        return $this;
    }

    public static function e164NumberFormat(array $phone_number) {
        return __('prefixes.' . $phone_number['prefix'] . '.prefix') . $phone_number['number'];
    }

    public static function allOrderBy($field, $order) {
        User::all()
            ->orderBy($field, $order)
            ->get();
    }

    public function hasChineseStudies() {
        if ($this->study !== null) {
            return count($this->study) > 0;
        }

        return $this->study;
    }
}
