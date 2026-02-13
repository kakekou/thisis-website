<?php
// 文字化け対策
mb_language("Japanese");
mb_internal_encoding("UTF-8");

// 送信先
$to = "info@thisis.co.jp";

// フォームからのデータ取得
$name = isset($_POST['name']) ? htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8') : '';
$email = isset($_POST['email']) ? htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8') : '';
$phone = isset($_POST['phone']) ? htmlspecialchars($_POST['phone'], ENT_QUOTES, 'UTF-8') : '';
$message = isset($_POST['message']) ? htmlspecialchars($_POST['message'], ENT_QUOTES, 'UTF-8') : '';

// 空チェック
if (empty($name) || empty($email) || empty($message)) {
    header("Location: index.html?status=error#contact");
    exit;
}

// ===== 管理者宛メール =====
$admin_subject = "【お問い合わせ】" . $name . " 様より";
$admin_body = "━━━━━━━━━━━━━━━━━━━━\n";
$admin_body .= "  お問い合わせがありました\n";
$admin_body .= "━━━━━━━━━━━━━━━━━━━━\n\n";
$admin_body .= "■ お名前: " . $name . "\n";
$admin_body .= "■ メールアドレス: " . $email . "\n";
$admin_body .= "■ 電話番号: " . $phone . "\n";
$admin_body .= "■ お問い合わせ内容:\n" . $message . "\n";

$admin_headers = "From: " . $email . "\r\n";
$admin_headers .= "Reply-To: " . $email . "\r\n";
$admin_headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

mb_send_mail($to, $admin_subject, $admin_body, $admin_headers);

// ===== お客様宛 自動返信メール =====
$auto_subject = "【ThisIs株式会社】お問い合わせありがとうございます";
$auto_body = $name . " 様\n\n";
$auto_body .= "この度はお問い合わせいただき、誠にありがとうございます。\n";
$auto_body .= "以下の内容でお問い合わせを承りました。\n";
$auto_body .= "内容を確認の上、担当者よりご連絡させていただきます。\n\n";
$auto_body .= "━━━━━━━━━━━━━━━━━━━━\n";
$auto_body .= "■ お名前: " . $name . "\n";
$auto_body .= "■ メールアドレス: " . $email . "\n";
$auto_body .= "■ 電話番号: " . $phone . "\n";
$auto_body .= "■ お問い合わせ内容:\n" . $message . "\n";
$auto_body .= "━━━━━━━━━━━━━━━━━━━━\n\n";
$auto_body .= "※このメールは自動返信です。\n";
$auto_body .= "通常1〜2営業日以内にご返信いたします。\n\n";
$auto_body .= "━━━━━━━━━━━━━━━━━━━━\n";
$auto_body .= "ThisIs株式会社\n";
$auto_body .= "〒150-0042 東京都渋谷区宇田川町12-3\n";
$auto_body .= "ニュー渋谷コーポラス1011号室\n";
$auto_body .= "TEL: 03-5932-4206\n";
$auto_body .= "MAIL: info@thisis.co.jp\n";
$auto_body .= "営業時間: 9:00 - 22:00（年中無休）\n";
$auto_body .= "━━━━━━━━━━━━━━━━━━━━\n";

$auto_headers = "From: info@thisis.co.jp\r\n";
$auto_headers .= "Reply-To: info@thisis.co.jp\r\n";
$auto_headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

mb_send_mail($email, $auto_subject, $auto_body, $auto_headers);

// 完了後リダイレクト
header("Location: index.html?status=success#contact");
exit;
?>
