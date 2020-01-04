<?php

namespace App;

use App\Notifications\NewUserNotification;
use Laravel\Cashier\Billable;
use Illuminate\Notifications\Notifiable;
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
    ];

    public static function getAdmins() {
        return User::where('type', 'admin')
            ->get();
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

    public static function adminReadableList() {
        $users = DB::table('users')
            ->join('states', function($join) {
                $join->on('users.status_id', '=', 'states.id');
            })
            ->where('users.type', 'user')
            ->select('users.name as name',
                    'users.surnames',
                    'users.email',
                    'users.program as preferences',
                    'users.industry as industries',
                    'users.study as studies',
                    'users.university as degrees',
                    'users.phone_number as phone',
                    'users.stripe_id as stripe',
                    'users.created_at',
                    'states.name as status')
            ->get();

        foreach ($users as $key => $user) {
            $date = new Carbon($user->created_at);
            $user->created_at = $date->diffForHumans();
        }

        return $users;
    }

    public function getStudies() {
        return json_decode($this->study);
    }

    public static function allOrderBy($field, $order) {
        User::all()
            ->orderBy($field, $order)
            ->get();
    }

    public function hasChineseStudies() {
        if (is_array($this->getStudies())) {
            return count($this->getStudies()) > 0;
        }
        return null;
    }
}
