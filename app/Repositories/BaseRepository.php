<?php

namespace App\Repositories;

abstract class BaseRepository implements BaseRepositoryInterface
{
    protected $model;

    public function __construct()
    {
        $this->setModel();
    }

    abstract public function getModel();

    public function setModel()
    {
        $this->model = app()->make(
            $this->getModel()
        );
    }

    public function index()
    {
        return $this->model->all();
    }

    public function find($id)
    {
        return $this->model->findorfail($id);
    }

    public function store($data)
    {
        return $this->model->create($data);
    }

    public function update($id, $data)
    {
        $model= $this->model->findorfail($id);

        $dataArray= $data->all();
        $fill =$model->fill($dataArray);
        if ($data->hasFile('image')) {
            $file = $data->image;
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('/img/avatar'), $fileName);
            $fill->image= $fileName;
        }
        return $model->save();
    }

    public function destroy($id)
    {
        return $this->model->destroy($id);
    }
}
