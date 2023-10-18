<?php

namespace App\Http\Services;

use App\Jobs\SendEmailJob;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use PhpParser\Node\Stmt\DeclareDeclare;

class AuthService {


    public function authenticate(array $data) : User {

        $user = User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'patronymic' => $data['patronymic'],
            'gender' => $data['gender'],
            'avatar_img' => $this->storeAvatar($data['avatar_img']),
            'login' => $data['login'],
            'password' => Hash::make($data['password']),
            'email' => $data['email'],
            'birth_date' => $data['birth_date']
        ]);

       SendEmailJob::dispatch($user);

        return $user;

    }

    private function storeAvatar($avatarData)
    {
        if (!$avatarData) {
            return null;
        }
        $fileName = uniqid() . '.' . $avatarData->getClientOriginalExtension();
        $avatarPath = $avatarData->storeAs('avatars', $fileName);

        return $avatarPath;
    }



    public function login(array $data) : ?User {
        if (Auth::attempt(['login' => $data['login'], 'password' => $data['password']])) {
           return User::findByLogin($data['login']);
        }
        return null;
    }

}
