<?php

namespace App\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface DocumentTypeRepository
 * @package namespace App\Repositories;
 */
interface DocumentTypeRepository extends RepositoryInterface
{
	/**
	 * @return array
	 * @internal param null $id
	 *
	 */
	public function getExtraData();
}
