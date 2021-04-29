<html>

<body>

    <?php
    $current = $fn = fopen("c:\\Temp\\test_data_in.txt", "r");
    $headerProcessed = false;
    $processedList = [["ID", "First", "Last", "Type", "Eff.", "Term"]];
    $mArray = [];
    $dArray = [];
    $lArray = [];
//checking
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
        //ToDo - Move to a common function
        $fname = preg_replace('/[\W]/', '', $parts[1]);
        $fname = preg_replace('/[0-9]+/', '', $fname);
        array_push($processedLine, $fname);

        // $parts[2] = lname
        $lname = preg_replace('/[\W]/', '', $parts[2]);
        $lname = preg_replace('/[0-9]+/', '', $lname);
        array_push($processedLine, $lname);

        // $parts[3] = type
        $type = $parts[3];
        array_push($processedLine, $type);

        // $parts[4] = effective
        $effective = $parts[4];
        $effective = str_replace("\n", "", $effective);
        array_push($processedLine, $effective);

        // Compute  new column 'Term'.
        // 1. Convert string to date object
        // 2. Add 100 days to date object.
        // 3. add the result as 'Term'
        $time = strtotime($parts[4]);
        $term = date('Y-m-d', $time);
        $mod_date = date('Y-m-d', strtotime($term . ' + 100 days'));
        $timestamp = strtotime($mod_date);
        $weekday = date("l", $timestamp);
        $normalized_weekday = strtolower($weekday);
        //check weekend
        if ($normalized_weekday == "saturday") {
            $modified1_date = date('Y-m-d', strtotime($mod_date . ' + 2 days'));
            array_push($processedLine, $modified1_date);
        } else if ($normalized_weekday == "sunday") {
            $modified2_date = date('Y-m-d', strtotime($mod_date . ' + 1 day'));
            array_push($processedLine, $modified2_date);
        } else {
            array_push($processedLine, $mod_date);
        }

        //Push depending on M,L,D

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
    $outputText = "ID\tFIRST\tLAST\tTYPE\tEFFECTIVE\tTERM\n";

    ?>
    <table>
        <?php

        foreach ($processedList as $lineArray) {
            echo "<tr>";
            $outputLine = "";
            foreach ($lineArray as $columnValue) {
                echo "<td>";
                print ($columnValue) . "\t&nbsp;&nbsp;";
                $outputLine = $outputLine . $columnValue . "\t";
                echo "</td>";
            }
            $outputText = $outputText . $outputLine . "\n";
            echo "</tr>";
        }

        // Creating output file.
        file_put_contents("test_data_out.txt", $outputText);
        ?>
    </table>

</body>

</html