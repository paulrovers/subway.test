<?php

namespace Core;

class ModelObject extends Model{

    private $DbFields;
    private $DbPrimaryKey;
    private $DbTable;
    private $DbLink;

    function __construct()
    {

    }

    // selects data with the given Id and returns data
    public function Get($id, $field = '')
    {
        $pkey = $this->DbPrimaryKey;
        if (!empty($field))
        {
            $pkey = $field;
        }

        $sql = sprintf('SELECT * FROM `%s` WHERE `%s`=\'%s\' LIMIT 1;', $this->DbTable, $pkey, addslashes($id));
		//echo $sql;
        $res = $this->dbQuery($sql);

        $count = mysqli_num_rows($res);
        // Found?
        if ($count  == 1)
        {
            $data = mysqli_fetch_assoc($res);
            return $data;
        }
        else if($count >1){
            $ret = array();
            while ($data = mysqli_fetch_assoc($res))
            {
                $ret[] = $data;
            }

            return $ret;
        }
        else{return false;}
    }

    public function GetAll()
    {
        $sql = sprintf('SELECT * FROM `%s`', $this->DbTable);
        $ccc = parent::Connect();
        $res = mysqli_query($ccc,$sql);
		$ret = array();

        while ($data = mysqli_fetch_assoc($res))
        {

            $ret[] = $data;
        }

        return $ret;
    }

    public function Save()
    {
        $ccc = parent::Connect();
        $pkey = $this->DbPrimaryKey;
        if ($pkey == null)
        {
            throw new Exception('Primary key not found!');
        }

        $fields = '';

        $values = get_object_vars($this);
        foreach($this->DbFields as $dbName => $phpName)
        {
            if ($dbName != $this->DbPrimaryKey && isset($values[$phpName]))
            {
                $fields .= sprintf('`%s` = \'%s\', ', $dbName, addslashes($values[$phpName]));
            }
        }

        // Remove last comma + spacing
        $fields = substr($fields, 0, strlen($fields) - strlen(', '));
		
        $sql = sprintf('UPDATE `%s` SET %s WHERE `%s` = \'%s\' LIMIT 1;', $this->DbTable, $fields, $this->DbPrimaryKey, $values[$this->DbFields[$this->DbPrimaryKey]]);
		//echo $sql;
		$this->dbQuery($sql);

       return mysqli_affected_rows($ccc) == 1;
    }

    public function Insert()
    {
        $ccc = parent::Connect();
        $sql = sprintf('INSERT INTO `%s` (%s) VALUES (%s);', $this->DbTable, $this->getFieldsSql(), $this->getValuesSql());
        $this->dbQuery($sql);
        $key = $this->DbPrimaryKey;
        $this->$key = mysqli_insert_id($ccc);
        return true;
    }

    public function Delete()
    {
        if (trim($this->DbPrimaryKey) == '')
        {
            throw new Exception('Deletion is only supported when a primary key is set.');
        }

        $pkey = $this->DbPrimaryKey;
        $pkey_value = $this->DbFields[$pkey];
        $pkey_value = $this->$pkey_value;
        $sql = sprintf('DELETE FROM `%s` WHERE `%s`=\'%s\' LIMIT 1;', $this->DbTable, $pkey, $pkey_value);

        return $this->dbQuery($sql);
    }

    public function SetFieldsFromArray($array)
    {
        foreach($array as $key => $value)
        {
            $this->$key = $value;
        }
    }

    protected function SetTable($name)
    {
        $this->DbTable = $name;
    }

    protected function SetPrimaryKey($name)
    {
        $this->DbPrimaryKey = $name;
    }

    protected function AddField($name, $dbName = '')
    {
        if ($dbName == '')
        {
            $this->DbFields[$name] = $name;
        }
        else
        {
            $this->DbFields[$name] = $dbName;
        }
    }

    /*--------- query run ---------------- */
    public static function dbQuery($sql)
    {
        $ccc = parent::Connect();
        if ($ccc)
        {
            $res = mysqli_query($ccc,$sql);

            if ($res === false){
                Error::SystemFailure(mysqli_error($ccc));
            }

            return $res;
        }
        else
        {

            Error::SystemFailure(mysqli_error($ccc));

            exit;
        }
    }

    private function prepare($phpName)
    {
		$json = parent::real_escape_string($json);
		
		
    }

    private function getFieldDbName($phpName)
    {
        if (($index = array_search($phpName, $this->DbFields)) === false)
        {
            return false;
        }

        return $index;
    }

    private function getFieldsSql()
    {
        $sql = '';

        $values = get_object_vars($this);
        foreach($this->DbFields as $dbName => $phpName)
        {
            if ($values[$phpName] != NULL)
            {
                $sql .= sprintf('`%s`, ', $dbName);
            }
        }

        // Remove last comma + spacing
        return substr($sql, 0, strlen($sql) - 2);
    }

    private function getValuesSql()
    {
        $sql = '';

        $values = get_object_vars($this);

        foreach($this->DbFields as $dbName => $phpName)
        {
            if ($values[$phpName] != NULL)
            {
                $sql .= sprintf('\'%s\', ', addslashes($values[$phpName]));
            }
        }

        // Remove last comma + spacing
        return substr($sql, 0, strlen($sql) - 2);
    }


} 