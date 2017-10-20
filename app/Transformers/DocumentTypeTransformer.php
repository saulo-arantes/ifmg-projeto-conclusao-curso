<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\DocumentType;

/**
 * Class DocumentTypeTransformer
 * @package namespace App\Transformers;
 */
class DocumentTypeTransformer extends TransformerAbstract
{

    /**
     * Transform the \DocumentType entity
     * @param DocumentType $model
     *
     * @return array
     */
    public function transform(DocumentType $model)
    {
        return [
            'id'          => (int) $model->id,
            'name'        => $model->name,
            'description' => $model->description,
            'created_at'  => $model->created_at,
            'updated_at'  => $model->updated_at
        ];
    }
}
