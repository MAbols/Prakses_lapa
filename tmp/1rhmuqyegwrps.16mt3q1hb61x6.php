<!DOCTYPE html>
<html>
<head>
    <title>Sākums</title>
    <base href="<?= ($BASE) ?>">
    <link rel="stylesheet" type="text/css" href="vendor/twbs/bootstrap/dist/css/bootstrap.min.css">
    <style>
        /* Add custom CSS here if needed */
        .edit-button {
            margin-right: 5px;
        }

        /* Make text in Slimība 1 and Slimība 2 columns wrap */
        .table td.slimiba-column {
            white-space: normal;
            word-wrap: break-word;
            overflow-wrap: break-word;
        }
    </style>
    <script>
        function confirmDelete() {
            return confirm("Vai tiešām vēlaties dzēst šo pacientu?");
        }
    </script>
</head>
<body>
    <div class="container">
        <h1 class="text-center my-4">Pacientu informācija</h1>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Vārds</th>
                        <th>Uzvārds</th>
                        <th>Personas kods</th>
                        <th class="slimiba-column">Slimība 1</th>
                        <th class="slimiba-column">Slimība 2</th>
                        <th>Slimība 3</th>
                        <th>Dzimums</th>
                        <th>Darbība</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach (($patients?:[]) as $patient): ?>
                        <tr>
                            <td><?= ($patient['Vards']) ?></td>
                            <td><?= ($patient['Uzvards']) ?></td>
                            <td><?= ($patient['Personas_kods']) ?></td>
                            <td class="slimiba-column"><?= ($patient['Slimiba_1']) ?></td>
                            <td class="slimiba-column"><?= ($patient['Slimiba_2']) ?></td>
                            <td><?= ($patient['Slimiba_3']) ?></td>
                            <td><?= ($patient['Dzimums']) ?></td>
                            <td>
                                <a href="<?= ($BASE) ?>/update-patient/<?= ($patient['Pacienta_id']) ?>" class="btn btn-primary edit-button">Rediģēt</a>
                                <a href="<?= ($BASE) ?>/delete-patient/<?= ($patient['Pacienta_id']) ?>" class="btn btn-danger" onclick="return confirmDelete()">Dzēst</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Include Bootstrap JavaScript -->
    <script src="vendor/twbs/bootstrap/dist/js/bootstrap.min.js"></script>
</body>
</html>
