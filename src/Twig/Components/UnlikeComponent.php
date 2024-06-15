<?php

namespace App\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('UnlikeComponent')]
final class UnlikeComponent
{
   public string $class;
}
