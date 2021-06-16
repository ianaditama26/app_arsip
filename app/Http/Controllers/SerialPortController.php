<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use lepiaf\SerialPort\Configure\TTYConfigure;
use lepiaf\SerialPort\Parser\SeparatorParser;
use lepiaf\SerialPort\SerialPort;

class SerialPortController extends Controller
{
    public function __invoke()
    {
        $serialPort = new SerialPort(new SeparatorParser(), new TTYConfigure());
        $serialPort->open("/dev/ttyACM0008");
        while($data = $serialPort->read()) {
            \dd($data);
            if ($data === "OK") {
                $serialPort->write("1\n");
                $serialPort->close();
            }
        }
    }
}
