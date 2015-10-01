<?php

class Phones
{
    private $_config;

    public function Phones($config)
    {
        $this->_config = $config;
    }

    private function filter($rawPhone)
    {
        if (strlen($rawPhone) == 0)
            return FALSE;

        $phone = preg_replace("/[^0-9+]/", "", $rawPhone);
        if (strlen($phone) == 0)
            return FALSE;

        if (($phone[0] == '8' || $phone[0] == '7')) {
            if (strlen($phone) > 10) {
                $phone[0] = '7';
                $phone = "+" . $phone;
            } else {
                $phone = "+7" . $phone;
            }
        } else if ($phone[0] == "9") {
            $phone = "+7" . $phone;
        } else if ($phone[0] != "+") {
            $phone = "+" . $phone;
        }

        return $phone;
    }

    public function getPhones()
    {
        $res = array();

        $conn = new mysqli($this->_config["dbhost"], $this->_config["dbuser"], $this->_config["dbpass"], $this->_config["dbname"]);

        mysqli_set_charset($conn, $this->_config["dbcharset"]);

        if ($conn->connect_error) {
            throw new Exception("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM task1";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $phone = $this->filter($row["Phone"]);

                if ($phone)
                    array_push($res, $phone);
            }
        }

        $conn->close();

        return $res;
    }
}