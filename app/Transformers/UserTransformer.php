<?php

namespace App\Transformers;

use App\Entities\User;
use League\Fractal\TransformerAbstract;

/**
 * Class LogTransformer
 *
 * @author  Saulo Vinícius
 * @package namespace App\Transformers;
 */
class UserTransformer extends TransformerAbstract
{

    protected $defaultIncludes = ['user'];

    /**
     * Transform the \Log entity
     *
     * @param Log $model
     *
     * @return array
     */
    public function transform(User $model)
    {
        return [
            'id'           => (int)$model->id,
            'name'         => $model->name,
            'email'        => $model->email,
            'password'     => $model->password,
            'address'      => $model->address,
            'neighborhood' => $model->neighborhood,
            'number'       => $model->number,
            'created_at'   => $model->created_at,
            'updated_at'   => $model->updated_at
        ];
    }

    public function includeUser(User $model)
    {
        return $this->item($model->user, new UserTransformer());
    }
}
