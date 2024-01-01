<!--
    Author : Jang Ho chan
    Date : 2024-01-01
    Title : Login Web Server Practice
-->

<?
session_start();
header("Content-Type: text/html; charset=UTF-8");
$mode = $_REQUEST["mode"];
$page = basename($_SERVER["PHP_SELF"]);
$inputId = $_POST["inputId"];
$inputPw = $_POST["inputPw"];
$accessId = "6ce6cec0af1a41597e71abe9a16211ab";
$accessPw = "6c9f5226ab5969aa7a4da15a41e849fe";
$accessFlag = $_SESSION["accessFlag"];
$loginFailed = false;

if ($accessFlag == "Y") {
    if ($mode == "logout") {
        unset($_SESSION["accessFlag"]);
        session_destroy();
        echo "<script>location.href='{$page}'</script>";
        exit();
    }
} else {
    if ($mode == "login") {
        if ($accessPw == md5($inputPw) && $accessId == md5($inputId)) {
            $_SESSION["accessFlag"] = "Y";
            echo "<script>location.href='{$page}'</script>";
            exit();
        }else {
            $loginFailed = true;
        }
    }
    } 


?>

<!doctype html>
<html lang="kr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>

<body>
    <div class="container text-center">
        <div class="row">
            <div class="col"></div>
            <div class="col-6">
                <? if ($accessFlag != "Y") { ?>
                    <? if ($loginFailed) { ?>
                        <div class="alert alert-danger" role="alert">
                            로그인 실패!
                        </div>
                    <? } ?>
                    <h2>Login</h2>
                    <hr>
                    <form action="<? $page ?>?mode=login" method="POST">
                        <div class="form-floating mb-3">
                            <input type="Id" class="form-control" placeholder="Id" name="inputId">
                            <label for="floatingInput">Id</label>
                        </div>
                        <div class="form-floating">
                            <input type="password" class="form-control" placeholder="Password" name="inputPw">
                            <label for="floatingPassword">Password</label>
                        </div>
                        <br>
                        <p class="text-center"><button type="submit" class="btn btn-dark">로그인</button>
                    </form>
                <? } else { ?>
                    <h3>Login success</h3>
                    <hr>
                    <div class="d-flex justify-content-center">
                        <form action="<? $page ?>?mode=logout" method="POST">
                            <p class="text-center"><button type="submit" class="btn btn-outline-dark">로그아웃</button>
                        </form>
                    </div>
                    </ul>
                    <br>
                <? } ?>
            </div>
            <div class="col"></div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>

</html>
