
<?php
$old = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach (['name', 'companyName', 'email', 'age', 'message'] as $key) {
        $value = $_POST[$key] ?? '';
        $old[$key] = is_string($value) ? $value : '';
    }
}

function h($value)
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>お問い合わせフォーム</title>
    <link rel="stylesheet" href="style.css">
    <script src="style.js" defer></script>
</head>
<body>
    <header>
        <h2>お問い合わせフォーム</h2>
    </header>

    <div class="layout">
        <aside>
            <ul>
                <li><a href="#">トップページ</a></li>
                <li><a href="#">人気投稿</a></li>
                <li><a href="#">エンジニアおすすめ商品</a></li>
                <li><a href="#">エンジニアおすすめ記事</a></li>
                <li><a href="#">投稿ページ</a></li>
            </ul>
        </aside>

        <main>
            <form id="contactForm" action="confirm.php" method="POST" novalidate>
                <table border="3">
                    <tbody>
                        <tr>
                        <tr>
    <th><label for="name">お名前</label></th>
    <td>
        <input type="text" id="name" name="name" size="40"
value="<?= h($old['name'] ?? '') ?>">
    </td>
</tr>
<tr>
    <th><label for="companyName">会社名</label></th>
    <td>
        <input type="text" id="companyName" name="companyName" size="40"
            value="<?= h($old['companyName'] ?? '') ?>">
    </td>
</tr>
<tr>
    <th><label for="email">メールアドレス</label></th>
    <td>
        <input type="text" id="email" name="email" size="40"
            value="<?= h($old['email'] ?? '') ?>">
    </td>
</tr>
<tr>
    <th><label for="age">年齢</label></th>
    <td>
        <input type="text" id="age" name="age" size="40"
            value="<?= h($old['age'] ?? '') ?>">
    </td>
</tr>
<tr>
    <th><label for="message">お問い合わせ内容</label></th>
    <td><textarea id="message" name="message" rows="6" cols="40" placeholder="お問い合わせ内容"><?= h($old['message'] ?? '') ?></textarea></td>
</tr>
                    </tbody>
                </table>

                <input type="submit" value="送信">
            </form>
        </main>
    </div>

    <footer>
        <button type="button" id="changeFooterColor">押してみてね！</button>
    </footer>
</body>
</html>
