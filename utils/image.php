<?php
/**
 * 画像リストを取得
 * @param iterable $objects Google Cloud Storage オブジェクトのイテレータ
 * @return array 画像リスト
 */
function getImageList(iterable $objects): array {
    $images = [];

    foreach ($objects as $object) {
        $name = $object->name();
        $extension = strtolower(pathinfo($name, PATHINFO_EXTENSION));

        if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'webp'])) {
            $images[] = [
                'name' => $name,
                // 1時間有効な署名付きURL
                'url' => $object->signedUrl(new DateTime('+1 hour')),
            ];
        }
    }

    return $images;
}
