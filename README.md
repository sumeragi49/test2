環境構築

Dockerビルド ・docker-compose up -d --build

Laravel環境構築 ・docker-compose exec php bash ・composer install ・cp.env.example.env ・php artisan key:generate ・php artisan migrate ・php artisan db:seed

開発環境 ・一覧画面：http://localhost/products/ ・商品登録画面: http://localhost/register/ ・詳細画面: http://localhost/products/detail/

使用技術 ・docker3.8 ・nginx:1.21.1 ・mysql:8.0.26 ・From php: 8.1-fpm ・Composer version: 2.9.2 ・laravel/laravel: 8.6.12


<img width="1947" height="1402" alt="スクリーンショット 2025-12-14 225834" src="https://github.com/user-attachments/assets/1a9ca576-f550-49c7-9858-46a01a91e4fb" />
