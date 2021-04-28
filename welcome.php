<html>

<body>

    <?php
    $fn = fopen("c:\\Temp\\test.txt", "r");

    while (!feof($fn)) {
        // Read 1 line at a time.
        $result['result'] = fgets($fn);

        // Split the line by tab.

        $parts = preg_split('/\s+/', $result['result']);



        // Process each word

        // Add procesed word to another string
        echo $result['result'] . '<br>';
        echo '<pre>';
        var_dump($parts) . '<br>';
        echo '</pre>';
        //Use the preg_replace function to remove any characters that are not letters, hyphens, or single spaces from the FIRST and LAST names.

        $array = preg_replace("/\d?\dIPT\.\w/", "IPT", $parts);
        echo '<pre>';
        var_dump($array) . '<br>';
        echo '</pre>';
    }

    fclose($fn);

    // Write processed string into a new file.

    ?>


</body>

</html