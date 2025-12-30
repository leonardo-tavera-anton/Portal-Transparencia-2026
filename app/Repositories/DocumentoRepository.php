<?php

namespace App\Repositories;

use App\Models\Documento;

class DocumentoRepository
{
    protected $model;

    public function __construct(Documento $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->with(['tipoDocumento', 'annoDocumento', 'mantenimientos'])->get();
    }

    public function find($id)
    {
        return $this->model->with(['tipoDocumento', 'annoDocumento', 'mantenimientos'])
                           ->findOrFail($id);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        $documento = $this->find($id);
        $documento->update($data);
        return $documento;
    }

    public function delete($id)
    {
        return $this->model->destroy($id);
    }
}
