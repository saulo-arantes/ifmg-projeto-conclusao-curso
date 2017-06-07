<?php

namespace App\Presenters;

use Prettus\Repository\Presenter\FractalPresenter;
use App\Transformers\StateTransformer;

/**
 * Class StatePresenter
 *
 * @author  Bruno Tomé
 * @package namespace TARS\Presenters;
 */
class StatePresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new StateTransformer();
    }
}
