<?php

namespace App\Repositories;

use App\Models\Mantenimiento;

class MantenimientoRepository
{
    protected $model;

    public function __construct(Mantenimiento $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->with('documento')->get();
    }

    public function find($id)
    {
        return $this->model->with('documento')->findOrFail($id);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        $mantenimiento = $this->find($id);
        $mantenimiento->update($data);
        return $mantenimiento;
    }

    public function delete($id)
    {
        return $this->model->destroy($id);
    }
}
