<?php
    require_once 'backend/model/Auth/Auth_service.php';
    require_once 'backend/controller/Auth.php';
    require_once 'backend/controller/helper.php';
    require_once 'backend/model/db/db_connection.php';

    define('INDEX_PATH', 'backend/controller/');
    define('BASE_PATH', getcwd());

    $authController = new Auth;

    if (isset($_COOKIE['accessToken'])) {
        $user = checkAccessToken();
    }

    $url = explode("?", $_SERVER['REQUEST_URI'])[0];
    $url = explode("/", $url);

    function get_array_index($array, $value) {
        for ($i = 0; $i < count($array); $i++) {
            if ($array[$i] == $value) {
                return $i;
            }
        }

        return -1;
    }

    function get_php_file_index($urlList) {
        $baseIndex = get_array_index($urlList, "index.php");

        for ($i = $baseIndex + 1; $i < count($urlList); $i++) {
            $path = implode("/", array_slice($urlList, $baseIndex + 1, $i - $baseIndex));

            if (file_exists($path . ".php")) {
                return $i;
            }
            echo $path;
            echo " " . $i . " ";
        }

        return false;
    }

    $baseIndex = get_array_index($url, "index.php");
    $fileIndex = $baseIndex + 1;

    $path = INDEX_PATH . $url[$fileIndex] . ".php";
    $method = "";

    if (count($url) - 1 - $baseIndex == $fileIndex) {
        $method = "index";
    } else {
        $method = $url[$fileIndex + 1];
    }

    require_once($path);
    $reflectionObj = new ReflectionClass($url[$fileIndex]);
    $reflectionMethod = new ReflectionMethod($url[$fileIndex], $url[$fileIndex + 1]);
    $obj = $reflectionObj->newInstance();


    if (isset($_COOKIE['accessToken']) AND $url[$fileIndex] != 'User' AND $url[$fileIndex + 1] != 'index') {
        $user = checkAccessToken();
        if (!$user) {
            require_once('backend/controller/Auth.php');
            $auth = new Auth;
            $auth->index();
        }
    } else if ($url[$fileIndex] != 'User' AND $url[$fileIndex + 1] != 'index') {
        require_once('backend/controller/Auth.php');
        $auth = new Auth;
        $auth->index();
    }

    $reflectionMethod->invokeArgs($obj, array());
?>