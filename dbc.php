<?php
    // データベース接続
    // 引数：なし 返り値：接続結果
    function connectDb() {
        $dsn = 'mysql:host=localhost;dbname=blog.app;charset=utf8';
        $user = 'blog_user';
        $pass = 'hhhkhyhp';
        try {
            $dbh = new PDO($dsn,$user,$pass,[
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            ]);
        } catch(PDOException $e) {
            echo '接続失敗' . $e->getMessage();
            exit;
        }
        return $dbh;
    }
    // データを取得
    // 引数：なし 返り値：取得したデータ
    function getAllBlog() {
        $dbh = connectDb();
        $sql = 'select * from blog';
        // sqlの実行
        $stmt = $dbh->query($sql);
        // sqlの結果を受け取る
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        var_dump($result);
        return $result;
        $dbh = null;
    }
    $blogData = getAllBlog();
    // カテゴリー名を表示
    // 引数：数字 返り値：カテゴリーの文字列
    function setCategoryName($category) {
        if($category === '1') {
            return 'ブログ';
        } else if($category === '2') {
            return '日常';
        }
        return 'その他';
    }
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ブログ一覧</title>
</head>
<body>
    <h1>ブログ一覧</h1>
    <table>
        <tr>
            <th>No</th>
            <th>タイトル</th>
            <th>カテゴリ</th>
        </tr>
        <?php foreach($blogData as $columns) :?>
        <tr>
            <td><?php echo $columns['id'] ?></td>
            <td><?php echo $columns['title'] ?></td>
            <td><?php echo setCategoryName($columns['category']); ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>