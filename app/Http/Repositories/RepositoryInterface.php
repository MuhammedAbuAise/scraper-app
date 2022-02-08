<?php

namespace App\Http\Repositories;

/**
 * Class RepositoryInterface
 *
 * @package App\Http\Repositories
 * @author Mahammad Mammadov <muhammed.mammadov.89@gmail.com>
 */
interface  RepositoryInterface
{

    /**
     * Get all records
     *
     * @param array $params
     * @return mixed
     */
    public function all(array $params = []);

    /**
     * Create New Record
     *
     * @param array $data
     * @return mixed
     */
    public function create(array $data);

    /**
     * Bulk insert
     *
     * @param array $data
     * @return mixed
     */
    public function insert(array $data);

    /**
     * Update existing record by id
     *
     * @param array $params
     * @param int $id
     * @return mixed
     */

    public function update(int $id, array $params);

    /**
     * Delete records requested ids
     *
     * @param integer $id
     * @return mixed
     */
    public function delete(int $id);

    /**
     * Find record by id
     *
     * @param int $id
     * @return mixed
     */
    public function show(int $id);

}
