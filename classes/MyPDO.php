<?php
/*
 * MyPDO is extension of PDO class. It calls the constructor to parent class (PDO) to create PDO Objects.
 */
class MyPDO extends PDO
{
    public function __construct($dsn, $username, $passwd, $options)
    {
        parent::__construct($dsn, $username, $passwd, $options);
    }
}
?>
