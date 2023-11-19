<section class="h-100 h-custom">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12">
                <div class="card card-registration card-registration-2" style="border-radius: 15px;">
                    <div class="card-body p-0">
                        <div class="row g-0">

                            <!-- Cart Title -->
                            <div class="col-lg-8">
                                <div class="p-5">
                                    <div class="d-flex justify-content-between align-items-center mb-5">
                                        <h1 class="fw-bold mb-0 text-black">Shopping Cart</h1>
                                    </div>
                                    <hr class="my-4">

                                    <!-- Cart Item -->
                                    <div class="row mb-4 d-flex justify-content-between align-items-center">
                                        <div class="col-md-2 col-lg-2 col-xl-2 mb-1">
                                            <h5 class="text-black mb-0">Name</h5>
                                        </div>
                                        <div class="col-md-2 col-lg-2 col-xl-2 mb-1">
                                            <h5 class="text-black mb-0">Count</h5>
                                        </div>
                                        <div class="col-md-2 col-lg-2 col-xl-2 offset-lg-1 mb-1">
                                            <h5 class="mb-0">Price</h5>
                                        </div>
                                        <div class="col-md-2 col-lg-2 col-xl-2 offset-lg-1 mb-1">
                                            <h5 class="mb-0">Total</h5>
                                        </div>
                                    </div>

                                    <hr class="my-4">
                                    @foreach($cart_items as $cart_item)

                                    <!-- Cart Item -->
                                    <div class="row mb-4 d-flex justify-content-between align-items-center">
                                        <div class="col-md-2 col-lg-2 col-xl-2 mb-1">
                                            <h5 class="text-black mb-0">{{$cart_item->name}}</h5>
                                        </div>
                                        <div class="col-md-2 col-lg-2 col-xl-2 d-flex mb-1">
                                            <label for="{{$cart_item->id}}_count"></label>
                                            <input type="number" id="{{$cart_item->id}}_count" wire:change="changeCount({{$cart_item->product_id}},$event.target.value)" min="0" step="1" name="quantity" value="{{$cart_item->count}}" class="form-control form-control-sm"/>

                                        </div>
                                        <div class="col-md-2 col-lg-2 col-xl-2 offset-lg-1 mb-1">
                                            <h5 class="mb-0">{{$cart_item->price}}</h5>
                                        </div>

                                        <div class="col-md-2 col-lg-2 col-xl-2 offset-lg-1 mb-1">
                                            <h5 class="mb-0">{{$cart_item->total}}</h5>
                                        </div>
                                    </div>

                                    <hr class="my-4">
                                    @endforeach
                                </div>
                            </div>

                            <!-- Cart Totals -->
                            <div class="col-lg-4 bg-grey">
                                <div class="p-5">
                                    <h3 class="fw-bold mb-5 mt-2 pt-1">Summary</h3>
                                    <hr class="my-4">

                                    <div class="d-flex justify-content-between mb-4">
                                        <h5 class="text-uppercase">items</h5>
                                        <h5> {{$cart_items->sum('count')}}</h5>
                                    </div>

                                    <hr class="my-4">

                                    <div class="d-flex justify-content-between mb-5">
                                        <h5 class="text-uppercase">Total</h5>
                                        <h5> {{$cart_items->sum('total')}}</h5>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
