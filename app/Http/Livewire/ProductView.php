<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Arr;

class ProductView extends Component
{

    /**
     * Response of the API
     * @var array|mixed
     */
    private $mResponse = [];

    /**
     * Extracted available sizes
     * @var array
     */
    public $aSizes = [];

    /**
     * Extracted available product information
     * @var array
     */
    public $aProductInfo = [];

    /**
     * Selected Size
     * @var string
     */
    public $sSelectedSize = '';

    /**
     * Selected Size
     * @var int
     */
    public $iSelectedSize = 0;

    /**
     * Cart
     * @var array
     */
    public $aCart = [];

    /**
     * @var bool
     */
    public $bShowCart = false;

    public function __construct($id = null)
    {
        $this->mResponse = @file_get_contents('https://3sb655pz3a.execute-api.ap-southeast-2.amazonaws.com/live/product') ?? '{}';
        $this->mResponse = json_decode($this->mResponse, true);
        parent::__construct($id);
    }

    public function render()
    {
        $this->initProductInfo();
        return view('livewire.product-view');
    }

    private function initProductInfo()
    {
        $this->aSizes = Arr::pull($this->mResponse, 'sizeOptions');
        $this->aProductInfo = $this->mResponse;
    }

    public function selectSize(int $iSelectedSize, string $sSelectedSize)
    {
        $this->iSelectedSize = $iSelectedSize;
        $this->sSelectedSize = $sSelectedSize;
    }

    public function saveCart()
    {
        if (empty($this->sSelectedSize) !== true) {
            array_push($this->aCart, [
                'title' => $this->aProductInfo['title'],
                'size'  => $this->sSelectedSize,
                'price' => $this->aProductInfo['price'],
                'qty'   => 1,
                'image' => $this->aProductInfo['imageURL'],
            ]);
            $this->sSelectedSize = '';
            $this->iSelectedSize = 0;
        }
    }

    public function showCart()
    {
        $this->bShowCart = !$this->bShowCart;
    }

}
