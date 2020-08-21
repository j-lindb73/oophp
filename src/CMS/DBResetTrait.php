<?php

namespace Lefty\CMS;

/**
 * Reset content database
 *
 * @return void
 */
trait DBResetTrait
{
    /**
    * Reset database
    */
    public function reset($filename)
    {
        $file = ANAX_INSTALL_PATH . $filename;

        if ($_SERVER["SERVER_NAME"] === "www.student.bth.se") {
            $mysql = "/usr/bin/mysql";
        } else {
            $mysql = "C:\Program Files\MySQL\MySQL Server 8.0\bin\mysql";
            //$mysql = "C:\\xampp\mysql\bin\mysql";
        }

        $output = null;
        $databaseConfig = $this->app->configuration->load("database");
        //var_dump($databaseConfig);
        $dsnDetail = [];
        preg_match("/mysql:host=(.+);dbname=([^;.]+)/", $databaseConfig["config"]["dsn"], $dsnDetail);
        $host = $dsnDetail[1];
        $database = $dsnDetail[2];
        $username = $databaseConfig["config"]["username"];
        $password = $databaseConfig["config"]["password"];

        $command = "$mysql -h{$host} -u{$username} -p{$password} $database < $file 2>&1";
        //var_dump($command);
        $output = [];
        $status = null;
        exec($command, $output, $status);
        //var_dump($output);
    }
}
