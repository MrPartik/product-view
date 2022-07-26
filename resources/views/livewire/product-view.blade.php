<div class="relative bg-white overflow-hidden">
    <div class="loading-page" wire:loading.block wire:target="selectSize, saveCart">Loading&#8230;</div>
    <style>
        .header-product-view {
            background-color: #F6F6F7;
        }
    </style>
    <div class="  mx-auto">
        <div class="relative z-10 pb-8 bg-white ">
            <div class="header-product-view">
                <div class="relative p-6 px-4 sm:px-6 lg:px-8">
                    <nav>
                        <div class="cart-parent-container ml-10 pr-4 space-x-8 text-right">
                            <button wire:click="showCart" wire:loading.attr="disabled" href="javascript:;" id="open-cart" class="font-medium hover:text-indigo-500 relative" style="z-index: 999999"><span class="icon-cart"> ({{ $iCartQty }})</span> <span class="text-cart">My Cart ({{ $iCartQty }}) </span></button>
                            <div class="{{ ($bShowCart) ? '' : 'hidden' }} mini-cart absolute right-0">
                                <div class="container-cart">
                                    <img src="https://c.tenor.com/wpSo-8CrXqUAAAAi/loading-loading-forever.gif" alt="loading..." class="mb-5 loading-cart" wire:loading.block wire:target="showCart"></img>
                                    @foreach($aCartFormatted as $aItem)
                                        <div class="flex mb-2 mt-2">
                                            <img class="" style="width: 100px" src="{{ $aItem['image'] }}"/>
                                            <div class="ml-5">
                                                <p class="mb-1">{{ $aItem['title'] }}</p>
                                                <div style="font-size: 12px">
                                                    <p class="mb-1">{{ $aItem['qty'] }} x <strong>${{ $aItem['price'] }}</strong></p>
                                                    <p> Size: {{ $aItem['size'] }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <hr />
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
            <main class="mt-10 mx-auto container">
                <div class="product-parent-container grid grid-cols-2 gap-4">
                    <div>
                        <img class="featured-image" style="max-width: 400px;" src="{{ $aProductInfo['imageURL'] ?? 'https://lh5.googleusercontent.com/MGOM6krXaVmFigiX3HTMG66OgUFtRDS0OhxE6JrhObYerW7Ny51PtFr0i10sTuScIry3BaDeoA3uHphCeXr72jjn879zPm3uW6hebPK3_mfqnxg9l1VJCg=w1360-h617-rw' }}" alt="T-Shirt" />
                    </div>
                    <div class="product-container">
                        <h1> {{ $aProductInfo['title'] ?? 'Classic Tee' }}</h1>
                        <hr/>
                        <span class="price">${!! floatval($aProductInfo['price'] ?? '75.00') !!}</span>
                        <hr />
                        <p class="description">
                            {{ $aProductInfo['description'] ?? 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.' }}
                        </p>
                        <div class="sizes-container mb-2">
                            <p class="mb-2">Sizes <span style="color: #C90000">*</span></p>
                            <div class="flex sizes">
                                @foreach($aSizes as $aValue)
                                    <span wire:click="selectSize({{ $aValue['id'] }}, '{{ $aValue['label']}}')" value="{{ $aValue['id'] }}" class="{{ ($aValue['id'] === $iSelectedSize) ? 'selected' : ''}} sizes-item">{{ $aValue['label'] }}</span>
                                @endforeach
                            </div>
                        </div>
                        <button wire:click="saveCart" class="mt-3 bg-transparent add-to-cart">
                            ADD TO CART
                        </button>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <script>
        $('#open-cart').on('click', function() {
            if($('.mini-cart').hasClass('hidden')) {
                return $('.mini-cart').removeClass('hidden');
            }
            return $('.mini-cart').addClass('hidden');
        });
    </script>
</div>
