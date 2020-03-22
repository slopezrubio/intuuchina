<?php

namespace App;

use App\Notifications\NewUserNotification;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
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
        'name', 'surnames', 'email','phone_number', 'type', 'cv', 'nationality', 'status_id', 'program', 'industry', 'study', 'university', 'password', 'api_token',
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
        'industry' => 'array',
        'phone_number' => 'array',
        'study' => 'array',
        'university' => 'array',
    ];

    public static function getAdmins() {
        return User::where('type', 'admin')
            ->get();
    }

    public function getCurrentStatus() {
        return DB::table('users')
            ->where('users.id', $this->id)
            ->join('states', 'users.status_id', '=', 'states.id')
            ->select('states.*')
            ->first();
    }

    public function updateStatus(string $status) {
        $first = DB::table('states')
            ->where('states.name', $status)->value('id');

        DB::table('users')
            ->where('id', $this->id)
            ->update(['status_id' => $first]);

        return User::find($this->id);
    }

    public function sendEmailVerificationNotification() {
        $this->notify(new NewUserNotification());
    }

    public function update(array $fields = [], array $options = []) {
        User::where('id', $this->id)
            ->update($fields);
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

    public static function getLastUserCreated() {
        return DB::table('users')
            ->orderByDesc('id')
            ->get()->first();
    }

    public function getPrefixedPhoneNumber() {
        return '(' . __('prefixes.' . $this->phone_number['prefix'] . '.prefix') . ')' . $this->phone_number['number'];
    }

    public function destroyAssociatedFiles() {
        if (file_exists(Storage::url('profile/' . $this->id))) {
            File::deleteDirectory(Storage::url('profile/' . $this->id));
        }

        return $this;
    }

    public static function setCompletePhoneNumber($collection = null) {
        if ($collection !== null) {
            foreach ($collection as $value) {
                $value->phone_number = '(' . __('prefixes.' . json_decode($value->phone_number)->prefix . '.prefix') . ')'. json_decode($value->phone_number)->number;
            }
        }

        return $collection;
    }

    public function getIndustries() {
        return json_decode($this->industry);
    }

    public static function allOrderBy($field, $order) {
        User::all()
            ->orderBy($field, $order)
            ->get();
    }

    public function hasChineseStudies() {
        return count($this->study) > 0;
    }
}
