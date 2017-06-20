<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\UserContact;

/**
 * Class UserContactTransformer
 * @package namespace App\Transformers;
 */
class UserContactTransformer extends TransformerAbstract
{
    protected $defaultIncludes = ['contactType'];

    /**
     * Transform the \UserContact entity
     * @param UserContact $model
     *
     * @return array
     */
    public function transform(UserContact $model)
    {
        return [
            'id'         => (int) $model->id,
            'description' => $model->description,
            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }

    public function includeContactType(UserContact $model)
    {
        if (!empty($model->contactType())){
            return $this->collection($model->contactType(), new ContactTypeTransformer());
        }

        return null;
    }
}
