<?php

namespace App\Presenters;

use App\Transformers\UserContactTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class UserContactPresenter
 *
 * @package namespace App\Presenters;
 */
class UserContactPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new UserContactTransformer();
    }
}
