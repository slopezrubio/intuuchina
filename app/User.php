<?php

namespace App;

use App\Notifications\CustomContentNotification;
use App\Notifications\NewUserNotification;
use App\Notifications\PaymentReminderNotification;
use App\Notifications\ResetPasswordNotification;
use Carbon\CarbonInterface;
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

    const YEAR_TO_STOP_REMINDER = 3;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'id', 'name', 'surnames', 'email','phone_number', 'type', 'cv', 'nationality', 'status_id', 'program_id', 'password', 'api_token',
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

    /**
     * Model Events
     */
    protected static function boot() {
        parent::boot();

        static::saving(function($model) {
            $model->saveUploadables()
                    ->savePhoneNumber();
        });

        static::deleting(function($model) {
            $model->categories()->detach();
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

                if ($this->program->value !== 'study') {
                    $this->$value = $this->saveFileToProfile(request()->file($value));
                }
            }

//            if (request()->file($value) === null && $this->$value === null) {
//                $this->$value = Storage::putFile($this->profilePath(), new UploadedFile(storage_path('app/profiles/default_' . $value . '.docx')));
//            }
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

    /**
     * Get all the administrator users
     *
     * @return mixed
     */
    public static function admins() {
        return User::where('type', 'admin')
            ->get();
    }

    public function getFormattedPhoneNumber() {
        return '(' . __('prefixes.' . $this->phone_number['prefix'] . '.prefix') . ')' . $this->phone_number['number'];
    }

    /**
     * Sends the email verification notification.
     */
    public function sendEmailVerificationNotification() {
        $this->notify(new NewUserNotification($this));
    }

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    public function sendPaymentReminderNotification() {
        $reminder = '';

        // 2 days ago
        if ($this->email_verified_at->diffInHours(Carbon::now()->subDays(2), false) >= 0 && $this->email_verified_at->diffInHours(Carbon::now()->subDays(2), false) < 24) {
            $reminder = $this->email_verified_at->diffForHumans(null, CarbonInterface::DIFF_ABSOLUTE) === '2 days'
                ? $this->email_verified_at->diffForHumans(null, CarbonInterface::DIFF_ABSOLUTE) : '';
            var_dump($reminder);
        };

        // 1 week ago
        if ($this->email_verified_at->diffInHours(Carbon::now()->subDays(7), false) >= 0 && $this->email_verified_at->diffInHours(Carbon::now()->subDays(7), false) < 24) {
            $reminder = $this->email_verified_at->diffForHumans(null, CarbonInterface::DIFF_ABSOLUTE) === '1 week'
                ? $this->email_verified_at->diffForHumans(null, CarbonInterface::DIFF_ABSOLUTE) : '';
        };

        // 2 weeks ago
        if ($this->email_verified_at->diffInHours(Carbon::now()->subDays(14), false) >= 0 && $this->email_verified_at->diffInHours(Carbon::now()->subDays(14), false) < 24) {
            $reminder = $this->email_verified_at->diffForHumans(null, CarbonInterface::DIFF_ABSOLUTE) === '2 weeks'
                ? $this->email_verified_at->diffForHumans(null, CarbonInterface::DIFF_ABSOLUTE) : '';
        };

        // 1 months ago
        if ($this->email_verified_at->diffInHours(Carbon::now()->subMonths(1), false) >= 0 && $this->email_verified_at->diffInHours(Carbon::now()->subMonths(1), false) < 24) {
            $reminder = $this->email_verified_at->diffForHumans(null, CarbonInterface::DIFF_ABSOLUTE) === '1 month'
                ? $this->email_verified_at->diffForHumans(null, CarbonInterface::DIFF_ABSOLUTE) : '';
        };

        // 3 months ago
        if ($this->email_verified_at->diffInHours(Carbon::now()->subMonths(3), false) >= 0 && $this->email_verified_at->diffInHours(Carbon::now()->subMonths(3), false) < 24) {
            $reminder = $this->email_verified_at->diffForHumans(null, CarbonInterface::DIFF_ABSOLUTE) === '3 months'
                ? $this->email_verified_at->diffForHumans(null, CarbonInterface::DIFF_ABSOLUTE) : '';
        };

        // Every single year
        for ($y = 1; $y <= self::YEAR_TO_STOP_REMINDER && $reminder === ''; $y++) {
            if ($this->email_verified_at->diffInHours(Carbon::now()->subYears($y), false) >= 0 && $this->email_verified_at->diffInHours(Carbon::now()->subYears($y), false) < 24) {
                $reminder = $this->email_verified_at->diffForHumans(null, CarbonInterface::DIFF_ABSOLUTE) === $y .' year' || $this->email_verified_at->diffForHumans(null, CarbonInterface::DIFF_ABSOLUTE) === $y .' years'
                    ? $this->email_verified_at->diffForHumans(null, CarbonInterface::DIFF_ABSOLUTE) : '';
            }
        };

        if ($reminder !== '') {
            $this->notify(new PaymentReminderNotification($reminder, $this));
        }
    }

    /**
     * Send a notification to the user reporting about the changes in his application. This is
     * usually used by the administrator whenever an upgrade is made it.
     *
     * @param $content
     * @param $attachments
     */
    public function sendUserUpgradeNotification($content, $attachments) {
        $this->notify(new CustomContentNotification($content, $attachments));
    }

    /**
     * Update the user with the given attributes and options. Overwrites the ones provided by
     * the application in @see Illuminate\Database\Eloquent\Model class.
     *
     * @param array $attributes
     * @param array $options
     * @return bool
     */
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

        return $this->fill($attributes)->save($options);
    }

    /**
     * Add a new preference according to the type specified (industry, study, or university) by the user.
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

    /**
     * Get the first category chosen by the user.
     *
     * @return mixed
     */
    public function getFirstCategory() {
        if ($this->categories->count() > 0) {
            return $this->categories->first();
        }

        return $this->program->categories->first();
    }

    /**
     * Get the last user to be recorded in the database.
     *
     * @return mixed
     */
    public static function getLastUserCreated() {
        return DB::table('users')
            ->orderByDesc('id')
            ->get()->first();
    }

    /**
     * Get the profile folder of the user.
     *
     * @return string
     */
    public function profilePath() {
        return 'profiles/' . $this->id;
    }

    /**
     * Save the given file to the user's profile folder.
     *
     * @param $file
     * @return |null
     */
    public function saveFileToProfile($file) {
        if ($file !== null) {
            return $file->store($this->profilePath());
        }

        return null;
    }


    /**
     * Remove the user's profile folder and its content.
     *
     * @return $this
     */
    public function destroyAssociatedFiles() {
        if (Storage::exists('profiles/' . $this->id)) {
            Storage::deleteDirectory('profiles/' . $this->id);
        }

        if (Storage::exists('public/profiles/' . $this->id)) {
            Storage::deleteDirectory('public/profiles/' . $this->id);
        }

        return $this;
    }

    /**
     * Format a phone number provided in the form of an array containing the prefix and the number in
     * the international standardized E.164 number format.
     *
     * @param array $phone_number
     * @return string
     */
    public static function e164NumberFormat(array $phone_number) {
        return __('prefixes.' . $phone_number['prefix'] . '.prefix') . $phone_number['number'];
    }

    /**
     * Get all the user ordered by the provided field.
     *
     * @param $field
     * @param $order
     */
    public static function allOrderBy($field, $order) {
        User::all()
            ->orderBy($field, $order)
            ->get();
    }
}
