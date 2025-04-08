<div>
    <form class="home-search" method="GET" action="{{ url('/search') }}">
        <div class="row mt-3 mt-lg-5">
            <div class="col-sm-6 col-lg-5 col-xl-5">
                <div class="form-group mb-3 mb-lg-0">
                    <span>{{ __('home.what') }}?</span>
                    <input type="text" name="what" class="form-control" placeholder="{{ __('home.what ex') }}">
                </div>
            </div>
            <div class="col-sm-6 col-lg-4 col-xl-5">
                <div class="form-group mb-3 mb-lg-0 form-location">
                    <span>{{ __('home.where') }}?</span>
                    <input type="text" name="where" class="form-control" placeholder="{{ __('home.where ex') }}" wire:model="countyQuery" wire:keyup.debounce.100ms="searchCounties" onfocus="showDropdown()" onblur="hideDropdown()">
                    @error('query') <span class="text-danger">{{ $message }}</span> @enderror
                    <a class="location-icon" href="#"> <i class="far fa-compass"></i> </a>
                    @if($showDropdown && $countyQuery)
                        <div class="autocomplete-dropdown">
                            <ul>
                                @forelse($counties as $county)
                                    <li wire:click="selectCounty('{{ $county->name }}')">{{ $county->name }}</li>
                                @empty
                                    <li>{{ __('home.No results found') }}</li>
                                @endforelse
                            </ul>
                        </div>
                        @error('county') <span class="text-danger">{{ $message }}</span> @enderror
                    @endif
                </div>
            </div>
            <div class="col-lg-3 col-xl-2">
                <button type="submit" class="btn btn-secondary">
                    <i class="fas fa-search-location"></i> {{ __('home.search') }}
                </button>
            </div>
        </div>
    </form>
</div>
