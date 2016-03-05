<?php
/**
 * Created by PhpStorm.
 * User: Hopesa
 * Date: 02/03/2016
 * Time: 06:21
 * This File contains all needed functions and classes
 * No Database Operational yet
 * Ignore Undefined
 */

class User
{
    private $db;

    function __construct($DB_con)
    {
        $this->db = $DB_con;
    }
    public function register($username,$pass)
    {
        try
        {

            $new_password = password_hash($pass, PASSWORD_DEFAULT);

            $stmt = $this->db->prepare("INSERT INTO login(UserName,Password)
                                                       VALUES(:username, :pass)");

            $stmt->bindparam(":username", $username);
            $stmt->bindparam(":pass", $new_password);
            $stmt->execute();

            return $stmt;
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
    }

    public function login($username,$pass)
    {
        try
        {
            $stmt = $this->db->prepare("SELECT * FROM login WHERE UserName=:username LIMIT 1");
            $stmt->execute(array(':username'=>$username));
            $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
            if($stmt->rowCount() > 0)
            {
                if(password_verify($pass, $userRow['Password']))
                {
                    $_SESSION['user_session'] = $userRow['IDUser'];
                    $_SESSION['username'] = $userRow['UserName'];
                    return true;
                }
                else
                {
                    return false;
                }
            }
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
    }

    public function is_loggedin()
    {
        if(isset($_SESSION['user_session']))
        {
            return true;
        }
        return false;
    }

    public function redirect($url)
    {
        header("Location: $url");
    }

    public function logout()
    {
        session_destroy();
        unset($_SESSION['user_session']);
        unset($_SESSION['username']);
        return true;
    }
}
class Transaction
{
    private $db;

    function __construct($DB_con)
    {
        $this->db = $DB_con;
    }

    public function create_transaction(){

    }
    public function edit_transaction(){

    }
    public function delete_transaction(){

    }

}
class Vehicle
{
    private $db;

    function __construct($DB_con)
    {
        $this->db = $DB_con;
    }

    public function edit_vehicle($license,$year,$tariff,$status, $type){

    }
    public function add_vehicle($license,$year,$tariff,$status, $type){

    }
    public function delete_vehicle($license){

    }
    public function service_vehicle($license,$codeservice,$date,$cost){

    }

}
class Driver
{
    private $db;

    function __construct($DB_con)
    {
        $this->db = $DB_con;
    }
    public function edit_driver($id_driver,$nama,$alamat,$telp,$sim,$salary){

    }
    public function add_driver($nama,$alamat,$telp,$sim,$salary){

    }
    public function delete_driver($id_driver){

    }
}
class Owner
{
    private $db;

    function __construct($DB_con)
    {
        $this->db = $DB_con;
    }
    public function edit_Owner(){

    }
    public function add_Owner(){

    }

    public function delete_Owner(){

    }
    public function Salary_Owner(){

    }
}