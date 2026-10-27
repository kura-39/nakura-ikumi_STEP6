
<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: contact.php');
    exit;
}

$fields = [
    'name' => 'お名前',
    'companyName' => '会社名',
    'email' => 'メールアドレス',
    'age' => '年齢',
    'message' => 'お問い合わせ内容'
];

$errors = [];
$data = [];

foreach ($fields as $key => $label) {
    $value = $_POST[$key] ?? '';

    if (!is_string($value) || trim($value) === '') {
        $errors[] = $label . 'が未入力です。';
        $data[$key] = '';
    } else {
        $data[$key] = trim($value);
    }
}

if (!empty($errors)) {
    echo '<!DOCTYPE html>';
    echo '<html lang="ja">';
    echo '<head><meta charset="UTF-8"><title>入力エラー</title></head>';
    echo '<body>';
    echo '<h2>入力内容をご確認ください</h2>';
    echo '<ul>';

    foreach ($errors as $error) {
        echo '<li>' . htmlspecialchars($error, ENT_QUOTES, 'UTF-8') . '</li>';
    }

    echo '</ul>';
    echo '<a href="contact.php">お問い合わせフォームに戻る</a>';
    echo '</body></html>';
    exit;
}

$_SESSION['contact_data'] = $data;

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
    <title>お問い合わせフォーム - 確認画面</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h2>お問い合わせフォーム - 確認画面</h2>
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
            <table border="3">
                <tbody>
                    <?php foreach ($fields as $key => $label): ?>
                        <tr>
                            <th><?= h($label) ?></th>
                            <td><?= nl2br(h($data[$key])) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            
            
            <form action="contact.php" method="post">
    <?php foreach ($data as $key => $value): ?>
        <input type="hidden"
                name="<?= h($key) ?>"
                value="<?= h($value) ?>">
    <?php endforeach; ?>
    <button type="submit">戻る</button>
</form>

<form action="send.php" method="post">
    <?php foreach ($data as $key => $value): ?>
        <input type="hidden"
                name="<?= h($key) ?>"
                value="<?= h($value) ?>">
    <?php endforeach; ?>
    <button type="submit">送信</button>
</form>

        </main>
    </div>
</body>
</html>
