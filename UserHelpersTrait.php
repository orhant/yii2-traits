<?php

/**
 * @copyright Copyright &copy; Gogodigital Srls
 * @company Gogodigital Srls - Wide ICT Solutions
 * @website http://www.gogodigital.it
 * @github https://github.com/cinghie/yii2-traits
 * @license GNU GENERAL PUBLIC LICENSE VERSION 3
 * @package yii2-traits
 * @version 0.1.0
 */

namespace cinghie\traits;

use Yii;
use dektrium\user\models\User;

/**
 * Trait UserHelperTrait
 */
trait UserHelpersTrait
{

    /**
     * Get the User by user email
     *
     * @internal param string $email
     * @return User[] array
     */
    public function getUserByEmail()
    {
        $user = User::find()
            ->select(['*'])
            ->where(['email' => $this->email])
            ->one();

        return $user;
    }

    /**
     * Return an array with current User
     *
     * @internal param User $currentUser
     * @return array
     */
    public function getCurrentUserSelect2()
    {
        /** @var User $currentUser */
        $currentUser = Yii::$app->user->identity;

        return [$currentUser->id => $currentUser->username];
    }

    /**
     * Return an array with the User's Roles adding "Public" on first position
     *
     * @return array
     */
    public function getRolesSelect2()
    {
        $roles = Yii::$app->authManager->getRoles();
        $array = ['public' => Yii::t('traits', 'Public')];

        foreach($roles as $role) {
            $array[ucwords($role->name)] = ucwords($role->name);
        }

        return $array;
    }

    /**
     * Return array with all Users (not blocked or not unconfirmed), adding current User on first position [ 'user_id' => 'username' ]
     *
     * @param int  $user_id
     * @param string $username
     * @return array
     */
    public function getUsersSelect2($user_id,$username)
    {
        $users = User::find()
            ->select(['id','username'])
            ->where(['blocked_at' => null, 'unconfirmed_email' => null])
            ->andWhere(['!=', 'id', $user_id])
            ->all();

        $array[$user_id] = ucwords($username);

        foreach($users as $user) {
            $array[$user['id']] = ucwords($user['username']);
        }

        return $array;
    }

}
