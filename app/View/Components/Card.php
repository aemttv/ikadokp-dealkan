<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class Card extends Component
{
    public $title;
    public $image;
    public $type;
    public $location;
    public $status;
    public $price;
    public $detailKM;
    public $detailKMLain;
    public $detailKT;
    public $detailKTLain;
    public $detailAreas;
    public $buildingArea;
    public $link;

    public function __construct(
        $title = 'Default Title',
        $image = 'default-image.jpg',
        $type = 'Default Type',
        $location = 'Default Location',
        $status = 'Available',
        $price = '0',
        $detailKM = 'N/A',
        $detailKMLain = 'N/A',
        $detailKT = 'N/A',
        $detailKTLain = 'N/A',
        $detailAreas = 'N/A',
        $buildingArea = 'N/A',
        $link = '#'
    ) {
        $this->title = $title;
        $this->image = $image;
        $this->type = $type;
        $this->location = $location;
        $this->status = $status;
        $this->price = $price;
        $this->detailKM = $detailKM;
        $this->detailKMLain = $detailKMLain;
        $this->detailKT = $detailKT;
        $this->detailKTLain = $detailKTLain;
        $this->detailAreas = $detailAreas;
        $this->buildingArea = $buildingArea;
        $this->link = $link;
    }
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.card');
    }
}
