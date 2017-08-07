<?php

namespace App\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface UserRepository
 *
 * @author Saulo Vinícius
 * @package namespace App\Repositories;
 */
interface UserRepository extends RepositoryInterface
{
    /**
     * Change the user status.
     *
     * @param $userID
     */
    public function changeUserStatus($userID);

    /**
     * Update the contacts of an user.
     *
     * @param $data
     * @param $id
     *
     * @return array|bool
     */
    public function updateContacts($data, $id);

    /**
     * Upload a picture to use as avatar.
     *
     * @return array|string
     */
    public function uploadAvatar();

    /**
     * @param null $id
     *
     * @return array
     */
    public function getExtraData($id = null): array;
}