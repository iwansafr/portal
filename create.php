<?php

// set page headers
$page_title = "Create User";
include_once "header.php";

// read user button
echo "<div class='right-button-margin'>";
    echo "<a href='index.php' class='btn btn-info pull-right'>";
        echo "<span class='glyphicon glyphicon-list-alt'></span> Read Users ";
    echo "</a>";
echo "</div>";

// get database connection
include_once 'classes/database.php';
include_once 'initial.php';

// check if the form is submitted
if ($_POST){

    // instantiate user object
    include_once 'classes/user.php';
    $user = new User($db);

    // set user property values
    $user->firstname = htmlentities(trim($_POST['firstname']));
    $user->lastname = htmlentities(trim($_POST['lastname']));
    $user->phone = htmlentities(trim($_POST['phone']));


    // if the user able to create
    if($user->create()){
        echo "<div class=\"alert alert-success alert-dismissable\">";
            echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">
                        &times;
                  </button>";
            echo "Success! User is created.";
        echo "</div>";
    }

    // if the user unable to create
    else{
        echo "<div class=\"alert alert-danger alert-dismissable\">";
            echo "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">
                        &times;
                  </button>";
            echo "Error! Unable to create user.";
        echo "</div>";
    }
}
?>

<!-- Bootstrap Form for creating a user -->
<form action='create.php' role="form" method='post'>

    <table class='table table-hover table-responsive table-bordered'>
        <tr>
            <td>First Name</td>
            <td><input type='text' name='firstname'  class='form-control' placeholder="Enter First Name" required></td>
        </tr>
        <tr>
            <td>Last Name</td>
            <td><input type='text' name='lastname' class='form-control' placeholder="Enter Last Name" required></td>
        </tr>
        <tr>
            <td>Mobile Number</td>
            <td><input type='number' name='phone' class='form-control' placeholder="Enter Mobile Number" required></td>
        </tr>

        <tr>
            <td></td>
            <td>
                <button type="submit" class="btn btn-primary">
                    <span class="glyphicon glyphicon-plus"></span> Create
                </button>
            </td>
        </tr>

    </table>
</form>

<?php
include_once "footer.php";
?>

