<?php
/**
 * Created by PhpStorm.
 * User: jojer
 * Date: 2019-05-03
 * Time: 17:23
 */

namespace jojer\core;


class QueryBuilder
{

    /**
     * @var string
     */
    public $select = '*';

    /**
     * @var string
     */
    public $where = [];

    /**
     * @var string
     */
    public $table;

    /**
     * @var array
     */
    public $update = [];

    /**
     * @var array
     */
    public $insert = [];

    /**
     * @var string
     */
    public $sql;

    /**
     * @param $className
     * @return array
     */
    public function performSelectQuery($className)
    {
        $this->setSelectSql();
        $resultArray = [];
        $result = App::$mysqli->query($this->sql);
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $obj = new $className;
                foreach ($row as $key => $item) {
                    $obj->$key = $item;
                }
                $resultArray[] = $obj;
            }
        }
        return $resultArray;
    }

    /**
     * @return string
     */
    public function performInsertQuery()
    {
        $this->setInsertSql();
        return App::$mysqli->query($this->sql);
    }

    /**
     * @return bool|\mysqli_result
     */
    public function performUpdateQuery()
    {
        $this->setUpdateQuery();
        return App::$mysqli->query($this->sql);
    }

    /**
     * @return $this|bool
     */
    private function setUpdateQuery()
    {
        $this->sql = 'UPDATE '.$this->table.' SET ';
        if ($this->update === []) {
            return false;
        }

        foreach ($this->update as $key => $value) {
            if ($key === 'id') {
                continue;
            }
            $arr[] = "`$key`='$value'";
        }
        $this->sql.=implode(', ', $arr);
        $this->sql.=' where id='.$this->update['id'];
        return $this;
    }


    /**
     * @param bool $query
     * @return $this
     */
    private function setSelectSql($query = null)
    {
        if ($query === null) {
            $whereSection = $this->where === [] ? '' : ' where '.implode(' and ', $this->where);
            $this->sql = 'select '.$this->select.' from '.$this->table.$whereSection;
        } else {
            $this->sql = $query;
        }
        return $this;
    }

    /**
     * @return $this
     */
    private function setInsertSql()
    {
        $keys = [];
        $values = [];
        $this->sql = 'INSERT INTO '.$this->table;
        foreach ($this->insert as $key => $value) {
            $keys[] = "`$key`";
            $values[] = "'$value'";
        }
        $this->sql .= ' ('.implode(', ',$keys).') VALUES ('.implode(', ', $values).')';
        return $this;
    }

}