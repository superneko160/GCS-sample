# GCS-sample

images form Google Cloud Storage.

## Setup

### Google Cloud側の準備

1. Cloud Storageでバケット作成、画像をアップロード
2. Storageオブジェクトユーザのロールでアカウントを作成（IAM）
3. アカウントのキーを作成し、JSONファイル（秘密鍵）をダウンロード
4. ダウンロードしたJSONファイルをプロジェクト下に配置

### ローカル側の準備

```sh
composer install
```

`touch .env`

```env
GCS_PROJECT_ID='project-name'
GCS_BUCKET_NAME='backet-name'
GCS_KEY_FILE_PATH='service-account-key.json'
```

## Note

### Always Free

Cloud Storageはクレカ登録が必要だが、Always Free(無料枠内)で、以下の設定ならば問題ない

- リージョン: us-west1, us-central1, us-east1（無料枠対象）

### IAM作成とキー作成

1. IAMと管理 → サービスアカウント
2. サービスアカウントを作成
3. ロールで「Storage オブジェクト閲覧者」または「Storageオブジェクトユーザー」を付与
4. キーを作成 → JSON形式でダウンロード

## References

- [Google Cloud Console](https://console.cloud.google.com/)
- [PHP client libraries | Google Cloud Documentation](https://docs.cloud.google.com/php/docs/reference/cloud-storage/latest)
- [google-cloud-php](https://github.com/googleapis/google-cloud-php)
- [phpdotenv](https://github.com/vlucas/phpdotenv)
