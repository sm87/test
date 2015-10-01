<?php

include_once "Phones.php";

class PhonesTest extends PHPUnit_Framework_TestCase
{
    public function testGetPhones()
    {
        try {
            include_once "../config.php";

            $phones = new Phones($arrConfig);

            $result = $phones->getPhones();

            foreach ($result as $value) {
                $this->assertEquals("+", $value[0]);
            }

        } catch(Exception $ex)
        {
            $this->fail($ex->getMessage());
        }
    }
}
