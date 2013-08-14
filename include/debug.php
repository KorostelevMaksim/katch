<?

    error_reporting(E_ALL);
    ini_set("display_errors", 1);

    function pre($pre) {
        echo "<pre>";
        print_r($pre);
        echo "</pre>";
    }
    
?>