<?php

namespace myclass;

use AmoCRM\{AmoAPI, AmoAPIException};
use AmoCRM\TokenStorage\{FileStorage, TokenStorageException};



class AuthAmo
{
    public function __construct(string $clientId = '', string $clientSecret = '', string $authCode = '', string $redirectUri = '', string $subdomain = '')
    {
        try {
            AmoAPI::$tokenStorage = new FileStorage();
            $domain = AmoAPI::getAmoDomain($subdomain);
            $isFirstAuth = !AmoAPI::$tokenStorage->hasTokens($domain);

            if ($isFirstAuth) {
                AmoAPI::oAuth2($subdomain, $clientId, $clientSecret, $redirectUri, $authCode);
            } else {
                AmoAPI::oAuth2($subdomain);
            }
        } catch (AmoAPIException $e) {
            printf('Ошибка авторизации (%d): %s' . PHP_EOL, $e->getCode(), $e->getMessage());
        } catch (TokenStorageException $e) {
            printf('Ошибка обработки токенов (%d): %s' . PHP_EOL, $e->getCode(), $e->getMessage());
        }
    }
}
