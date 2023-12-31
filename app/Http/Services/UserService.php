<?php

namespace App\Http\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class UserService
{

    public function update(User $user, array $data): User
    {


        $user->update([
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

        return $user;
    }

    private function storeAvatar($avatarData) : ?string
    {
        if (!$avatarData) {
            return null;
        }
        $fileName = uniqid() . '.' . $avatarData->getClientOriginalExtension();
        $avatarPath = $avatarData->storeAs('avatars', $fileName);

        return $avatarPath;
    }
}


