<?php

namespace App\Presenters;

use App\Transformers\StateTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class StatePresenter
 *
 * @author  Bruno Tomé
 * @package namespace TARS\Presenters;
 */
class StatePresenter extends FractalPresenter {
	/**
	 * Transformer
	 *
	 * @return \League\Fractal\TransformerAbstract
	 */
	public function getTransformer() {
		return new StateTransformer();
	}
}
