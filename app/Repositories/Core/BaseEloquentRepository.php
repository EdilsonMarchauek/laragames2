<?php

namespace App\Repositories\Core;

use Illuminate\Support\Facades\Storage;
use App\Repositories\Exceptions\NotEntityDefined;
use App\Repositories\Contracts\RepositoryInterface;

class BaseEloquentRepository implements RepositoryInterface
{

    protected $entity;

    public function __construct()
    {
        $this->entity = $this->resolveEntity();
    }

    public function getAll()
    {
        return $this->entity->get();
    }

    public function findById($id)
    {
        return $this->entity->find($id);
    }

    public function findWhere($column, $valor)
    {
        return $this->entity
                        ->where($column, $valor)
                        ->get();
    }

    public function findWhereFirst($column, $valor)
    {
        return $this->entity
                        ->where($column, $valor)
                        ->first();
    }

    public function paginate($totalPage = 30)
    {
        return $this->entity->paginate($totalPage);
    }

    public function store(array $data)
    {
        return $this->entity->create($data);
    }

    public function update($id, array $data)
    {
        $entity = $this->findById($id);

        return $entity->update($data);
    }

    public function delete($id)
    {
        return $entity = $this->entity->find($id)->delete();
    }

    public function relationships(...$relationships)
    {
        $this->entity = $this->entity->with($relationships);

        return $this;
    }

    public function orderBy($column, $order = 'ASC')
    {
        $this->entity = $this->entity->orderBy($column, $order);

        //Faz o encadeamento dos métodos
        return $this;
    }

    function cleanDirectory($path, $recursive = true)
    {
        $storage = Storage::disk('my_files');

        foreach($storage->files($path, $recursive) as $file) {
            $storage->delete($file);
        }
    }

    public function resolveEntity()
    {
        if (!method_exists($this, 'entity')) {
            throw new NotEntityDefined;
        }

        return app($this->entity());
    }

}