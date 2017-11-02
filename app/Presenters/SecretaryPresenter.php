<?php

namespace App\Presenters;

use App\Transformers\SecretaryTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class SecretaryPresenter
 *
 * @package namespace App\Presenters;
 */
class SecretaryPresenter extends FractalPresenter
{
	/**
	 * Transformer
	 *
	 * @return \League\Fractal\TransformerAbstract
	 */
	public function getTransformer()
	{
		return new SecretaryTransformer();
	}
}
