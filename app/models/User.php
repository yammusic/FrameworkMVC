<?php

    /**
    * 
    */
    class User extends Database implements iDatabase {

        private static $table = 'users';
        private static $sTable = 'user';

        public function __construct() {
        }

        static public function find( $value, $where = 'id' ) {
            $SQL = "SELECT * FROM ". self::$table ." WHERE ". $where ."='". $value ."' LIMIT 1";
            return( parent::findOne( $SQL ) );
        }

        static public function all( $orderby = 'id', $order = 'ASC' ) {
            $SQL = "SELECT * FROM ". self::$table ." ORDER BY ". $orderby .' '. $order;
            return( parent::findMany( $SQL ) );
        }

        static public function create(
            $fieldsToAdd = array(
                'username' => null,
                'password' => null,
                'email' => null
            )
        ) {
            $SQL = "INSERT INTO ". self::$table ." VALUES( '', '". $fieldsToAdd[ 'username' ] ."', '". md5( $fieldsToAdd[ 'password' ] ) ."', '". $fieldsToAdd[ 'email' ] ."' )";
            return( parent::createNew( $SQL, parent::link() ) );
        }

        static public function update(
            $id,
            $fieldsToAdd = array(
                'username' => null,
                'password' => null,
                'email' => null
            )
        ) {
            $SQL = "UPDATE ". self::$table ." SET";
            $count = count( $fieldsToAdd );
            $i = 1;
            foreach ( $fieldsToAdd as $key => $value ) {
                $SQL .= " ". $key ."='". $value ."'";
                if ( $i <= ( $count - 1 ) ) $SQL .= ", ";
                $i++;
            }
            $SQL .= " WHERE id=". $id ." LIMIT 1";
            return( parent::updates( $SQL, parent::link() ) );
        }

        static public function destroy( $id ) {
            $SQL = "DELETE FROM ". self::$table ." WHERE id='". $id ."' LIMIT 1";
            return( parent::delete( $SQL, parent::link() ) );
        }

        public function __destruct() {
            parent::link()->close();
        }
    }
