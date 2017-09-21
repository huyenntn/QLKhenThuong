<?php

use Zend\Authentication\Adapter\DbTable\CredentialTreatmentAdapter;

include "vendor/autoload.php";

// Tạo kết nối đến cơ sở dữ liệu MySQL: phải đảm bảo bạn kết nối đến được Server MySQL với username và password của bạn
$dbAdapter = new \Zend\Db\Adapter\Adapter([
    'driver'   => 'Pdo',
    'dsn'      => 'mysql:dbname=khenthuong; host=localhost',
    'username' => 'root',
    'password' => ''

]);

// Khởi tạo Adapter xác thực
//$authAdapter = new CredentialTreatmentAdapter(
//    $dbAdapter,
//    'users',
//    'username',
//    'password',
//    'MD5(?)'
//);


//Hoặc dùng cách sau thì cũng có được $authAdapter tương tự

    $authAdapter = new CredentialTreatmentAdapter($dbAdapter);
    $authAdapter
        ->setTableName('user')
        ->setIdentityColumn('acc')
        ->setCredentialColumn('pass');



if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    //Lấy User, Pass khi người dùng POST lên
    $username = $_POST['acc'];
    $password = $_POST['pass'];
    $authAdapter
        ->setIdentity($username)
        ->setCredential($password);

    //Tiến hành xác thực
    $result = $authAdapter->authenticate();

    if ($result->isValid()) {
        echo $result->getIdentity().' : Bạn đã xác thực thành công';

        print_r($authAdapter->getResultRowObject());


    }
    else {
        echo "Xác thực thất bại : " . $result->getCode()."=>". implode($result->getMessages(), "|");
    }


}
else {
    
}