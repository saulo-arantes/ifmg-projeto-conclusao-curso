<?php

namespace App\Presenters;

use App\Transformers\AdministratorTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class AdministratorPresenter
 *
 * @package namespace App\Presenters;
 */
class AdministratorPresenter extends FractalPresenter
{
	/**
	 * Transformer
	 *
	 * @return \League\Fractal\TransformerAbstract
	 */
	public function getTransformer()
	{
		return new AdministratorTransformer();
	}
}
