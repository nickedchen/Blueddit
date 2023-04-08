<?php declare(strict_types=1);
namespace Tests\Unit;
use PHPUnit\Framework\TestCase;

final class connectionTest extends TestCase
{
    public function testGetConnection(){
        $result = true;

        try {
            include "../include/connection.php";

            //If the connection doesn't exist
            if ($conn == NULL){
                $result = false;
            }
            //If there was an error with the database
            if ($error != NULL){
                $result = false;
            }
        } catch (Exception $e) {
            //If an unforseen error occurs
            $result = false;
        }

        $this->assertTrue($result);
    }
}
?>