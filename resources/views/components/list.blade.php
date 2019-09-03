@foreach($products as $product)
    <a class="list-group-item list-group-item-action flex-column align-items-start">
        <div class="d-flex w-100 justify-content-between">
            <h5 class="mb-1">{{ $product->name  }}, {{ $product->quantity }}</h5>
            <button data-productid="{{ $product->id }}" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#delete">
                Delete
            </button>
        </div>
        <div class="d-flex w-100 justify-content-between">
            <p class="mb-1"><span>Best to use before: </span>{{ $product->expires }}</p>
            <button class="btn btn-outline-info btn-sm" data-toggle="modal" data-target="#edit"
                    data-name="{{ $product->name }}"
                    data-expires="{{ $product->expires }}"
                    data-type="{{ $product->type_id }}"
                    data-quantity="{{ $product->quantity }}"
                    data-productid="{{ $product->id }}">
                Change
            </button>
        </div>
        @if(!empty($product->todayexpires) == TRUE)
            <small class="expires-date text-muted">Expires today!</small>
        @elseif(!empty($product->isexpired) == TRUE)
            <small class="expired-date text-muted">Product is expired!</small>
        @elseif(!empty($product->diff) == TRUE)
            <small class="text-muted">Product will expire soon!</small>
        @endif
        @if(Auth::check() && Auth::user()->isRole()=='admin' && isset($product->user->name))
            <small class="text-mute added-by">Added by <b>{{ $product->user->name }}</b></small>
        @endif
    </a>
@endforeach