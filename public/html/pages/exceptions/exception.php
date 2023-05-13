<!DOCTYPE html>
<html lang="pt">
<head>
    <title>Exception</title>
</head>
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        border: none;
        font-family: sans-serif;
    }
</style>
<body style="background-color: #4f4f4f">
<div style="background-color: #799ad9; padding: 4px 10vw;">
    <span style="font-size: 12px; color: white"><?php echo "\\".$exception::class; ?></span>
</div>
<div style="background-color: cornflowerblue; padding: 12px 10vw;">
    <span style="font-size: 24px; color: white"><?php echo $exception->getMessage(); ?></span>
</div>
<div style="background-color: #5477b7; padding: 4px 10vw;">
    <span style="font-size: 12px; color: white"><?php echo $exception->getFile(); ?></span>
</div>
<div style="padding: 8px 10vw; display: flex; flex-flow: column; gap: 16px; font-size: 12px">
    <?php
        echo "<div style='background-color: #3a3a3a; color: white; padding: 12px; border-radius: 12px; border: solid #919191 1px'>";
        echo vsprintf("<div>in <b>%s</b>:%s</div>", [$exception->getFile(), $exception->getLine()]);
        echo "</div>";
        foreach ($exception->getTrace() as $index => $trace) {
            echo "<div style='background-color: #3a3a3a; color: white; padding: 12px; border-radius: 12px; border: solid #919191 1px'>";
            echo vsprintf("<div>in <b>%s</b>:%s, method: %s</div>", [gak($trace, "file"), gak($trace, "line"), gak($trace, "function")]);
            echo "</div>";
        }
    ?>
</div>
</body>
</html>