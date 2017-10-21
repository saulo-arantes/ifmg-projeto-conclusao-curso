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
	 * @param null $id
	 *
	 * @return array
	 */
	public function getExtraData($id = null): array;
}
