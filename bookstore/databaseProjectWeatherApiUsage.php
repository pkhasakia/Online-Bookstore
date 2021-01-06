<html>
    <body>
        <?php

        session_start();  
        include("connect.php"); 

        $opts = [
            'http' => [
                'method' => 'GET',
                'header' => [
                    "User-Agent: PHP"
                ]
            ]
        ];


        $url="https://samples.openweathermap.org/data/2.5/weather?q=paris&appid=c8c03ed362991ec07782cd2fd2d94912";

        $context = stream_context_create($opts);
        $json = file_get_contents($url, false, $context);
        $json = json_decode($json, true);

    //    var_dump($json);
    //    var_dump($json['weather'][0]['id']);

        $id=$json['weather'][0]['id'];
        $main=$json['weather'][0]['main'];
        $description=$json['weather'][0]['description'];

       // var_dump($main);

        //Inserting Values

        $query = "INSERT INTO weather(id, main, description)
                    VALUES ('$id','$main','$description')";
        mysqli_query($db, $query);

        //Queries
         $descriptionDisplay = "SELECT description FROM WEATHER";
            $result = mysqli_query($db, $descriptionDisplay);
            $display = mysqli_fetch_assoc($result);

        $mainDisplay = "SELECT main FROM WEATHER";
        $result = mysqli_query($db, $mainDisplay);
        $display = mysqli_fetch_assoc($result);
    ?>
    </body>
</html>