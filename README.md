
## Versions

- Php : 8.1.2
- Laravel : 9.2.0
- Xampp : 8.1.2
- Composer : 2.5.5

## Steps
    1-) git clone https://github.com/fikretcure/CinemaSelectionAppV1.git
    2-) composer install
    3-) php artisan key:generate
    3-) .env içinde mysql ve JWT_SECRET ayarlamalarını yap. .env.example dosyasına bakabilirsin
    4-) php artisan migrate:refresh --seed
    5-) php artisan serve

##Postman

CinemaSelectionAppV1.postman_collection.json dosyasını postmanınıza import etmelisiniz.Login olduktan sonra access tokenı headera ekleyip isteklerinizi atıp denemeye başlayabilirsiniz.
    

