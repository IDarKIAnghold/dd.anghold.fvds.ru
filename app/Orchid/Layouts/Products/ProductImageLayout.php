<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Products;

use Orchid\Screen\Field;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\Fields\Upload;

class ProductImageLayout extends Rows
{
    /**
     * The screen's layout elements.
     *
     * @return Field[]
     */
    public function fields(): array
    {
        return [
            Upload::make('products.attachments')
                ->maxFiles(10)
                ->path('src')
                ->acceptedFiles('.jpg, .jpeg, .png')
                ->autoUpload()
                ->media()
        ];
    }
}
