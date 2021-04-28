<html>

<body>

    <?php
    $fn = fopen("c:\\Temp\\test.txt", "r");

    while (!feof($fn)) {
        // Read 1 line at a time.
        $result = fgets($fn);

        // Split the line by tab.
        //$parts = preg_split('/\s+/', $result);

        // Process each word

        // Add procesed word to another string
        echo $result;
    }
    
    fclose($fn);

    // Write processed string into a new file.
    
    ?>


</body>

</html