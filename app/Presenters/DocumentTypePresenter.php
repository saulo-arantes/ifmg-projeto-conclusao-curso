<?php

namespace App\Presenters;

use App\Transformers\DocumentTypeTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class DocumentTypePresenter
 *
 * @package namespace App\Presenters;
 */
class DocumentTypePresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new DocumentTypeTransformer();
    }
}
