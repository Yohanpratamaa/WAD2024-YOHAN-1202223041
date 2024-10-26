<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Program Pola Makan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h3 class="text-center">Atur Pola Makan Anda</h3>
            <form action="result.php" method="POST">
                <div class="mb-3">
                    <label for="exercise" class="form-label">Berapa lama Anda berolahraga hari ini? (dalam menit)</label>
                    <input type="number" class="form-control" id="exercise" name="exercise" required value="<?= isset($waktu_olahraga) ? $waktu_olahraga : ''; ?>">
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
