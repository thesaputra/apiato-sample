<?php

namespace App\Containers\User\Actions;

use Apiato\Core\Foundation\Facades\Apiato;
use App\Containers\User\Events\UserRegisteredEvent;
use App\Containers\User\Mails\UserRegisteredMail;
use App\Containers\User\Models\User;
use App\Containers\User\Notifications\UserRegisteredNotification;
use App\Ship\Parents\Actions\Action;
use App\Ship\Transporters\DataTransporter;
use Illuminate\Contracts\Bus\Dispatcher;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

/**
 * Class RegisterUserAction.
 *
 * @author Mahmoud Zalt <mahmoud@zalt.me>
 */
class RegisterUserAction extends Action
{

    /**
     * @param \App\Ship\Transporters\DataTransporter $data
     *
     * @return  \App\Containers\User\Models\User
     */
    public function run(DataTransporter $data, $role_id, $user_type): User
    {
        $assignRoles = [];
        if ($user_type == 'admin')
        {
            $user = Apiato::call('User@CreateUserByCredentialsTask', [
                $data->email,
                $data->password,
                $data->name,
                $data->gender,
                $data->birth,
                $isClient = true
            ]);
        }
        

        $assignRole = Apiato::call('Authorization@FindRoleTask', [$role_id]);
        array_push($assignRoles, $assignRole);
        
        $user = Apiato::call('Authorization@AssignUserToRoleTask', [$user, $assignRoles]);

        // Mail::send(new UserRegisteredMail($user));

        // Notification::send($user, new UserRegisteredNotification($user));

        App::make(Dispatcher::class)->dispatch(New UserRegisteredEvent($user));

        return $user;
    }
}
