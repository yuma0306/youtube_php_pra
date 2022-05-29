<?php
require_once('blog.php');
//テーブル名を引数に渡してインスタンス化
$blog = new Blog();
$blogData = $blog->getAll();
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
    <p><a href="/form.html">新規作成</a></p>
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
            <td><?php echo $blog->setCategoryName($columns['category']); ?></td>
            <td><a href="/detail.php?id=<?php echo $columns['id'] ?>">詳細</a></td>
            <td><a href="/update_form.php?id=<?php echo $columns['id'] ?>">編集</a></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>