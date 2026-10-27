<?php

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

$data = [];

foreach ($fields as $key => $label) {
    $value = $_POST[$key] ?? '';

    if (!is_string($value) || trim($value) === '') {
        header('Location: contact.php');
        exit;
    }

    $data[$key] = trim($value);
}

$to = 'your-email@example.com';
$subject = 'お問い合わせがありました';

$body = '';
foreach ($fields as $key => $label) {
    $body .= $label . '：' . $data[$key] . "\n";
}

$headers = "Content-Type: text/plain; charset=UTF-8";

$mailSent = mail($to, $subject, $body, $headers);
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>お問い合わせフォーム - 送信完了画面</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <main>
        <h1>お問い合わせフォーム - 送信完了画面</h1>

        <?php if ($mailSent): ?>
            <p>お問い合わせが送信されました。ありがとうございます！</p>
        <?php else: ?>
            <p>メール送信に失敗しました。時間をおいて再度お試しください。</p>
        <?php endif; ?>

        <a href="contact.php">お問い合わせフォームに戻る</a>
    </main>
</body>
</html>

