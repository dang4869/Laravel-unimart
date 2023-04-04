@if ($item->categoryChild->count())
    <ul class="sub-menu">
        @foreach ($item->categoryChild as $item_sub)
            <li>
                <a href="{{route('category.product', $item_sub->slug)}}" title="">{{ $item_sub->category_name }}</a>
                @if ($item_sub->categoryChild->count())
                @include('frontend.menu.child', ['item'=>$item_sub])
                @endif
            </li>
        @endforeach
    </ul>
@endif
