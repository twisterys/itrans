<?php

namespace App\Http\Controllers;

use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class TestController extends Controller
{
    public function index(){

        $macAddr = substr(exec('getmac'),0,17);
        $host = gethostname();
        $simple_string = $macAddr.'|'.$host ;
        $ciphering = "AES-128-CTR";
        $encryption_iv = '1905900635009350';
        $encryption_key = "strans";
        $encryption = 'y'.openssl_encrypt($simple_string, $ciphering,
            $encryption_key, 0, $encryption_iv).'s';
        echo "Votre Clé de Machine: " . $encryption .'<br/>';
    }

}
