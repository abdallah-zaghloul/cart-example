<section>
    <div class="container py-5">
        <div class="row">
            @foreach($products as $product)

                <div class="col-md-6 col-lg-4 mb-4 mb-md-0">

                    <!-- Product -->
                    <div class="card">
                        <div class="d-flex justify-content-between p-3">
                            <p class="lead mb-0">{{$product->name}}</p>
                            <div class="d-flex align-items-center justify-content-center shadow-1-strong">
                                <button class="btn btn-dark" wire:click="addProductToCart({{$product->id}})">
                                    <strong>+</strong></button>
                                &nbsp;
                                <button class="btn btn-danger" wire:click="removeProductFromCart({{$product->id}})">
                                    <strong>-</strong></button>
                            </div>
                        </div>
                        <img src="https://mdbcdn.b-cdn.net/img/Photos/Horizontal/E-commerce/Products/7.webp"
                             class="card-img-top"/>
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-3">
                                <h5 class="text-dark mb-0">{{$product->price}}</h5>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            <hr class="my-4">

            <div class="pagination justify-content-center">
                {{$products->links()}}
            </div>

        </div>
    </div>
</section>
