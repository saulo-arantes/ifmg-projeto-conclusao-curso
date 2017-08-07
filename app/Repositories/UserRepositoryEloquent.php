<?php

namespace App\Repositories;

use App\Entities\ContactType;
use App\Entities\Log;
use App\Entities\User;
use App\Entities\UserContact;
use App\Presenters\UserPresenter;
use App\Validators\UserValidator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class UserRepositoryEloquent
 *
 * @package namespace App\Repositories;
 */
class UserRepositoryEloquent extends BaseRepository implements UserRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return User::class;
    }

    /**
     * Specify Validator class name
     *
     * @return mixed
     */
    public function validator()
    {

        return UserValidator::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * Specify Presenter class name
     *
     * @return string
     */
    public function presenter()
    {
        return UserPresenter::class;
    }

    /**
     * Change the user status.
     *
     * @param $userID
     */
    public function changeUserStatus($userID)
    {
        $user = User::find($userID);
        $user->status ? $user->update(['status' => false]) : $user->update(['status' => true]);

        Log::create([
            'type'        => Log::INFO,
            'user_id'     => Auth::user()->id,
            'description' => ('Alterou status do usuário ' . User::find($userID)->name . ' (ID: ' . $userID . ') para ' . ($user->status ? 'ATIVO' : 'INATIVO'))
        ]);
    }

    /**
     * Update the contacts of an user.
     *
     * @param $data
     * @param $id
     *
     * @return array|bool
     */
    public function updateContacts($data, $id)
    {
        if (!empty($data['contact_type_id']) && !empty($data['description'])) {

            # Check if user pass the same quantity of contacts and contact types
            if (count($data['contact_type_id']) == count($data['description'])) {

                $contacts = UserContact::where('user_id', $id)->get()->toArray();
                foreach ($contacts as $contact) {
                    UserContact::destroy($contact['id']);
                }

                $i = 0;
                foreach ($data['contact_type_id'] as $contact) {
                    if (!empty($data['description'][$i])) {
                        UserContact::create([
                            'user_id'         => $id,
                            'contact_type_id' => $contact,
                            'description'     => $data['description'][$i]
                        ]);
                    }
                    $i++;
                }

                return true;
            }

            return [
                'error'   => true,
                'message' => 'Adicione um contato'
            ];
        }

        return [
            'error'   => true,
            'message' => 'Adicione um contato'
        ];
    }

    /**
     * Upload a picture to use as avatar.
     *
     * @return array|string
     */
    public function uploadAvatar()
    {
        $input = Input::all();

        $rules = [
            'file' => 'mimes:jpeg,jpg,png|max:2048|dimensions:min_width=100,min_height=100,max_width=3000,max_height=3000',
        ];

        $validation = Validator::make($input, $rules);

        if ($validation->fails()) {
            return [
                'error'   => true,
                'message' => 'Imagem com dimensões ou tamanho inválido'
            ];
        }

        # Create image from file
        switch (strtolower($_FILES['file']['type'])) {
            case 'image/jpeg':
                $image = imagecreatefromjpeg($_FILES['file']['tmp_name']);
                break;
            case 'image/png':
                $image = imagecreatefrompng($_FILES['file']['tmp_name']);
                break;
            default:
                return [
                    'error'   => true,
                    'message' => 'Formato de imagem não suportado: ' . $_FILES['file']['type']
                ];
        }

        # Target dimensions
        $max_width = 256;
        $max_height = 256;

        # Get current dimensions
        $old_width = imagesx($image);
        $old_height = imagesy($image);

        # Calculate the scaling we need to do to fit the image inside our frame
        $scale = min($max_width / $old_width, $max_height / $old_height);

        # Get the new dimensions
        $new_width = ceil($scale * $old_width);
        $new_height = ceil($scale * $old_height);

        # Create new empty image
        $new = imagecreatetruecolor($new_width, $new_height);

        # Resize old image into new
        imagecopyresampled($new, $image,
            0, 0, 0, 0,
            $new_width, $new_height, $old_width, $old_height);

        # Catch the imagedata
        $imageName = md5(uniqid(time())) . '.jpg';
        $imagePath = 'uploads/' . $imageName;
        imagejpeg($new, $imagePath, 90);

        # Destroy resources
        imagedestroy($image);
        imagedestroy($new);

        return $imageName;
    }

    /**
     * @param null $id
     *
     * @return array
     */
    public function getExtraData($id = null): array
    {
        $extraData['contact_types'] = ContactType::all();

        return $extraData;
    }
}