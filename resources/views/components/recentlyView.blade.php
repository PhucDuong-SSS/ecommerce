@foreach($products as $product)
<div class="owl-item">
    <div class="viewed_item discount d-flex flex-column align-items-center justify-content-center text-center">
        <div class="viewed_image"><img src="{{$product->image_one}}" alt=""></div>
        <div class="viewed_content text-center">
            @if($product->discount_price == NULL)

            <div class="viewed_price">${{$product->selling_price}}<span></span></div>
            @else
                <div class="viewed_price">${{$product->discount_price}}<span>${{$product->selling_price}}</span></div>
            @endif
                <div class="viewed_name"><a href="#">{{$product->name}}</a></div>
        </div>
        <ul class="item_marks">
            @if($product->discount_price == NULL)
                <li class="item_mark item_new ">New</li>
            @else
                <li class="item_mark item_discount ">
                    @php
                        $amount = $product->selling_price - $product->discount_price;
                        $discount = $amount/$product->selling_price*100;

                    @endphp

                    {{ intval($discount) }}%

                </li>
            @endif

        </ul>
    </div>
</div>
@endforeach
