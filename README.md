# php-for-everyone-sample

## 必要なもの

* Docker

## 環境構築手順

### 開発環境の初期化

```
make install
```

### 開発環境を起動

```
make start
```

### 開発環境を閲覧

http://localhost:8080

にアクセスする。

### 開発環境を停止

```
make stop
```

### 開発環境を削除

```
make down
```

### DBのマイグレーションを実行

```
make db-migrate
```

### DBのマイグレーションをロールバック

```
make db-rollback
```

### DBのマイグレーションをリセット

```
make db-reset
```

### PHPUnitを実行

```
make phpunit
```

### `php-cli` コンテナのコンソールを開く

```
make enter-php-cli
```

### `mysql` コンテナのコンソールを開く

```
make enter-mysql
```