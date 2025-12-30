<?php

namespace App\Repositories;

use App\Models\Tipo;

class TipoRepository
{
    protected $model;

    public function __construct(Tipo $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->all();
    }

    public function find($id)
    {
        return $this->model->findOrFail($id);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        $tipo = $this->find($id);
        $tipo->update($data);
        return $tipo;
    }

    public function delete($id)
    {
        return $this->model->destroy($id);
    }
}
