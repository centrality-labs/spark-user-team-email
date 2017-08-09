<?php

namespace ZiNETHQ\SparkUserTeamEmail\Traits;

use Auth;

trait HasUserTeamEmail
{
    /**
     * Returns the email of this user on the given team, or null if not specified
     * @return String
     */
    public function emailOn($team_id)
    {
        // Note must be ID or we might get cyclical loading in some cases
        if (is_null($team_id)) {
            return null;
        }

        return $this->teams()->where('id', $team_id)->select('team_users.email')->pluck('pivot_email')->first();
    }

    /**
     * Returns the email of this user on their current team, or null if not specified
     * @return String
     */
    public function emailOnCurrentTeam()
    {
        return $this->emailOn($this->current_team_id);
    }

    /**
     * Returns the email of this user on the currently logged in user's current team, or null if not specified
     * @return String
     */
    public function emailOnMyCurrentTeam()
    {
        $user = Auth::user();
        if (!$user) {
            return null;
        }

        return $this->emailOn($user->current_team_id);
    }

    public function getEmailAttribute($value)
    {
        $default = config('sparkuserteamemail.default');
        switch ($default) {
            case 'user':
                // Do nothing to the user's email
                break;
            case 'my_team':
                return $this->emailOnMyCurrentTeam() ?: $value;
            case 'their_team':
                return $this->emailOnCurrentTeam() ?: $value;
        }
        return $value;
    }

    public function getTeamEmailsAttribute()
    {
        return $this->teams()->withPivot(['email'])->select(['id', 'email'])->pluck('pivot.email', 'id');
        // return $this->teams()->withPivot(['email'])->select(['team_users.email', 'team_users.team_id'])->pluck('team_users.email', 'team_users.team_id');
    }
}
