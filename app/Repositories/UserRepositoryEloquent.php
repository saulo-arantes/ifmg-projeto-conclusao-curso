<?php

namespace App\Repositories;

use App\Entities\ContactType;
use App\Entities\Doctor;
use App\Entities\User;
use App\Entities\UserContact;
use App\Presenters\UserPresenter;
use App\Validators\UserValidator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Validator\Exceptions\ValidatorException;

/**
 * Class UserRepositoryEloquent
 *
 * @author Saulo Vinícius
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
		$user = (new User)->find($userID);
		$user->status ? $user->update(['status' => false]) : $user->update(['status' => true]);

	}

	/**
	 * Update the contacts of an user.
	 *
	 * @param $data
	 * @param $id
	 *
	 * @return bool
	 * @throws ValidatorException
	 */
	public function updateContacts($data, $id)
	{
		if ($this->contactExists($data)) {

			# Check if user pass the same quantity of contacts and contact types
			if (count($data['contact_type_id']) == count($data['description'])) {

				$contacts = (new UserContact)->where('user_id', $id)->get()->toArray();
				foreach ($contacts as $contact) {
					UserContact::destroy($contact['id']);
				}

				$i = 0;
				foreach ($data['contact_type_id'] as $contact) {
					if (!empty($data['description'][ $i ])) {
						(new UserContact)->create([
							'user_id'         => $id,
							'contact_type_id' => $contact,
							'description'     => $data['description'][ $i ]
						]);
					}
					$i ++;
				}

				return true;
			}

		}

		throw new ValidatorException(new MessageBag(['Adicione um contato.']));
	}

	private function contactExists(array $data)
	{
		if (!empty($data['contact_type_id'][0]) && !empty($data['description'][0])) {
			if (!is_null($data['contact_type_id'][0]) && !is_null($data['description'][0])) {

				return true;
			}
		}

		return false;
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
		$max_width  = 256;
		$max_height = 256;

		# Get current dimensions
		$old_width  = imagesx($image);
		$old_height = imagesy($image);

		# Calculate the scaling we need to do to fit the image inside our frame
		$scale = min($max_width / $old_width, $max_height / $old_height);

		# Get the new dimensions
		$new_width  = ceil($scale * $old_width);
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

		$extraData['doctor'] = Doctor::where('user_id', Auth::user()->id)->get()->toArray();

		return $extraData;
	}

	/**
	 * Generate a random password for the new user registered.
	 *
	 * @param int $length
	 * @param int $strong
	 *
	 * @return string
	 */
	public function generatePassword($length = 8, $strong = 0)
	{
		$vogals    = 'aeiou';
		$consoants = 'bdghjmnpqrstvz';

		if ($strong >= 1) {
			$consoants .= 'BDGHJLMNPQRSTVWXZ';
		}

		if ($strong >= 2) {
			$vogals .= "AEIOU";
		}

		if ($strong >= 4) {
			$consoants .= '23456789';
		}

		if ($strong >= 8) {
			$vogals .= '@#$%';
		}

		$password = '';
		$alt      = time() % 2;
		for ($i = 0; $i < $length; $i ++) {
			if ($alt == 1) {
				$password .= $consoants[ (rand() % strlen($consoants)) ];
				$alt      = 0;
			} else {
				$password .= $vogals[ (rand() % strlen($vogals)) ];
				$alt      = 1;
			}
		}

		return $password;
	}
}