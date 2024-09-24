<?php
    define('USERNAME', 'laravel_user');
    define('PASSWORD', 'laravel_pass');

    $error_message = null;

    require_once('db_connect.php');
    
        try {
            //データベースに接続
            $db = db_connect();
            //接続確認が取れた
            }catch (PDOException $e) {
            //接続に失敗した
            $isConnect = false;
        }
        if ($title == "") {
            $error_message = "タイトルを入力してください。";
        } else if (strlen($title) > 20) {
            $error_message = "タイトルは20文字以内で入力してください。";
        } else if (strlen($text) > 200) {
            $error_message = "内容は200文字以内で入力してください。";
        }  else {

            // レコード追加
            $sql = "INSERT INTO `TodoList`(`Titel`, `Text`) VALUES (:title, :text)";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':title', $_POST['title'], PDO::PARAM_STR);
            $stmt->bindParam(':text', $_POST['text'], PDO::PARAM_STR);
            $res = $stmt->execute();

            if (!$res){
                print('データの追加に失敗しました<br>');
                print_r($db->errorCode());
                print_r($db->errorInfo());
                exit();
            }
    
            header('Location: ./list.php');
            exit;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <style></style>
    <link rel="stylesheet" href=addition.css type="text/css">

</head>

<body>
    <div>
        <h4>ToDoリスト</h4>
        <p class="error-massage">
            <?php
                echo $error_message;
            ?>
        </p>
    </div>
    <div style="background-color: #C0C0C0; padding: 10px; border: 1px solid #333333;">
        <form action="" method="post">
            <div class="content-title-area">
                <p>タイトル</p>
                <input name="title" class="content-title-input" type="text" maxlength="20"required/>
            </div>
            <div class="content-content-area">
                <p>内容</p>
                <textarea name="text" class="content-content-input" maxlength="200"></textarea>
            </div>
            <div class="content-footer-area">
                <button name="add" class="page-footer-butoon" >追加</button>
            </div>
        </form>
    </div>

</body>

</html>