<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\ContactType;

/**
 * Class ContactTypeTransformer
 * @package namespace App\Transformers;
 */
class ContactTypeTransformer extends TransformerAbstract
{

    /**
     * Transform the \ContactType entity
     * @param ContactType $model
     *
     * @return array
     */
    public function transform(ContactType $model)
    {
        return [
            'id'         => (int) $model->id,
            'name' => $model->name,
            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
