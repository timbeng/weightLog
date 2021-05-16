<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class BodyCompositionTest extends TestCase
{
    public function testCalculateFatProcentage(): void
    {  
        $logger = new \Monolog\Logger('log');
        $file_handler = new \Monolog\Handler\StreamHandler(__DIR__ . '/../../logs/app.log');
        $logger->pushHandler($file_handler);
   
        $user = new App\Models\User();
        $user->gender = 'male';
        $user->waist = 93;
        $user->neck = 39;
        $user->height = 194; 
 
        $bodycomp = new App\Models\BodyComposition($logger); 
        $fatProcentage = $bodycomp->calculateFatProcentage($user); 
        $this->assertSame(19.1, $fatProcentage); 
    }
  
}
