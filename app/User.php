<?php

namespace App;

use Laravel\Cashier\Billable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Carbon\Carbon;
use Carbon\Translator;

class User extends Authenticatable
{
    use Notifiable;

    use Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'surnames', 'email','phone_number', 'type', 'nationality', 'status_id', 'program', 'industry', 'study', 'password',
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

    public function updateStatus(string $status) {
        $first = DB::table('states')
            ->where('states.name', $status)->value('id');

        DB::table('users')
            ->where('id', $this->id)
            ->update(['status_id' => $first]);

        return User::find($this->id);
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

    public static function allOrderBy($field, $order) {
        User::all()
            ->orderBy($field, $order)
            ->get();
    }
}
