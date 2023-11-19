<?php

namespace Modules\User\Services\Web\Components;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\AbstractCursorPaginator;
use Illuminate\Pagination\AbstractPaginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;
use Modules\User\Repositories\CartItemRepository;
use Modules\User\Repositories\ProductRepository;

class Products extends Component
{
    use WithPagination;

    protected CartItemRepository $cartItemRepository;
    protected ProductRepository $productRepository;

    public function __construct()
    {
        $this->cartItemRepository = app(CartItemRepository::class);
        $this->productRepository = app(ProductRepository::class);
    }


    public function render(): Renderable
    {
        return view('user::components.products',[
            'products' => $this->getProducts(),
        ]);
    }

    protected function getProducts(): AbstractPaginator|AbstractCursorPaginator|null
    {
        return $this->productRepository->paginate(request()->getPaginationCount());
    }

    public function addProductToCart($productId): void
    {
        $this->dispatch('addProductToCart',$productId)->to(Cart::class);
    }

    public function removeProductFromCart($productId): void
    {
        $this->dispatch('removeProductFromCart',$productId)->to(Cart::class);
    }
}
