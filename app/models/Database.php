<?php

namespace App\Models;

class Database extends \PDO
{ 
  

    /**
     * Creates parts of a db query
     */
    public static function createQuery(string $type, string $table, array $params, int $id = null): array
    {
        $dbQuery = ['sql' => '', 'params' => []];

        if($type=='update'){
            $dbQuery = ['sql' => 'UPDATE '.$table .' SET ', 'params' => [':id'=>$id]];
            foreach ($params as $key => $param) {
                $dbQuery['sql'] .= $key . '=' . ':' . $key . ', ';
                $dbQuery['params'][':' . $key] = $param;
            } 
            $dbQuery['sql'] = substr($dbQuery['sql'], 0, -2);
            $dbQuery['sql'] .= " WHERE id = :id;"; 
        }
        elseif($type=='insert') { 
            $dbQuery = ['sql' => 'INSERT INTO '.$table, 'params' => []];
            
            $columns = "";
            $values = ""; 
            foreach ($params as $key => $param) {
                $columns .= $key.', ';
                $values .= ":".$key.', '; 
                $dbQuery['params'][':' . $key] = $param;
            } 

            $columns = substr($columns, 0, -2); 
            $values = substr($values, 0, -2); 
            $dbQuery['sql'] .= " (".$columns.") ";
            $dbQuery['sql'] .= " VALUES ".$values;
        }

        return $dbQuery;
    }
}
