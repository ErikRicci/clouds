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
<div class="flex gap-large" style="padding-left: var(--large-padding); padding-right: var(--large-padding)">
    <!-- FOLLOWERS TOTAL-->
    <div class="dashboard-group flex-column gap-medium w-100 p-lg" style="justify-content: space-between">
        <div style="display: flex; width: 100%; justify-content: space-between">
            <div style="
                        background-color: rgba(0,111,255,0.25);
                        border-radius: 1000px;
                        aspect-ratio : 1 / 1;
                        width: 24px;
                        height: 24px;
                        padding: 16px;
                        display: flex;
                        justify-content: center;
                        align-items: center;
                        cursor: default;
                        user-select: none;
                    ">
                <span style="color: rgb(0,149,255);" class="material-symbols-rounded">groups</span>
            </div>
<!--            <span style="color: var(--lighter-grey); user-select: none; align-self: start; cursor: pointer" class="material-symbols-outlined">more_horiz</span>-->
        </div>
        <div class="flex-column gap-small">
            <div style="font-size: var(--big-font)"><b><?php echo $followers_count; ?></b></div>
            <div class="flex" style="justify-content: space-between; align-items: center">
                <span style="color: var(--lighter-grey); font-weight: bold">Total followers</span>
            </div>
        </div>
    </div>
    <!-- NEW FOLLOWERS -->
    <div class="dashboard-group flex-column gap-medium w-100 p-lg" style="justify-content: space-between">
        <div style="display: flex; width: 100%; justify-content: space-between">
            <div style="
                        background-color: rgba(0,100,0,0.25);
                        border-radius: 1000px;
                        aspect-ratio : 1 / 1;
                        width: 24px;
                        height: 24px;
                        padding: 16px;
                        display: flex;
                        justify-content: center;
                        align-items: center;
                        cursor: default;
                        user-select: none;
                    ">
                <span style="color: mediumseagreen;" class="material-symbols-rounded">emoji_people</span>
            </div>
<!--            <span style="color: var(--lighter-grey); user-select: none; align-self: start; cursor: pointer" class="material-symbols-outlined">more_horiz</span>-->
        </div>
        <div class="flex-column gap-small">
            <div style="font-size: var(--big-font)">
                <b><?php echo $new_followers; ?></b><span style="font-size: var(--small-font); color: mediumseagreen"> (<?php echo $yesterday_new_followers;?>)</span>
            </div>
            <div class="flex" style="justify-content: space-between; align-items: center">
                <span style="color: var(--lighter-grey); font-weight: bold">Today's new followers</span>
                <?php if ($new_followers_percentage_change_since_yesterday >= 0) { ?>
                    <div class="p-xs br-sm" style="background-color: rgba(0,100,0,0.25)">
                        <span style="font-weight: bold; color: mediumseagreen">+ <?php echo $new_followers_percentage_change_since_yesterday ?>%</span>
                    </div>
                <?php } else { ?>
                    <div class="p-xs br-sm" style="background-color: rgba(100,0,0,0.25)">
                        <span style="font-weight: bold; color: indianred">- <?php echo $new_followers_percentage_change_since_yesterday ?>%</span>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <!-- LEAVING FOLLOWERS-->
    <div class="dashboard-group flex-column gap-medium w-100 p-lg" style="justify-content: space-between">
        <div style="display: flex; width: 100%; justify-content: space-between">
            <div style="
                        background-color: rgba(100,0,0,0.25);
                        border-radius: 1000px;
                        aspect-ratio : 1 / 1;
                        width: 24px;
                        height: 24px;
                        padding: 16px;
                        display: flex;
                        justify-content: center;
                        align-items: center;
                        cursor: default;
                        user-select: none;
                    ">
                <span style="color: indianred;" class="material-symbols-rounded">directions_run</span>
            </div>
<!--            <span style="color: var(--lighter-grey); user-select: none; align-self: start; cursor: pointer" class="material-symbols-outlined">more_horiz</span>-->
        </div>
        <div class="flex-column gap-small">
            <div style="font-size: var(--big-font)">
                <b><?php echo $leaving_followers; ?></b><span style="font-size: var(--small-font); color: indianred"> (<?php echo $yesterday_leaving_followers;?>)</span>
            </div>
            <div class="flex" style="justify-content: space-between; align-items: center">
                <span style="color: var(--lighter-grey); font-weight: bold">Today's leaving followers</span>
                <?php if ($new_followers_percentage_change_since_yesterday <= 0) { ?>
                    <div class="p-xs br-sm" style="background-color: rgba(0,100,0,0.25)">
                        <span style="font-weight: bold; color: mediumseagreen">- <?php echo $leaving_followers_percentage_change_since_yesterday ?>%</span>
                    </div>
                <?php } else { ?>
                    <div class="p-xs br-sm" style="background-color: rgba(100,0,0,0.25)">
                        <span style="font-weight: bold; color: indianred">+ <?php echo $leaving_followers_percentage_change_since_yesterday ?>%</span>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <!-- GODS TOTAL-->
    <div class="dashboard-group flex-column gap-medium w-100 p-lg" style="justify-content: space-between">
        <div style="display: flex; width: 100%; justify-content: space-between">
            <div style="
                        background-color: rgba(255,213,0,0.25);
                        border-radius: 1000px;
                        aspect-ratio : 1 / 1;
                        width: 24px;
                        height: 24px;
                        padding: 16px;
                        display: flex;
                        justify-content: center;
                        align-items: center;
                        cursor: default;
                        user-select: none;
                    ">
                <span style="color: rgb(255,166,0);" class="material-symbols-rounded">person_4</span>
            </div>
<!--            <span style="color: var(--lighter-grey); user-select: none; align-self: start; cursor: pointer" class="material-symbols-outlined">more_horiz</span>-->
        </div>
        <div class="flex-column gap-small">
            <div style="font-size: var(--big-font)"><b><?php echo $gods_count; ?></b></div>
            <div class="flex" style="justify-content: space-between; align-items: center">
                <span style="color: var(--lighter-grey); font-weight: bold">Total Gods</span>
            </div>
        </div>
    </div>
</div>
</body>
</html>