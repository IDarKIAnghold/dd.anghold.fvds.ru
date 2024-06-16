<?php

namespace App\Orchid\Screens\Manufacturer;

use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Toast;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use App\Models\Manufacturer;
use App\Orchid\Layouts\Manufacturers\ManufacturersEditLayout;

class ManufacturersEditScreen extends Screen
{
    public $manufacturer;
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(Manufacturer $manufacturer): iterable
    {
        return [
            'manufacturer' => $manufacturer
        ];
    }
    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Manufacturers Edit';
    }
    public function description(): ?string
    {
        return 'Modify the privileges and permissions associated with a specific role.';
    }
    public function commandBar(): iterable
    {
        return [
            Button::make(__('Save'))
                ->icon('bs.check-circle')
                ->method('save'),

            Button::make(__('Remove'))
                ->icon('bs.trash3')
                ->method('remove')
                ->canSee($this->manufacturer->exists),
        ];
    }
    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            Layout::block([
                ManufacturersEditLayout::class,
            ])
                ->title('Manufacturer')
                ->description(''),
        ];
    }

    /**
     * @throws \Exception
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save(Request $request, Manufacturer $manufacturer)
    {
        $request->validate([
            'manufacturer.name' => [
                'required',
                Rule::unique(Manufacturer::class, 'name')->ignore($manufacturer),
            ],
        ]);

        $manufacturer->name = $request->input('manufacturer.name');

        $manufacturer->save();
        Toast::info(__('Manufacturer was saved'));

        return redirect()->route('platform.systems.manufacturers');
    }

    /**
     * @throws \Exception
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove(Manufacturer $manufacturer)
    {
        $manufacturer->delete();

        Toast::info(__('Manufacturer was removed'));

        return redirect()->route('platform.systems.manufacturers');
    }
}
