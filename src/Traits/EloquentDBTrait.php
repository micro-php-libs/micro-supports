<?php
/**
 * This file is part of DBCSoft Standard Package
 *
 * (c) Ty Huynh <hongty.huynh@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace MicroPhpLibs\MicroSupports\Traits;

use Illuminate\Database\Query\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

trait EloquentDBTrait
{
    /**
     * @param string $table
     * @return \Illuminate\Database\ConnectionInterface
     */
    public function getConnection(string $table)
    {
        return DB::table($table)->getConnection();
    }

    /**
     * @param string $table
     * @param array $records
     * @param int $chunkSize
     */
    public function saveMultiData(string $table, array $records, int $chunkSize = 200)
    {
        // TODO: filter unique records

        $chunkRecords = collect($records)->chunk($chunkSize);

        foreach ($chunkRecords as $chunk) {

            /** @var Collection $chunk */
            DB::table($table)->insert($chunk->toArray());
        }
    }

    /**
     * @param string $table
     * @param array $data
     */
    public function saveData(string $table, $data)
    {
        DB::table($table)->insert($data);
    }

    /**
     * @param string $table
     * @param array $whereCond
     * @return Collection
     */
    public function allData(string $table, $whereCond = [])
    {
        $query = $this->getQuery($table);

        return $query->where($whereCond)->get();
    }

    /**
     * @param string $table
     * @param array $data
     * @return int
     */
    public function updateData(string $table, $data)
    {
        return DB::table($table)->update($data);
    }

    /**
     * @param string $table
     * @param int $id
     * @return int
     */
    public function deleteData(string $table, $id)
    {
        return DB::table($table)->delete($id);
    }

    /**
     * @param Builder $query
     * @return int
     */
    public function deleteByQuery(Builder $query)
    {
        return $query->delete();
    }

    /**
     * @param string $table
     * @return \Illuminate\Database\Query\Builder
     */
    public function getQuery(string $table)
    {
        return DB::table($table)->newQuery();
    }

    /**
     * @param string $table
     * @param string $uniqueColumn
     * @param array $vars
     * @return bool
     */
    public function existIn(string $table, string $uniqueColumn, array $vars)
    {
        $query = $this->getQuery($table)->whereIn($uniqueColumn, $vars);

        return $query->exists();
    }

    /**
     * @param string $table
     * @param string $uniqueColumn
     * @param array $vars
     * @return int
     */
    public function deleteIn(string $table, string $uniqueColumn, array $vars)
    {
        $query = $this->getQuery($table);

        // FIXME: fix compile delete sql from Laravel
        $sql = $query->getGrammar()->compileDelete($query->whereIn($uniqueColumn, $vars));
        $sql = str_replace("delete from ``", "delete from `{$table}`", $sql);

        return DB::delete($sql, $vars);
    }

    /**
     * @param string $table
     * @param string $uniqueColumn
     * @param array $vars
     * @return \Illuminate\Database\Eloquent\Model|null|object|static
     */
    public function getOneIn(string $table, string $uniqueColumn, array $vars)
    {
        $query = $this->buildQueryIn($table, $uniqueColumn, $vars);

        return $query->first();
    }

    /**
     * @param string $table
     * @param string $uniqueColumn
     * @param array $vars
     * @return Collection
     */
    public function getIn(string $table, string $uniqueColumn, array $vars)
    {
        $query = $this->buildQueryIn($table, $uniqueColumn, $vars);

        return $query->get();
    }

    /**
     * @param string $table
     * @param string $uniqueColumn
     * @param array $vars
     * @param Builder|null $query
     * @return Builder
     */
    public function buildQueryIn(string $table, string $uniqueColumn, array $vars, Builder $query = null)
    {
        if (!$query) {
            $query = $this->getQuery($table);
        }

        return $query->whereIn($uniqueColumn, $vars);
    }

    /**
     * @param string $table
     * @param array $whereCond
     * @param Builder|null $query
     * @return Builder
     */
    public function buildQueryWhere(string $table, $whereCond = [], Builder $query = null)
    {
        if (!$query) {
            $query = $this->getQuery($table);
        }

        return $query->where($whereCond);
    }

    /**
     * @param string $table
     * @param array $whereCond
     * @param array $orders
     * @param int $offset
     * @param int $limit
     * @return Collection
     */
    public function getPagination(string $table, array $whereCond = null, array $orders = null, $offset = 0, $limit = 100)
    {
        $query = $this->getQuery($table);

        if ($whereCond) {
            $query->where($whereCond);
        }

        if ($orders) {
            foreach ($orders as $col => $direction) {
                $query->orderBy($col, $direction);
            }
        }

        return $query
            ->offset($offset)
            ->limit($limit)
            ->get();
    }
}
