<?php
$username = 'josizujDRQ8o';
$apiKeytest = 'd83a8ae9-a185-58b3-b492-63b7c77514fc';
$apiKeyProd = 'd83a8ae9-a185-58b3-b492-63b7c77514fc';

$result = null;
$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $buyer_sku_code = trim($_POST['buyer_sku_code'] ?? '');
    $customer_no = trim($_POST['customer_no'] ?? '');
    $ref_id = trim($_POST['ref_id'] ?? '');
    $testing = isset($_POST['testing']) && $_POST['testing'] == 'on'; // checkbox

    if (!$buyer_sku_code || !$customer_no || !$ref_id) {
        $error = "Semua field wajib diisi!";
    } else {
        // Pilih API key berdasarkan mode testing
        $apiKey = $testing ? $apiKeytest : $apiKeyProd;

        $sign = md5($username . $apiKey . $ref_id);

        $postData = [
            'username' => $username,
            'buyer_sku_code' => $buyer_sku_code,
            'customer_no' => $customer_no,
            'ref_id' => $ref_id,
            'sign' => $sign,
        ];

        if ($testing) {
            $postData['testing'] = true;
        }

        $postDataJson = json_encode($postData);

        $url = 'https://api.digiflazz.com/v1/transaction';

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Content-Length: ' . strlen($postDataJson)
        ]);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postDataJson);

        $response = curl_exec($ch);
        if (curl_errno($ch)) {
            $error = 'Curl error: ' . curl_error($ch);
        } else {
            $result = json_decode($response, true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                $error = "Response bukan JSON valid";
            }
        }
        curl_close($ch);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Topup Transaksi Digiflazz</title>
</head>
<body>
<h2>Topup Transaksi</h2>

<?php if ($error): ?>
    <div style="color: red;"><b>Error:</b> <?=htmlspecialchars($error)?></div>
<?php endif; ?>

<form method="post" action="">
    <label>Buyer SKU Code:<br>
        <input type="text" name="buyer_sku_code" required value="<?=htmlspecialchars($_POST['buyer_sku_code'] ?? '')?>">
    </label><br><br>
    <label>Customer No:<br>
        <input type="text" name="customer_no" required value="<?=htmlspecialchars($_POST['customer_no'] ?? '')?>">
    </label><br><br>
    <label>Ref ID:<br>
        <input type="text" name="ref_id" required value="<?=htmlspecialchars($_POST['ref_id'] ?? '')?>">
    </label><br><br>
    <label>
        <input type="checkbox" name="testing" <?=isset($_POST['testing']) ? 'checked' : ''?>> Testing mode
    </label><br><br>
    <button type="submit">Kirim Topup</button>
</form>

<?php if ($result): ?>
    <h3>Response API:</h3>
    <pre><?=htmlspecialchars(json_encode($result, JSON_PRETTY_PRINT))?></pre>
<?php endif; ?>

</body>
</html>
