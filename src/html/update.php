<?php
    define('USERNAME', 'laravel_user');
    define('PASSWORD', 'laravel_pass');

    $error_message = null;

    require_once('db_connect.php');
    
        try {
            //データベースに接続
            $db = db_connect();
            //接続角煮が取れた
            }catch (PDOException $e) {
            //接続に失敗した
            $isConnect = false;
        }

    if (isset($_POST['edit'])) {
        $title = $_POST['title']; 
        $text = $_POST['text'];

        if ($title == "") {
            $error_message = "タイトルを入力してください。";
        } else if (strlen($title) > 20) {
            $error_message = "タイトルは20文字以内で入力してください。";
        } else if (strlen($text) > 200) {
            $error_message = "内容は200文字以内で入力してください。";
        }  else {

            // レコード更新
            $update_sql = "UPDATE `TodoList` SET `Titel`=:title,`Text`=:text WHERE `Id`=:id";
            $update_stmt = $db->prepare($update_sql);
            $update_stmt->bindParam(':title', $title, PDO::PARAM_STR);
            $update_stmt->bindParam(':text', $text, PDO::PARAM_STR);
            $update_stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $update_res = $update_stmt->execute();

            if (!$update_res){
                print('データの更新に失敗しました<br>');
                print_r($db->errorCode());
                print_r($db->errorInfo());
                exit();
            }

            header('Location: ./list.php');
            exit();
        }
    } else {
        $id =  (int)$_GET["id"]; 
    
        $select_sql = "SELECT `Titel`, `Text` FROM `TodoList` WHERE `Id` = :id;";
        $select_stmt = $db->prepare($select_sql);
        $select_stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $select_res = $select_stmt->execute();
    
        $todos = $select_stmt->fetchAll(PDO::FETCH_ASSOC);
        $todo = $todos[0];
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <style></style>
    <link rel="stylesheet" href="update.css" type="text/css">

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
        <form action="#" method="post">
            <div class="content-title-area">
                <p>タイトル</p>
                <input name="title" class="content-title-input" value="<?php echo $todo["Titel"]; ?>"type="text" maxlength="20" required/>
            </div>
            <div class="content-content-area">
                <p>内容</p>
                <textarea name="text" class="content-content-input" type="text"  maxlength="200"><?php echo  $todo["Text"];?></textarea>
            </div>
            <div class="content-footer-area">
                <button name="edit" class="page-footer-butoon">更新</button>
            </div>
        </form>
    </div>
</body>
</html>