<?php
    namespace MyProject\Models;
    use MyProject\Services\Db;

    abstract class ActiveRecordEntity{
        protected $id;

        public function getId(){
            return $this->id;
        }

        public function __set($name, $value){
            $nameToCamelCase = $this->underscoreToCamelCase($name);
            $this->$nameToCamelCase = $value;
        }

        private function underscoreToCamelCase(string $source){
            return lcfirst(str_replace('_', '', (ucwords($source, '_'))));
        }
        private function camelCaseToUnderscore(string $source){
            return strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $source));
        }

        private function mapPropertiesToDbFormat(): array
        {
            $reflector = new \ReflectionObject($this);
            $properties = $reflector->getProperties();

            $mappedProperties = [];
            foreach($properties as $property){
                $propertyName = $property->getName();
                $propertyFormatDb = $this->camelCaseToUnderscore($propertyName);
                $mappedProperties[$propertyFormatDb] = $this->$propertyName;
            }
            return $mappedProperties;
        }

        public function save():void
        {
            $mappedProperties = $this->mapPropertiesToDbFormat();
            if ($this->id !== null){
                $this->update($mappedProperties);
            }else $this->insert($mappedProperties);
        }

        private function update(array $mappedProperties): void
        {
            $column2params = [];
            $params2value = [];
            $index = 1;
            foreach($mappedProperties as $column => $value){
                $param = ':param'.$index;
                $column2params[] = $column .'='.$param;
                $params2value[$param] = $value;
                $index++;
            }

            $sql = 'UPDATE `'.static::getTableName().'` SET '.implode(', ', $column2params).' WHERE id = '.$this->id; 
            var_dump($sql);
            $db = Db::getInstance();
            $db->query($sql, $params2value, static::class);
            // var_dump($column2params); 
            // echo '<br>';
            // var_dump($params2value);
        }
        private function insert(array $mappedProperties): void
        {
            $filteredProperties = array_filter($mappedProperties);
            $column = [];
            foreach($filteredProperties as $columnName => $value){
                $column[] = '`'.$columnName.'`';
                $paramName = ':'.$columnName;
                $paramsName[] = $paramName;
                $params2values[$paramName] = $value;
            }
            $columnFinish = implode(',', $column);
            $paramsFinish = implode(',', $paramsName);
            $sql = 'INSERT INTO `'.static::getTableName().'` ('.$columnFinish.') VALUES ('.$paramsFinish.')';
            $db = Db::getInstance();
            $db->query($sql, $params2values, static::class);
        }

        public function delete():void
        {
            $db = Db::getInstance();
            $sql = 'DELETE FROM `'.static::getTableName().'` WHERE id = :id';
            $db->query($sql, [':id' => $this->id]);
            $this->id=null;
        }

        public static function findAll(): array
        {
            $db = Db::getInstance();
            return $db->query('SELECT * FROM `'.static::getTableName().'`', [], static::class);
        }

        public static function getById(int $id): ?self{
            $db = Db::getInstance();
            $entit = $db->query('SELECT * FROM `'.static::getTableName().'` WHERE id = :id', [':id'=> $id], static::class);
            return $entit ? $entit[0] : null;
        }

        abstract protected static function getTableName():string;
    }
?>