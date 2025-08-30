<div class="tour-listing wow fadeInUp animated" data-wow-delay="0.1s">
    <a href="{{ route('page.package-details', $package->slug) }}" class="tour-listing-image">
        <div class="badge-top flex-two">
            @if($package->is_featured)
                <span class="feature">Featured</span>
            @endif
            <div class="badge-media flex-five">
                <span class="media"><i class="icon-Group-1000002909"></i>5</span>
                <span class="media"><i class="icon-Group-1000002910"></i>2</span>
            </div>
        </div>
        <img src="{{ asset('public/' . $package->image) }}" alt="{{ $package->title }}" style="aspect-ratio: 1 / 1;">
    </a>
    <div class="tour-listing-content">
        @if($package->is_bestseller)
            <span class="tag-listing">Bestseller</span>
        @endif
        <span class="map"><i class="icon-Vector4"></i>{{ $package->place->country->name }}</span>
        <h3 class="title-tour-list" style="height: 50px">
            <a href="{{ route('page.package-details', $package->slug) }}" class="truncate-2-lines">
                {{ $package->title }}
            </a>
        </h3>
        <div class="review">
            @for($i = 1; $i <= 5; $i++)
                <i class="icon-Star{{ $i <= round($package->rating) ? '' : '-empty' }}"></i>
            @endfor
            <span>({{ $package->review_count }} Review{{ $package->review_count != 1 ? 's' : '' }})</span>
        </div>
        <div class="icon-box flex-three">
            <div class="icons flex-three">
                <i class="icon-time-left"></i>
                <span>{{ $package->duration }}</span>
            </div>
            <div class="icons flex-three">
                <svg width="21" height="16" viewBox="0 0 21 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M4.34766 4.79761C4.34766 2.94013 5.85346 1.43433 7.71094 1.43433C9.56841 1.43433 11.0742 2.94013 11.0742 4.79761C11.0742 6.65508 9.56841 8.16089 7.71094 8.16089C5.85346 8.16089 4.34766 6.65508 4.34766 4.79761Z" stroke="currentColor" stroke-width="1.7" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M9.5977 15.1797H2.46098C1.34827 15.1797 0.558268 14.0954 0.898984 13.0362C1.80408 10.222 4.57804 8.18566 7.69301 8.18566C9.17897 8.18566 10.5566 8.64906 11.6895 9.43922" stroke="currentColor" stroke-width="1.7" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M17.1035 15.1797V9.02734" stroke="currentColor" stroke-width="1.7" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M20.1797 12.1035H14.0273" stroke="currentColor" stroke-width="1.7" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <span>{{ $package->max_persons }} Person{{ $package->max_persons != 1 ? 's' : '' }}</span>
            </div>
        </div>
        <div class="flex-two">
            <div class="price-box flex-three">
                    <p>From <span class="price-sale">{{ $package->sale_price }}</span></p>
                    <span class="price">{{ $package->price }}</span>
            </div>
            <div class="icon-bookmark">
                <i class="icon-Vector-151"></i>
            </div>
        </div>
    </div>
</div>