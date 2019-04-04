<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>

    <?php
    $name = $_POST["name"];
    $fn = $_POST["fn"];
    $mark = $_POST["mark"];


    if (strlen($name) > 200 || strlen($name) < 1) {
        echo "<h1>Please, enter shorter name.</h1>";
    }

    if ($fn < 62000 || $fn > 62999) {
        echo "<h1>Please, enter a valid fn between 62000 and 62999.</h1>";
    }

    if ($mark < 2 || $mark > 6) {
        echo "<h1>Please, enter a valid mark between 2.00 and 6.00.</h1>";
    }

    $students = [
        ['name' => 'Мария Георгиева', 'fn' => 62543, 'mark' => 5.25],

        ['name' => 'Иван Иванов', 'fn' => 62555, 'mark' => 6.00],

        ['name' => 'Петър Петров', 'fn' => 62549, 'mark' => 5.00],

        ['name' => 'Петя Димитрова', 'fn' => 62559, 'mark' => 6.00]
    ];

    array_push($students, ["name" => $name, "fn" => $fn, "mark" => $mark]);

    foreach ($students as &$student) {
        echo "<h3>" . $student["name"] . " " . $student["fn"] . " " . $student["mark"] . "</h3>";
    }
    ?>

</body>

</html>