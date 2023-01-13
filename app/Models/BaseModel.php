<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model {

    /**
     * The validation rules.
     *
     * @var array
     */
    protected $validation = [];

    /**
     * Get the table associated with the model.
     *
     * @return string
     */
    public static function getTableName()
    {
        return (new self())->getTable();
    }
    
    /**
     * Getter for the current model validation rule.
     *
     * @return array
     */
    public function validation()
    {
        return $this->validation;
    }

    /**
     * Filtering data, usualy just removing the ID from the request.
     *
     * @param array $data
     * @return array $filteredData
     */
    public function filter($data)
    {
        unset($data['id']);
        return $data;
    }
}