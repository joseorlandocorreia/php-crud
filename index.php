<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP CRUD</title>
</head>

<body>
    <?php require_once "process.php"; ?>

    <?php
    if (isset($_SESSION["message"])) : ?>
        <div class="alert alert-<?= $_SESSION["msg_type"] ?>">
            <?php
            echo $_SESSION["message"];
            unset($_SESSION["message"]);
            ?>
        </div>
    <?php endif ?>

    <div class="container">
        <?php
        $mysqli = new mysqli("localhost", "root", "", "crud-php") or die(mysqli_error($mysqli));

        $result = $mysqli->query("SELECT * FROM data") or die($mysqli->error);
        ?>

        <div class="row justify-content-center">

            <table class="table">
                <thead>
                    <th>Name</th>
                    <th>Location</th>
                    <th colspan="2">Action</th>
                </thead>
                <?php
                while ($row = $result->fetch_assoc()) : ?>
                    <tr>
                        <td><?php echo $row["name"]; ?></td>
                        <td><?php echo $row["location"]; ?></td>
                        <td>
                            <a href="index.php?edit=<?php echo $row['id']; ?>" class="btn btn-info">Edit</a>
                            <a href="process.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                <?php endwhile ?>
            </table>
        </div>

        <?php

        function pre_r($array)
        {
            echo '<pre>';
            print_r($array);
            echo '</pre>';
        }
        ?>
        <script src=" https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

        <div class="row justify-content-center">
            <input type="hidden" name="id" value="<?php echo $id; ?>" />
            <form action="process.php" method="POST">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" name="name" placeholder="Enter your name" value="<?php echo $name; ?>">
                </div>
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" name="location" value="<?php echo $location; ?>" placeholder=" Enter your location">
                </div>
                <div class="form-group">
                    <?php if ($update == true) : ?>
                        <button type="submit" class="btn btn-info" name="update">Update</button>
                    <?php else : ?>
                        <button type="submit" class="btn btn-primary" name="save">Save</button>
                    <?php endif ?>
                </div>
            </form>
        </div>

    </div>


</body>

</html>