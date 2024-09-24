<?php
    define('USERNAME', 'laravel_user');
    define('PASSWORD', 'laravel_pass');

    require_once('db_connect.php');
    
        try {
            //データベースに接続
            $db = db_connect();
            //接続確認が取れた
            }catch (PDOException $e) {
            //接続に失敗した
            $isConnect = false;
        }
        
    if (isset($_POST['delete'])) {
        $delete_id = (int)$_POST['delete'];

        // レコード削除
        $delete_sql = "DELETE FROM `TodoList` WHERE Id=:id";
        $delete_stmt = $db->prepare($delete_sql);
        $delete_stmt->bindParam(':id', $delete_id, PDO::PARAM_STR);
        $delete_res = $delete_stmt->execute();

        if (!$delete_res){
            print('データの削除に失敗しました<br>');
            print_r($db->errorCode());
            print_r($db->errorInfo());
            exit();
        }
    }

    $sql = "SELECT * FROM TodoList;";
    
    $sth = $db->query($sql);

    $todos = $sth->fetchAll(PDO::FETCH_ASSOC);


    $db = null;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <style></style>
    <link rel="stylesheet" href="style.css" type="text/css">

    

    <script>
        // 削除ボタン押したときの処理
        const handleClickDeleteButton = (id) => {
            console.log("削除ボタン押しました", id);
            // 消していいか確認ダイアログを表示
            const result = confirm("消去しますか？");
            if (result) {
                // 消していいとき
                // 何かする
                console.log("はい");
                window.location.href=`delete.php?id=${id}`
            }
            if (result) {
                //消去しない場合
                console.log("いいえ");

            }
        }
    </script>
</head>

<body>
    <div class="page">
        <div class="page-header">
            <h4>ToDoリスト</h4>
            <div class="page-header-button">
                <button onclick="location.href='./addition.php'">追加</button>
            </div>
        </div>
        <table class="table" border="1">
            <thead>
                <tr>
                    <th class="table-head-number" scope="col">番号</th>
                    <th scope="col">タイトル</th>
                    <th scope="col">内容</th>
                    <th class="time" scope="co1">作成日</th>
                    <th class="time" scope="co1">更新日</th>
                    <th scope="co1"></th>
                </tr>
            </thead>

            <?php
                foreach ($todos as $todo) {
            ?>
                <tr>
                    <th class="table-number" scope="row">
                        <?php
                            echo $todo["Id"];
                        ?>
                    </th>
                    <td>
                        <?php
                            echo $todo["Titel"];
                        ?>
                    </td>
                    <td>
                        <?php
                                echo $todo["Text"];
                            ?>
                    </td>

                    <td>
                        <?php
                            echo $todo["CreatedAt"];
                        ?>
                    </td>
                    <td>
                        <?php
                            echo $todo["UpdatedAt"];
                        ?>
                    </td>
                    <td>
                        <div class="test-container">
                            <button onclick="location.href='./update.php?id=<?php echo $todo['Id'] ?>'" class="test-button">編集</button>
                            <!-- 仮のid -->
                            <button onclick="handleClickDeleteButton(<?php echo $todo['Id'] ?>)" class="test-button">消去</button>
                        </div>
                    </td>
                </tr>
            <?php
                }
            ?>
        </table>
    </div>
</body>
</html>