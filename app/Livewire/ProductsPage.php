<?php

namespace App\Livewire;

use App\Livewire\Partials\Navbar;
use App\Helpers\CartManagement;
use App\Models\Product;
use App\Models\Category;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Models\Subcategory;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Products - UniSaver')]
class ProductsPage extends Component
{
    use LivewireAlert;

    use WithPagination;

    #[Url]
    public $selected_categories = [];

    #[Url]
    public $selected_subcategories = [];

    #[Url]
    public $price_range = 100;

    #[Url]
    public $sort = '';

    // add product to cart method
    public function addToCart($product_id) {
        $total_count = CartManagement::addItemToCart($product_id);

        $this->dispatch('update-cart-count', total_count: $total_count)->to(Navbar::class);

        $this->alert('success', 'Product added to the cart successfully!', [
            'position' => 'bottom-end',
            'timer' => 3000,
            'toast' => true,
           ]);
    }

    public function render()
    {
        $productQuery = Product::query()->where('is_available', 1);

        if (!empty($this->selected_categories)) {
            $productQuery->whereIn('category_id', $this->selected_categories);
        }

        if (!empty($this->selected_subcategories)) {
            $productQuery->whereIn('subcategory_id', $this->selected_subcategories);
        }

        if ($this->price_range) {
            $productQuery->whereBetween('price', [0, $this->price_range]);
        }

        if ($this->sort == 'price') {
            $productQuery->orderBy('price');
        }

        return view('livewire.products-page', [
            'products' => $productQuery->paginate(9),
            'subcategories' => Subcategory::where('is_available', 1)->get(['id', 'name', 'slug']),
            'categories' => Category::where('is_available', 1)->get(['id', 'name', 'slug']),
        ]);
    }
}
