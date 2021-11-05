<?php
if (!empty($_POST)) {
    $temps = filter_input(INPUT_POST, 'temps', FILTER_VALIDATE_INT, FILTER_REQUIRE_ARRAY);
} else {
    $months = array_map(function ($n) {
        return (strftime("%B", mktime(0, 0, 0, $n)));
    }, range(1, 12));
}
?>

<html>
    <head>
        <title>Tempraturas de Madrid</title>
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
                                    <th>Month</th>
                                    <th>Temp</th>
                                </tr>
                                <?php foreach ($months as $month): ?>
                                    <tr>
                                        <td><?= $month ?></td>                                               
                                        <td>
                                            <input type="number" maxlength="2" size="2" 
                                                   name='<?= "temps[$month]" ?>' />
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
                    <?php foreach ($temps as $month => $temp): ?>
                        <tr>
                            <td><?= $month ?></td> 
                             <td><?= $temp ?></td>     
                        </tr>
                    <?php endforeach ?>
                </table>
            <?php endif; ?>
        </div>
    </body>
</html>




