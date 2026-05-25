<?php

namespace App\Filament\Forms\Components;

use Filament\Forms\Components\Field;

class Base64ImageDropzone extends Field
{
    protected string $view = 'filament.forms.components.base64-image-dropzone';

    protected function setUp(): void
    {
        parent::setUp();
    }
}
