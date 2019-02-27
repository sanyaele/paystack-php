<?php
// Just fooling around
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sample</title>
    <style>
    .left-inner-addon {
        position: relative;
    }
    .left-inner-addon input {
        padding-left: 35px;    
    }
    .left-inner-addon span {
        position: absolute;
        padding: 7px 12px;
        pointer-events: none;
    }
    </style>
</head>
<body>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    Here is the result:
    <?php
    if (!empty($_POST['show'])){
        echo $_POST['show'];
    }
    ?>
    <br>
    <div class="col-xs-6" >
        <div class="left-inner-addon">
            <span>NGN</span>
            <input type="text" class="form-control" placeholder="Amount" />
        </div>
    </div>
    <div class="col-xs-6" >
        <div class="right-inner-addon">
            <span>NGN</span>
            <input type="search" class="form-control" placeholder="Amount" />
        </div>
    </div>

    <div class="col-xs-6" >
        <div class="left-inner-addon">
            <span>NGN</span>
            <input type="number" class="form-control" placeholder="Amount" />
        </div>
    </div>

    <div class="input-group">
        <label class="input-group-addon">NGN</label>
        <input type="text" class="form-control" placeholder="price">
    </div>


    <div class="input-group">
        <span class="input-group-addon">$</span>
        <input type="number" class="form-control" placeholder="price">
    </div>
    <br>
    <input type="text" id="show" name="show">
    <button type="submit">Submit</button>
    </form>
</body>
</html>