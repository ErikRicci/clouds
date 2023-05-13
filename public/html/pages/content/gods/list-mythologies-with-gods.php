<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gods</title>
    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../../../../css/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,700,0,0" />
</head>
<style>
    body {
        color: white;
        background-color: var(--grey);
    }
</style>
<body>
<?php require __DIR__."/../../../components/header.php" ?>
<div class="flex-column gap-large">
    <div class="flex gap-large">
        <?php for ($i = 0; $i < 4; $i++) { ?>
            <div class="dashboard-group flex-column gap-medium w-100 p-lg">
                <div style="display: flex; width: 100%; justify-content: space-between">
                    <div style="
                        background-color: rgba(0,111,255,0.25);
                        border-radius: 1000px;
                        aspect-ratio : 1 / 1;
                        width: 24px;
                        padding: 4px;
                        display: flex;
                        justify-content: center;
                        align-items: center;
                        cursor: default;
                        user-select: none;
                    ">
                        <span style="color: rgb(0,111,255);" class="material-symbols-rounded">emoji_people</span>
                    </div>
                    <span style="color: var(--lighter-grey); user-select: none; align-self: start; cursor: pointer" class="material-symbols-outlined">more_horiz</span>
                </div>
                <div class="flex-column gap-small">
                    <div style="font-size: var(--big-font)"><b>1000</b></div>
                    <div class="flex" style="justify-content: space-between; align-items: center">
                        <span>Today's followers</span>
                        <div class="p-xs br-sm" style="background-color: rgba(0,100,0,0.25)">
                            <span style="font-weight: bold; color: mediumseagreen">+ 40%</span>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
    <div class="dashboard-group w-100">
        <?php
            foreach ($mythologies as $mythology) {
                echo "<span style='font-size: 24px; font-weight: bold'>"
                    .gak($mythology, 'name')." (".gak($mythology, 'gods_count', 0).")".
                    "</span>";
                echo "<br>";
                if (gak($mythology, 'gods')) {
                    foreach (gak($mythology, 'gods', []) as $god) {
                        echo "<span>L ".gak($god, 'name')."</span>";
                        echo "<br>";
                    }
                } else {
                    echo "<span style='color: red'>NO GODS AVAILABLE YET!</span>";
                    echo "<br>";
                }
            }
        ?>
    </div>
</div>
</body>
<script>
    $("#addNewGodBtn").on('click', () => toggleDialog("addNewGodDialog"));

    function toggleDialog(dialogId) {
        dialogDom = document.getElementById(dialogId);
        currentState = dialogDom.style.getPropertyValue("display");
        newState = currentState === "none" ? "flex" : "none";
        dialogDom.style.setProperty("display", newState)
    }
</script>
</html>