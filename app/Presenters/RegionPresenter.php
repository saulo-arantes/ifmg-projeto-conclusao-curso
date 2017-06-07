<?php

namespace App\Presenters;

use Prettus\Repository\Presenter\FractalPresenter;
use App\Transformers\RegionTransformer;

/**
 * Class RegionPresenter
 *
 * @author  Bruno Tomé
 * @package namespace TARS\Presenters;
 */
class RegionPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new RegionTransformer();
    }
}
