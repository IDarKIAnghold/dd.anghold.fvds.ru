<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\User;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Rows;

class UserEditLayout extends Rows
{
    /**
     * The screen's layout elements.
     *
     * @return Field[]
     */
    public function fields(): array
    {
        return [
            Input::make('user.first_name')
                ->type('text')
                ->max(255)
                ->required()
                ->title(__('First name'))
                ->placeholder(__('First name')),

            Input::make('user.last_name')
                ->type('text')
                ->max(255)
                ->required()
                ->title(__('Last name'))
                ->placeholder(__('Last name')),

            Input::make('user.nickname')
                ->type('text')
                ->max(255)
                ->title(__('Nickname'))
                ->placeholder(__('Nickname')),

            Input::make('user.email')
                ->type('email')
                ->required()
                ->title(__('Email'))
                ->placeholder(__('Email')),
        ];
    }
}
