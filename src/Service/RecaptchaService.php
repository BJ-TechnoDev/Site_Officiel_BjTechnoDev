<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\RequestStack;

class RecaptchaService
{
    private $requestStack;

    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
    }

    public function handleRecaptcha(){
        $recaptcha_secret = '6LezuLsfAAAAABS1y50I8A_ZPcT4anynUoX2SE4C';
        $recaptcha_response = $this->requestStack->getCurrentRequest()->request->get('g-recaptcha-response');
        $captcha = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $recaptcha_secret .
            '&response=' . $recaptcha_response);
        $resp = json_decode($captcha);

        return $resp->success;
    }
}