<?php

namespace App\Presenters;

use Prettus\Repository\Presenter\FractalPresenter;
use App\Transformers\CityTransformer;

/**
 * Class CityPresenter
 *
 * @author  Bruno Tomé
 * @package namespace App\Presenters;
 */
class CityPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new CityTransformer();
    }
}
