<?php
require_once './vendor/autoload.php';
require_once './utils/image.php';

use Google\Cloud\Storage\StorageClient;
use Dotenv\Dotenv;

// .envファイルの読み込み
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$projectId = $_ENV['GCS_PROJECT_ID'];
$bucketName = $_ENV['GCS_BUCKET_NAME'];
$keyFilePath = $_ENV['GCS_KEY_FILE_PATH'];

$storage = new StorageClient([
    'projectId' => $projectId,
    'keyFilePath' => $keyFilePath,
]);

$bucket = $storage->bucket($bucketName);

$objects = $bucket->objects([
    'prefix' => ''  // 特定のフォルダ内のみ取得したい場合はここに記述
]);

$images = getImageList($objects);
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Images from GCS</title>
    <link rel="stylesheet" href="./css/index.css">
</head>
<body>
    <div class="container">
        <h1>📷 Images from Cloud Storage</h1>

        <div class="info">
            <p>画像数: <?=count($images)?> 枚</p>
        </div>

        <?php if (empty($images)): ?>
            <div class="no-images">
                <p>画像が見つかりませんでした</p>
                <p>バケットに画像ファイルをアップロードしてください</p>
            </div>
        <?php else: ?>
            <div class="gallery">
                <?php foreach ($images as $image): ?>
                    <div class="image-card">
                        <a href="<?=htmlspecialchars($image['url'])?>" target="_blank">
                            <img src="<?=htmlspecialchars($image['url'])?>" 
                                    alt="<?=htmlspecialchars($image['name'])?>"
                                    loading="lazy">
                        </a>
                        <div class="image-info">
                            <div class="image-name">
                                <?=htmlspecialchars($image['name'])?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
