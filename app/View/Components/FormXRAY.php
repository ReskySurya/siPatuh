<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FormXRAY extends Component
{
    public $type;

    /**
     * Create a new component instance.
     */
    public function __construct($type = 'bagasi')
    {
        $this->type = $type;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        if ($this->type === 'cabin') {
            return view('components.xray.form-xraycabin');
        }

        return view('components.xray.form-xraybagasi');
    }
}
