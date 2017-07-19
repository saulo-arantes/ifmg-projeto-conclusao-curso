<?php

namespace App\Presenters;

use App\Transformers\PatientContactTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class PatientContactPresenter
 *
 * @package namespace App\Presenters;
 */
class PatientContactPresenter extends FractalPresenter {
	/**
	 * Transformer
	 *
	 * @return \League\Fractal\TransformerAbstract
	 */
	public function getTransformer() {
		return new PatientContactTransformer();
	}
}
