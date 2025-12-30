<?php

namespace App\Repositories;

use App\Models\Usuario;

class UsuarioRepository
{
    protected $model;

    public function __construct(Usuario $model)
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
        $usuario = $this->find($id);
        $usuario->update($data);
        return $usuario;
    }

    public function delete($id)
    {
        return $this->model->destroy($id);
    }

    public function findByUsername($username)
    {
        return $this->model->where('username', $username)->first();
    }
}
