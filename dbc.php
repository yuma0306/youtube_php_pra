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
        } catch (PDOException $e) {
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
        // var_dump($result);
        return $result;
        $dbh = null;
    }
    // カテゴリー名を表示
    // 引数：数字 返り値：カテゴリーの文字列
    function setCategoryName($category) {
        if($category === '1') {
            return '日常';
        } else if($category === '2') {
            return 'プログラミング';
        }
        return 'その他';
    }

    // 引数: $id
    // 返り値: $result
    function getBlog($id) {
        if(empty($id)) {
            exit('IDが不正です');
        }
        $dbh = connectDb();
        // SQL準備
        $stmt = $dbh->prepare('SELECT * FROM blog Where id = :id');
        $stmt->bindValue(':id', (int)$id, PDO::PARAM_INT);
        // SQL実行
        $stmt->execute();
        // 結果を取得
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        // var_dump($result);
        if(!$result) {
            exit('ブログがありません');
        }
        return $result;
    }
?>