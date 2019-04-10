<?php

//use App\Logger\Logger;




try {
    $x = 4;
    if ($x !== 5) {
        throw new Exception('Route not found');
    }
}catch (Exception $e) {
    echo 'ldldldldldldld';
}
