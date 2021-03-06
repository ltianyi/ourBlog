<?php
//获取地址中的action
if (isset($_GET["action"])) {
    $action = $_GET["action"];
} else {
    header("Location: /admin/index.php");
    exit;
}
include("./csrf.php");
include("./database.php");
include("../model/main.php");
session_start();
header("content-type:text/html;charset=utf-8");

switch ($action) {
    //登录判断
    case "login":
        try {
            $user_id = login($_POST, $dbh);
        } catch (InvalidArgumentException $e) {
            echo "<script>alert('".$e->getMessage()."');window.location.href='../admin/login.php'</script>";
            exit;
        } catch (Exception $e) {
            echo "System error";
            exit;
        }
        if ($user_id == false) {
            echo "<script>alert('用户名或密码错误');window.location.href='../admin/login.php'</script>";
            exit;
        }
        $_SESSION['uid'] = $user_id;
        session_regenerate_id();
        header('Location: /admin/index.php');
        break;

    //添加文章
    case "add":
        $user_id = loginCheck();

        try {
            addArticle($_POST, $dbh, $user_id);
        } catch (InvalidArgumentException $e) {
            echo "<script>alert('".$e->getMessage()."');window.location.href='../admin/add.php'</script>";
            exit;
        } catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }

        echo "<script>alert('添加成功');window.location.href='../admin/index.php';</script>";

        break;

    //修改文章
    case "edit":
        $user_id = loginCheck();
        $article_id = isset($_GET['id']) ? $_GET['id'] : null;
        $article_id = filter_var($article_id, FILTER_VALIDATE_INT, array("options" => array("min_range" => 1)));
        if (!$article_id) {
            echo "<script>alert('非法的文章id');window.location.href='../admin/index.php'</script>";
            exit;
        }

        try {
            editArticle($_POST, $dbh, $user_id, $article_id);
        } catch (InvalidArgumentException $e) {
            echo "<script>alert('".$e->getMessage()."');window.location.href='../admin/edit.php?id={$article_id}'</script>";
            exit;
        } catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }

        echo "<script>alert('修改成功');window.location.href='../admin/index.php';</script>";

        break;

    //删除文章
    case "delete":
        $user_id = loginCheck();
        $article_id = isset($_GET['id']) ? $_GET['id'] : null;
        $article_id = filter_var($article_id, FILTER_VALIDATE_INT, array("options" => array("min_range" => 1)));
        if (!$article_id) {
            echo "<script>alert('非法的文章id');window.location.href='../admin/index.php'</script>";
            exit;
        }

        try {
            deleteArticle($dbh, $user_id, $article_id);
        } catch (InvalidArgumentException $e) {
            echo "<script>alert('".$e->getMessage()."');window.location.href='../admin/index.php'</script>";
            exit;
        } catch (Exception $e) {
            echo $e->getMessage();
            exit;
        }

        echo "<script>alert('删除成功');window.location.href='../admin/index.php';</script>";
        break;
}

function loginCheck()
{
    if (!isset($_SESSION["uid"])) {
        echo "<script>alert('请登录');window.location.href='../admin/login.php';</script>";
        exit;
    }
    return $_SESSION["uid"];
}
