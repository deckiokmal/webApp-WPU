<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/style.css">
</head>

<body>
    <?= $this->include('layout/navbar'); ?>
    <?= $this->renderSection('content'); ?>
    <?= $this->include('layout/footer'); ?>

    <script>
        function previewImg() {
            const KTP = document.querySelector('#KTP');
            const ktpLabel = document.querySelector('.form-control');
            const imgPreview = document.querySelector('.img-preview');

            ktpLabel.textContent = KTP.files[0].name;

            const filesktp = new FileReader();
            filesktp.readAsDataURL(KTP.files[0]);

            filesktp.onload = function(e) {
                imgPreview.src = e.target.result;
            }
        }
    </script>
</body>

</html>