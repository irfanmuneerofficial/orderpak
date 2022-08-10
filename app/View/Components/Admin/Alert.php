<?php

namespace App\View\Components\Admin;

use Illuminate\View\Component;

/**
 * Class Alert
 * @package App\View\Components\Admin
 */
class Alert extends Component
{
    /**
     * @var string
     */
    public $type;

    /**
     * @var string
     */
    public $message;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($type, $message)
    {
        $this->type = $type;
        $this->message = $message;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.admin.alert');
    }
}
