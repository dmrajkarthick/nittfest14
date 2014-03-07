<?php
/*
connects to the MySQL database using the password and login details given in the "MySQL.ini" file in the SETTING directory
return the connection resource if connection made,
false if connection could not be made
 argument: path to root project folder. takes on after that to locate the config file
*/

class Database
{
    private $DSN;
    private $SQLuser;
    private $SQLpassword;
    /**
     * @var PDO
     */
    private $connection;

    public function __construct($dsn, $user, $password)
    {
        $this->DSN=$dsn;
        $this->SQLuser=$user;
        $this->SQLpassword=$password;
        $this->connection=null;
    }

    public function connect()
    {
        if($this->connection === null)
        {
            try
            {
                $this->connection = new PDO($this->DSN,$this->SQLuser,$this->SQLpassword);
                return true;
            }
            catch(PDOException $e)
            {
                return false;
                //echo "connection failed : " . $e->getMessage();
            }
        }
        return true;
    }

    public function PDO()
    {
        if($this->connection === null)
            $this->connect();
        return $this->connection;
    }

    public function query($sql, $vars = array())
    {
        if($this->connection === null )
            $this->connect();
        /** @var PDOStatement */
        $prep=$this->connection->prepare($sql);
        $prep->execute($vars);
        return $prep;
    }

    public function query_simple($sql)
    {
        if($this->connection === null)
            $this->connect();
        $prep=$this->connection->prepare($sql);
        $prep->execute();
        return $prep;

    }
}

$c= new ArrayObject();
require_once __DIR__.'/../config/mySQL.php';
$c['db']=new Database(DSN,DB_USER,DB_PASS);

