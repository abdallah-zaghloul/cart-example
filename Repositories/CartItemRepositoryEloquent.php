<?php

namespace Modules\User\Repositories;

use Modules\User\Models\CartItem;
use Prettus\Repository\Eloquent\BaseRepository;
use Modules\User\Criteria\RequestCriteria;

/**
 * Class UserRepositoryEloquent.
 *
 * @package namespace Modules\User\Repositories;
 */
class CartItemRepositoryEloquent extends BaseRepository implements CartItemRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return CartItem::class;
    }


    public function getCartItems(int|string|null  $userId = null)
    {
        return $this->whereUserId($userId ?? auth()->id())->leftJoin('products', 'cart_items.product_id', '=', 'products.id')
            ->selectRaw("cart_items.*, products.*, (cart_items.count * products.price) as total")->get();

    }

    public function getCartItem(int|string $productId, int|string|null  $userId = null)
    {
        return $this->where([
            ['user_id', $userId ?? auth()->id()],
            ['product_id', $productId],
        ])->first();
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
