<html>

<body>

    <?php
    $fn = fopen("c:\\Temp\\test_data_in.txt", "r");
    $headerProcessed = false;
    $processedList = [["ID", "First", "Last", "Type", "Eff.", "Term"]];

    while (!feof($fn)) {
        // Read 1 line at a time.
        $result = fgets($fn);

        // Ignore title.
        // if ($headerProcessed == false) {
        //     $headerProcessed = true;
        //     continue;
        // }

        // Split the line by tab.
        $parts = preg_split('/\s+/', $result);
        // $parts[0] = ID
        // $parts[1] = fname
        // $parts[2] = lname
        // $parts[3] = type
        // $parts[4] = effective

        // Process each word
        

        // Add procesed word to another string
        echo '<pre>';
        print ($result);
        echo '</pre>';
    }

    fclose($fn);

    foreach ($processedList as $line) {
        foreach ($line as $header) {
            print($header) . "\t&nbsp;&nbsp;";
        }
        echo '</br>';
    }

    // Write processed string into a new file.

    ?>


</body>

</html