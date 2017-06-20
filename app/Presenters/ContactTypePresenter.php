<?php

namespace App\Presenters;

use App\Transformers\ContactTypeTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class ContactTypePresenter
 *
 * @package namespace App\Presenters;
 */
class ContactTypePresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new ContactTypeTransformer();
    }
}
