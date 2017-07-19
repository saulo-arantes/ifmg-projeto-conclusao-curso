<?php

namespace App\Presenters;

use App\Transformers\PatientsTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class PatientsPresenter
 *
 * @package namespace App\Presenters;
 */
class PatientsPresenter extends FractalPresenter {
	/**
	 * Transformer
	 *
	 * @return \League\Fractal\TransformerAbstract
	 */
	public function getTransformer() {
		return new PatientsTransformer();
	}
}
