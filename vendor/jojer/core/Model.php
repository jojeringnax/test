<?php
/**
 * Created by PhpStorm.
 * User: jojer
 * Date: 2019-05-03
 * Time: 09:29
 */

namespace jojer\core;

/**
 * Class Model
 * @package app\models
 */
abstract class Model
{
    /**
     * @var QueryBuilder
     */
    protected static $queryBulder;

    /**
     * @var string
     */
    protected static $table;

    /**
     * @var array
     */
    protected static $attributes;

    /**
     * @return mixed
     */
    public function __construct()
    {
        static::$queryBulder = new QueryBuilder();
        static::$queryBulder->table = static::$table;
    }

    /**
     * @param $array
     * @return $this
     */
    public function fill($array)
    {
        foreach ($array as $key => $value) {
            if ($value === 'on') {
                $this->$key = 1;
                continue;
            }
            $this->$key = $value;
        }
        return $this;
    }

    /**
     * @return Model
     */
    public static function find()
    {
        return new static();
    }

    /**
     * @return Model[]
     */
    public static function all()
    {
        $model = new static();
        return static::$queryBulder->performSelectQuery(static::class);
    }

    /**
     * @param $fieldName
     * @param $comparison
     * @param null $value
     * @return $this
     */
    public function where($fieldName, $comparison, $value=null)
    {
        self::$queryBulder->where[] = "`$fieldName`$comparison'$value'";
        return $this;
    }


    /**
     * @param $fields
     * @return $this
     * @throws \Exception
     */
    public function select($fields)
    {
        $this->select = [];
        if (is_array($fields)) {
            foreach ($fields as $field) {
                self::$queryBulder->select[] = $field;
            }
        } else if(is_string($fields)) {
            self::$queryBulder->select[] = $fields;
        } else {
            throw new \Exception('`select` needs arguments to be an array or string');
        }
        $this->select = explode(', ', self::$queryBulder->select);
        return $this;
    }

    /**
     * @return array
     */
    public function get()
    {
        return self::$queryBulder->performSelectQuery(static::class);
    }

    public function save()
    {
        $attributes = static::$attributes;
        $action = isset($this->id) ? 'update' : 'insert';
        foreach ($attributes as $attribute) {
            self::$queryBulder->$action[$attribute] = $this->$attribute;
        }
        if ($action === 'update') {
            self::$queryBulder->update['id'] = $this->id;
            return self::$queryBulder->performUpdateQuery();
        }
        self::$queryBulder->performInsertQuery();
        $this->id = App::$mysqli->insert_id;
        return $this;
    }

    /**
     * @return string
     */
    public function query()
    {
        $whereSection = self::$queryBulder->where === [] ? '' : ' where '.implode(' and ', self::$queryBulder->where);
        return 'select '.self::$queryBulder->select.' from '.static::$table.$whereSection;
    }

    /**
     * @return bool
     */
    public function delete()
    {
        try {
            App::$mysqli->query('delete from '.static::$table.' where id='.$this->id);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

}