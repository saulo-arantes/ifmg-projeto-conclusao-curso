<?php

namespace App\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;
use Prettus\Validator\Exceptions\ValidatorException;

/**
 * Interface LogRepository
 *
 * @author  Bruno Tomé
 * @package namespace App\Repositories;
 */
interface LogRepository extends RepositoryInterface
{
    /**
     * Create a log of ALERT type.
     *
     * @param \Exception $e
     */
    public function alert(\Exception $e);

    /**
     * Create a log of INFO type.
     *
     * @param string $description
     */
    public function info($description);

    /**
     * Create a log of ERROR type.
     *
     * @param \Exception $e
     */
    public function error(\Exception $e);

    /**
     * Create a log of VALIDATOR_EXCEPTION type.
     *
     * @param ValidatorException $e
     */
    public function validatorException(ValidatorException $e);

    /**
     * Create a log of DENIED type.
     */
    public function denied();

    /**
     * Set the visualized attribute to true for all non visualized messages.
     */
    public function visualizeAll();

    /**
     * Set the visualized attribute to true.
     *
     * @param $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function markAsSeen($id);
}
