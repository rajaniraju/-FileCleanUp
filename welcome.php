<html>

<body>

    <?php
    $fn = fopen("c:\\Temp\\test_data_in.txt", "r");
    $headerProcessed = false;
    $processedList = [["ID", "First", "Last", "Type", "Eff.", "Term"]];
    $mArray = [];
    $dArray = [];
    $lArray = [];

    while (!feof($fn)) {
        // Read 1 line at a time.
        $result = fgets($fn);

        // Ignore title.
        if ($headerProcessed == false) {
            $headerProcessed = true;
            continue;
        }

        // Split the line by tab.
        $parts = preg_split('/\t+/', $result);

        // Process each word
        $processedLine = [];
        // $parts[0] = ID        
        $number = 'xxx-xx-' . substr($parts[0], -4);
        array_push($processedLine, $number);

        // $parts[1] = fname
        //preg_replace($parts[1]) 
        $fname = preg_replace('/[\W]/', '', $parts[1]);
        $fname = preg_replace('/[0-9]+/', '', $fname);
        array_push($processedLine, $fname);

        // $parts[2] = lname
        $lname = preg_replace('/[\W]/', '', $parts[2]);
        //$laname = preg_replace('/[0-9]+/', '', $lname);
        array_push($processedLine, $lname);

        // $parts[3] = type
        $type = $parts[3];
        array_push($processedLine, $type);

        // $parts[4] = effective
        array_push($processedLine, $parts[4]);

        // Compute  new column 'Term'.
        $time = strtotime($parts[4]);
        $term = date('Y-m-d', $time);
        $mod_date = date('Y-m-d', strtotime($term . ' + 100 days'));
        array_push($processedLine, $mod_date);

        // 1. Convert string to date object
        // 2. Add 100 days to date object.
        // 3. add the result as 'Term'

        switch (strtoupper($type)) {
            case "M":
                array_push($mArray, $processedLine);
                break;
            case "L":
                array_push($lArray, $processedLine);
                break;
            case "D":
                array_push($dArray, $processedLine);
                break;
        }

        // Add procesed word to another string
        echo '<pre>';
        print($result);
        echo '</pre>';
    }

    fclose($fn);
    $processedList = array_merge($mArray, $dArray, $lArray);

    // Write processed string into a new file.
    // TODO

    ?>
    <table>
        <?php

        foreach ($processedList as $line) {
            echo "<tr>";
            foreach ($line as $header) {
                echo "<td>";
                print ($header) . "\t&nbsp;&nbsp;";
                echo "</td>";
            }
            echo "</tr>";
        }
        ?>
    </table>
</body>

</html