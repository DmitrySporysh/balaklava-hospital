<?php
namespace App\Repositories\Interfaces;


    interface RepositoryInterface
    {
        public function all($columns = array('*'));

        public function paginate($perPage = 15, $columns = array('*'));

        public function insert($data);

        public function create(array $data);

        public function update(array $data, $id);

        public function delete($id);

        public function find($id, $columns = array('*'));

        public function findBy($field, $value, $columns = array('*'));

        public function where($attribute, $value, $operator = '=', $columns = array('*'));

        public function first();

        public function deleteWhere($attribute, $operator, $value );
        
        public function updateWhereIn(array $data,array $values, $attribute="id");

        public function deleteWhereIn(array $values, $attribute="id");
    }
