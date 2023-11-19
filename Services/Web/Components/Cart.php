<?php

namespace Modules\User\Services\Web\Components;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Collection;
use Illuminate\Validation\Rule;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use Modules\User\Repositories\CartItemRepository;
use Modules\User\Repositories\ProductRepository;

class Cart extends Component
{
    protected CartItemRepository $cartItemRepository;
    protected $listeners = ['removeProductFromCart', 'addProductToCart'];

    public int|string $id;

    public function __construct()
    {
        $this->cartItemRepository = app(CartItemRepository::class);
    }

    public function render(): Renderable
    {
        return view('user::components.cart', [
            'cart_items' => $this->cartItemRepository->getCartItems()
        ]);
    }


    public function removeProductFromCart($productId): void
    {
        $cart_product_item = $this->cartItemRepository->getCartItem($productId);
        if ($cart_product_item)
        $cart_product_item->count > 1 ? $cart_product_item->decrement('count') : $cart_product_item->delete();
    }


    public function addProductToCart($productId): void
    {
        $cartItem = $this->cartItemRepository->getCartItem($productId);
        if ($cartItem) $cartItem->increment('count');
        else $this->cartItemRepository->create([
            'user_id' => auth()->id(),
            'product_id' => $productId,
            'count' => 1,
        ]);
    }


    public function changeCount($productId, $count): void
    {
        $cartItem = $this->cartItemRepository->getCartItem($productId);
        !empty($count) ? $cartItem?->update(['count' => $count]) : $cartItem->delete();
    }


    protected function rules(): array
    {
        return [
            'id' => [
                'required',
                Rule::exists('products', 'id'),
                Rule::unique('cart_items', 'product_id')->where('user_id', auth()->id())
            ]
        ];
    }

}
