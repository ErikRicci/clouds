<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gods</title>
    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../../../css/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,700,0,0" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
</head>
<style>
    body {
        color: white;
        background-color: var(--grey);
    }
</style>
<body>
<?php require __DIR__."/../../components/header.php" ?>
<div class="flex-column gap-large px-lg pt-lg">
    <div class="flex gap-large">
        <?php
        echo \Clouds\HTML\Components\Card\Card::render(
            "Novos seguidores",
            $followers_count,
            color: 'blue',
            icon: 'groups',
        );
        echo \Clouds\HTML\Components\Card\PercentageRateCard::render(
            "Novos seguidores",
            $new_followers_percentage_change_since_yesterday,
            $new_followers,
            $yesterday_new_followers,
            icon: 'emoji_people'
        );
        echo \Clouds\HTML\Components\Card\PercentageRateCard::render(
            "Seguidores perdidos",
            $leaving_followers_percentage_change_since_yesterday,
            $leaving_followers,
            $yesterday_leaving_followers,
            inverse: true,
            color: 'red',
            icon: 'directions_run'
        );
        echo \Clouds\HTML\Components\Card\Card::render(
            "Deuses",
            $gods_count,
            color: 'yellow',
            icon: 'person_4',
        );
        ?>
    </div>
    <div class="flex gap-large">
        <?php
        echo \Clouds\HTML\Components\Card\Card::render(
            "Deuses",
            $gods_count,
            color: 'yellow',
            icon: 'person_4',
        );
        ?>
    </div>
</div>
</body>
</html>