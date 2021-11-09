<?php
if (!empty($_POST)) {
    $tempsAnyo = filter_input(INPUT_POST, 'temps', FILTER_VALIDATE_INT, FILTER_REQUIRE_ARRAY);
    $tmaxsAnyo = array_column($tempsAnyo, 'Tmax');
    $tminsAnyo = array_column($tempsAnyo, 'Tmin');

    array_multisort(
            $tmaxsAnyo, SORT_NUMERIC, SORT_DESC, $tminsAnyo, SORT_NUMERIC, SORT_DESC, $tempsAnyo);
} else {
    $meses = array_map(function ($n) {
        return (strftime("%B", mktime(0, 0, 0, $n)));
    }, range(1, 12));
}
?>

<html>
    <head>
        <title>Temperaturas de Madrid</title>
        <meta name="viewport" content="width=device-width">
        <meta charset="UTF-8">
        <link rel="stylesheet" href="stylesheet.css">
    </head>
    <body>
        <h1>Temperaturas de Madrid</h1>  
        <div class="main-section">
            <?php if (empty($_POST)): ?>
                <form name="form_temps" 
                      action="index.php" method="POST">
                    <div tables-section>                   
                        <div class='table-data'>
                            <h2>Madrid</h2>
                            <table>
                                <tr>
                                    <th>Mes</th>
                                    <th>Temp</th>
                                </tr>
                                <?php foreach ($meses as $mes): ?>
                                    <tr>
                                        <td><?= $mes ?></td>                                               
                                        <td>
                                            <input type="number" maxlength="2" size="2" 
                                                   name=<?= "temps[$mes][Tmax]" ?> value= '<?= mt_rand(5, 50) ?>' />
                                            <input type="number" maxlength="2" size="2" 
                                                   name=<?= "temps[$mes][Tmin]" ?> value= '<?= mt_rand(-25, 20) ?>' />
                                        </td>                              
                                    </tr>
                                <?php endforeach ?>
                            </table>
                        </div>                   
                    </div>
                    <input class="submit" type="submit" value="Send" name="tempsbutton" />
                </form>
            <?php else: ?>
                <h2>Madrid</h2>
                <table>
                    <tr>
                        <th>Month</th>
                        <th>Temp</th>
                    </tr>
                    <?php foreach ($tempsAnyo as $mes => $temps): ?>
                        <tr>
                            <td><?= $mes ?></td> 
                            <td><?= $temps['Tmax'] ?></td>
                            <td><?= $temps['Tmin'] ?></td> 
                        </tr>
                    <?php endforeach ?>
                </table>
            <?php endif; ?>
        </div>
    </body>
</html>




