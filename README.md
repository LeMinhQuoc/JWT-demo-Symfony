# JWT _main_sourse

`symfony new jwt`  
`composer require symfony/maker-bundle --dev`  
`composer require symfony/orm-pack`  
`composer require doctrine:make`  
define your .env like  
`DATABASE_URL="mysql://root:@127.0.0.1:3306/JWT_demotr?serverVersion=mariadb-10.4.18"`  
require JWT  
`composer require "lexik/jwt-authentication-bundle"`
require api flatform  
`composer require api`  
create User Entity  
`php bin/console make:entity User`  
create database   
`php bin/console doctrine:database:create`
make migrate  
`php bin/console doctrine:migration:diff`  
run migrate  
`php bin/console doctrine:migration:migrate`  
make key 
`php bin/console lexik:jwt:generate-keypair`
define security.yaml  
`security:
    
    encoders:
        App\Entity\User:
            algorithm: sha256
    providers:
       
        app_user_provider:
            entity:
                class: App\Entity\User
                property: username
    firewalls:

        login:
            pattern:  ^/api/login
            stateless: true
            anonymous: true
            provider: app_user_provider
            json_login:
                check_path:               /api/login_check
                username_path: username
                password_path: password
                success_handler:          lexik_jwt_authentication.handler.authentication_success
                failure_handler:          lexik_jwt_authentication.handler.authentication_failure
        api:
            pattern: ^/api
            stateless: true
            guard:
                authenticators:
                    - lexik_jwt_authentication.jwt_token_authenticator


    access_control:
        - { path: ^/api/login, roles: IS_AUTHENTICATED_ANONYMOUSLY }
        - { path: ^/api,       roles: IS_AUTHENTICATED_FULLY }`
        
          define your routes.yaml  `api_login_check:
  path: /api/login_check`  
    set User entity become a userInterface
    
      ______GOOD_LUCK_____