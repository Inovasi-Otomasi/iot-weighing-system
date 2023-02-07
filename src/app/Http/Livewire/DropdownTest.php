<?php

namespace App\Http\Livewire;

use Asantibanez\LivewireSelect\LivewireSelect;
use Illuminate\Support\Collection;
use Livewire\Component;

class DropdownTest extends LivewireSelect
{
    // public function render()
    // {
    //     return view('livewire.dropdown-test');
    // }

    public function options($searchTerm = null): Collection
    {
        $modelsByBrand = [
            'tesla' => [
                ['value' => 'Model S', 'description' => 'Model S'],
                ['value' => 'Model 3', 'description' => 'Model 3'],
                ['value' => 'Model X', 'description' => 'Model X'],
            ],
            'honda' => [
                ['value' => 'CRV', 'description' => 'CRV'],
                ['value' => 'Pilot', 'description' => 'Pilot'],
            ],
            'mazda' => [
                ['value' => 'CX-3', 'description' => 'CX-3'],
                ['value' => 'CX-5', 'description' => 'CX-5'],
                ['value' => 'CX-9', 'description' => 'CX-9'],
            ],
        ];

        $carBrandId = $this->getDependingValue('car_brand_id');

        if ($this->hasDependency('car_brand_id') && $carBrandId != null) {
            return collect(data_get($modelsByBrand, $carBrandId, []));
        }

        return collect([
            ['value' => 'Model S', 'description' => 'Tesla - Model S'],
            ['value' => 'Model 3', 'description' => 'Tesla - Model 3'],
            ['value' => 'Model X', 'description' => 'Tesla - Model X'],
            ['value' => 'CRV', 'description' => 'Honda - CRV'],
            ['value' => 'Pilot', 'description' => 'Honda - Pilot'],
            ['value' => 'CX-3', 'description' => 'Mazda - CX-3'],
            ['value' => 'CX-5', 'description' => 'Mazda - CX-5'],
            ['value' => 'CX-9', 'description' => 'Mazda - CX-9'],
        ]);
    }
}
