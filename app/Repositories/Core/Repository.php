<?php

namespace App\Repositories\Core;


use Exception;
use App\Exceptions\DALException;
use Illuminate\Support\Facades\App as App;
use Illuminate\Database\Eloquent\Model;
use App\Repositories\Interfaces\RepositoryInterface;



abstract class Repository implements RepositoryInterface
{

    protected $model;

    public function __construct()
    {
        $this->makeModel();
    }

    abstract function model();

    public function where($attribute, $value, $operator = '=', $columns = array('*'))
    {
        try {
            $data = $this->model->where($attribute, $operator, $value)->get($columns);
        } catch (Exception $e) {
            $message = 'Error while finding element using ' . $this->model();
            throw new DALException($message, 0, $e);
        }
        if ($data != null) {
            return $data->toArray();
        }
        return array();

    }

    public function insert($data)
    {
        try {
            $this->model->insert($data);
        } catch (Exception $e) {
            $message = 'Error while inserting elements using ' . $this->model();
            throw new DALException($message, 0, $e);
        }
    }

    public function all($columns = array('*'))
    {
        try {
            $data = $this->model->get($columns);
        } catch (Exception  $e) {
            $message = 'Error in all() method in ' . $this->model();
            throw new DALException($message, 0, $e);
        }
        if ($data != null) {
            return $data->toArray();
        }
        return array();
    }

    public function paginate($perPage = 15, $columns = array('*'))
    {
        try {
            $data = $this->model->paginate($perPage, $columns);
        } catch (Exception $e) {
            $message = 'Error in paginate method in ' . $this->model();
            throw new DALException($message, 0, $e);
        }
        if ($data != null) {
            return $data->toArray();
        }
        return array();
    }

    public function create(array $data)
    {
        try {
            return $createdElement = $this->model->create($data);
        } catch (Exception $e) {
            $message = 'Error while creating element using ' . $this->model() ."\n". $e->getMessage();
            throw new DALException($message, 0, $e);
        }
    }

    public function update(array $data, $id, $attribute = "id")
    {
        try {
            return $this->model->where($attribute, '=', $id)->update($data);
        } catch (Exception $e) {
            $message = 'Error while updating element using ' . $this->model();
            throw new DALException($message, 0, $e);
        }
    }

    public function updateWhereIn(array $data, array $values, $attribute = "id")
    {
        try {
            return $this->model->whereIn($attribute, $values)->update($data);
        } catch (Exception $e) {
            $message = 'Error while updating element using ' . $this->model();
            throw new DALException($message, 0, $e);
        }
    }

    public function deleteWhereIn(array $values, $attribute = "id")
    {
        try {
            return $this->model->whereIn($attribute, $values)->delete();
        } catch (Exception $e) {
            $message = 'Error while deleting element using ' . $this->model();
            throw new DALException($message, 0, $e);
        }
    }

    public function delete($id)
    {
        try {
            return $this->model->destroy($id);
        } catch (Exception $e) {
            $message = 'Error while deleting element using ' . $this->model();
            throw new DALException($message, 0, $e);
        }
    }

    public function deleteWhere($attribute, $operator, $value)
    {
        try {
            return $this->model->where($attribute, $operator, $value)->delete();
        } catch (Exception $e) {
            $message = 'Error while deleting element using ' . $this->model();
            throw new DALException($message, 0, $e);
        }
    }

    public function find($id, $columns = array('*'))
    {
        try {
            $data = $this->model->find($id, $columns);

        } catch (Exception $e) {
            $message = 'Error while finding element using ' . $this->model();
            throw new DALException($message, 0, $e);
        }
        if ($data != null) {
            return $data->toArray();
        }
        return array();


    }

    public function first()
    {
        try {
            $data = $this->model->first();
        } catch (Exception $e) {
            $message = 'Error while finding element using ' . $this->model();
            throw new DALException($message, 0, $e);
        }
        if ($data != null) {
            return $data->toArray();
        }
        return array();

    }

    public function findBy($attribute, $value, $operator = '=', $columns = array('*'))
    {
        try {
            $data = $this->model->where($attribute, $operator, $value)->select($columns)->first();

        } catch (Exception $e) {
            $message = 'Error while finding element using ' . $this->model();
            throw new DALException($message, 0, $e);
        }
        if ($data != null) {
            return $data->toArray();
        }
        return array();
    }

    public function makeModel()
    {
        $model = App::make($this->model());
        if (!$model instanceof Model)
            throw new Exception("Class {$this->model()} must be an instance of Illuminate\\Database\\Eloquent\\Model");

        return $this->model = $model;
    }
}