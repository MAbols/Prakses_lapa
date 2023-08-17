<!-- views/navbar.html -->
<!DOCTYPE html>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="<?= ($BASE) ?>/">
            Pacientu informācijas sistēma
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class=" navbar-collapse collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?= ($BASE) ?>/add">Pievienot jaunu pacientu</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= ($BASE) ?>/login">
                        Iziet
                    </a>
                </li>
                <!-- Add more navigation links if needed -->
            </ul>
        </div>
    </div>
</nav>
<!-- Include jQuery (required by Bootstrap) -->
<!--<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>-->

<!-- Include Bootstrap JavaScript -->
<script src="vendor/twbs/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- Include Bootstrap CSS -->
<link rel="stylesheet" type="text/css" href="vendor/twbs/bootstrap/dist/css/bootstrap.min.css">
