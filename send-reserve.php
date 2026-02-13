<?php
mb_language("Japanese");
mb_internal_encoding("UTF-8");
mb_detect_order("UTF-8,SJIS,EUC-JP,JIS,ASCII");

$to = "info@thisis.co.jp";

$name = isset($_POST['name']) ? htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8') : '';
$email = isset($_POST['email']) ? htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8') : '';
$phone = isset($_POST['phone']) ? htmlspecialchars($_POST['phone'], ENT_QUOTES, 'UTF-8') : '';
$menu = isset($_POST['menu']) ? htmlspecialchars($_POST['menu'], ENT_QUOTES, 'UTF-8') : '';
$date = isset($_POST['date']) ? htmlspecialchars($_POST['date'], ENT_QUOTES, 'UTF-8') : '';
$time = isset($_POST['time']) ? htmlspecialchars($_POST['time'], ENT_QUOTES, 'UTF-8') : '';
$message = isset($_POST['message']) ? htmlspecialchars($_POST['message'], ENT_QUOTES, 'UTF-8') : '';

if (empty($name) || empty($email) || empty($menu)) {
    header("Location: index.html?status=error#reserve");
    exit;
}

// ===== 管理者宛メール =====
$admin_subject = "【ご予約】" . $name . " 様より";
$admin_body = "━━━━━━━━━━━━━━━━━━━━\n";
$admin_body .= "  ご予約がありました\n";
$admin_body .= "━━━━━━━━━━━━━━━━━━━━\n\n";
$admin_body .= "■ お名前: " . $name . "\n";
$admin_body .= "■ メールアドレス: " . $email . "\n";
$admin_body .= "■ 電話番号: " . $phone . "\n";
$admin_body .= "■ メニュー: " . $menu . "\n";
$admin_body .= "■ 希望日: " . $date . "\n";
$admin_body .= "■ 希望時間: " . $time . "\n";
$admin_body .= "■ 備考:\n" . $message . "\n";

$admin_headers = "MIME-Version: 1.0\r\n";
$admin_headers .= "From: info@thisis.co.jp\r\n";
$admin_headers .= "Reply-To: " . $email . "\r\n";
$admin_headers .= "Content-Type: text/plain; charset=ISO-2022-JP\r\n";
$admin_headers .= "Content-Transfer-Encoding: 7bit\r\n";

mb_send_mail($to, $admin_subject, $admin_body, $admin_headers);

// ===== お客様宛 自動返信メール =====
$auto_subject = "【ThisIs株式会社】ご予約ありがとうございます";
$auto_body = $name . " 様\n\n";
$auto_body .= "この度はご予約いただき、誠にありがとうございます。\n";
$auto_body .= "以下の内容でご予約を承りました。\n";
$auto_body .= "内容を確認の上、担当者よりご連絡させていただきます。\n\n";
$auto_body .= "━━━━━━━━━━━━━━━━━━━━\n";
$auto_body .= "■ お名前: " . $name . "\n";
$auto_body .= "■ メールアドレス: " . $email . "\n";
$auto_body .= "■ 電話番号: " . $phone . "\n";
$auto_body .= "■ メニュー: " . $menu . "\n";
$auto_body .= "■ 希望日: " . $date . "\n";
$auto_body .= "■ 希望時間: " . $time . "\n";
$auto_body .= "■ 備考:\n" . $message . "\n";
$auto_body .= "━━━━━━━━━━━━━━━━━━━━\n\n";
$auto_body .= "※このメールは自動返信です。\n";
$auto_body .= "内容確認後、担当者よりご連絡いたします。\n\n";
$auto_body .= "━━━━━━━━━━━━━━━━━━━━\n";
$auto_body .= "ThisIs株式会社\n";
$auto_body .= "〒150-0042 東京都渋谷区宇田川町12-3\n";
$auto_body .= "ニュー渋谷コーポラス1011号室\n";
$auto_body .= "TEL: 03-5932-4206\n";
$auto_body .= "MAIL: info@thisis.co.jp\n";
$auto_body .= "営業時間: 9:00 - 22:00（年中無休）\n";
$auto_body .= "━━━━━━━━━━━━━━━━━━━━\n";

$auto_headers = "MIME-Version: 1.0\r\n";
$auto_headers .= "From: info@thisis.co.jp\r\n";
$auto_headers .= "Reply-To: info@thisis.co.jp\r\n";
$auto_headers .= "Content-Type: text/plain; charset=ISO-2022-JP\r\n";
$auto_headers .= "Content-Transfer-Encoding: 7bit\r\n";

mb_send_mail($email, $auto_subject, $auto_body, $auto_headers);

header("Location: index.html?status=success#reserve");
exit;
?>
