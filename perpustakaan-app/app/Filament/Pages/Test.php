<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class Test extends Page
{
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationLabel = 'Tentang Admin Partai';

    protected static ?string $title = 'Partai Admin';

    protected string $view = 'filament.pages.test';
}
