<?php

namespace App\Providers;

use App\Models\User;
use App\Models\UserSocialAccountModel;


class SocialAccountServiceProvider
{


    public function createOrGetUser($providerObj, $providerName)
    {
//        var_dump($providerObj);die();
        $providerUser = $providerObj->user();

        $account = UserSocialAccountModel::whereProvider($providerName)
            ->whereProviderUserId($providerUser->getId())
            ->first();

        if ($account) {
            return $account->user;
        } else {
            $account = new UserSocialAccountModel([
                'provider_user_id' => $providerUser->getId(),
                'provider' => $providerName]);

            $user = User::whereEmail($providerUser->getEmail())->first();

            if (!$user) {
                $user = User::createBySocialProvider($providerUser);
            }

            $account->user()->associate($user);
            $account->save();

            return $user;

        }

    }
}
