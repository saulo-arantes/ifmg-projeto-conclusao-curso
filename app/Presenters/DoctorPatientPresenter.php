<?php

namespace App\Presenters;

use App\Transformers\DoctorPatientTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class DoctorPatientPresenter
 *
 * @package namespace App\Presenters;
 */
class DoctorPatientPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new DoctorPatientTransformer();
    }
}
