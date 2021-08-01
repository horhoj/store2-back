<?php

namespace App\repositories;

use App\Types\APIIndexRequestParams;
use Illuminate\Database\Eloquent\Model;
use JetBrains\PhpStorm\ArrayShape;

/**
 * Class AbstractEntityRepository
 *
 * @package App\repositories
 */
abstract class AbstractEntityRepository
{
    /**
     * @var Model
     */
    protected Model $entity;

    /**
     * @var array
     */
    protected array $searchFields = [];

    /**
     * @param APIIndexRequestParams $APIIndexRequestParams
     * @param array|null $relations
     *
     * @return array
     */
    public function getList(APIIndexRequestParams $APIIndexRequestParams, array $relations = null): array
    {
        $entity = clone $this->entity;

        if ($relations) {
            $entity = $entity::with($relations);
        }

        foreach ($this->searchFields as $searchField) {
            $entity = $entity->orWhere(
                $searchField,
                'like',
                "%" . $APIIndexRequestParams->getSearch() . "%"
            );
        }

        return $entity
            ->orderBy(
                $APIIndexRequestParams->getSortField(),
                $APIIndexRequestParams->getSortAsc() === '1' ? 'asc' : 'desc'
            )
            ->paginate($APIIndexRequestParams->getPerPage())
            ->toArray();
    }

    /**
     * @param $id
     * @param array|null $relations
     *
     * @return array
     */
    public function get($id, array $relations = null): array
    {
        $entity = clone $this->entity;

        if ($relations) {
            $entity = $entity::with($relations);
        }

        return $entity->findOrFail($id)->toArray();
    }

    /**
     * @param $id
     * @param $data
     * @param array|null $relations
     *
     * @return array
     */
    #[ArrayShape(['id' => "mixed"])] public function update($id, $data, array $relations = null): array
    {
        $entities = clone $this->entity;
        $entity = $entities->findOrFail($id);
        $entity->fill($data);
        $entity->save();
        if ($relations) {
            foreach ($relations as $relation) {
                $entity->$relation()->sync($data[$relation]);
            }
        }

        return ['id' => $entity->id];
    }

    /**
     * @param $data
     * @param array|null $relations
     *
     * @return array
     */
    #[ArrayShape(['id' => ""])] public function store($data, array $relations = null): array
    {
        $entity = new $this->entity();
        $entity->fill($data);
        $entity->save();

        if ($relations) {
            foreach ($relations as $relation) {
                $entity->$relation()->sync($data[$relation]);
            }
        }

        return [
            'id' => $entity->id,
        ];
    }

    /**
     * @param $id
     *
     * @return array
     */
    #[ArrayShape(['id' => ""])] public function delete($id): array
    {
        $this->entity->findOrFail($id)->delete();

        return [
            'id' => $id,
        ];
    }
}
