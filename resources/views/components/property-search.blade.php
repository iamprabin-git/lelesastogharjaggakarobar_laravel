<form method="GET" action="{{ route('properties.index') }}"
          class="bg-white shadow-lg rounded-3xl p-6 mb-12">

        <div class="grid md:grid-cols-6 gap-4">

            {{-- Keyword --}}
            <input type="text" name="keyword"
                   value="{{ request('keyword') }}"
                   placeholder="Search location, city..."
                   class="col-span-2 border rounded-xl px-4 py-3">

            {{-- Type --}}
            <select name="type" class="border rounded-xl px-4 py-3">
                <option value="">Property Type</option>
                <option value="sale" {{ request('type')=='sale'?'selected':'' }}>
                    For Sale
                </option>
                <option value="rent" {{ request('type')=='rent'?'selected':'' }}>
                    For Rent
                </option>
            </select>


            {{-- Min Price --}}
            <input type="number" name="min_price"
                   value="{{ request('min_price') }}"
                   placeholder="Min Price"
                   class="border rounded-xl px-4 py-3">

            {{-- Max Price --}}
            <input type="number" name="max_price"
                   value="{{ request('max_price') }}"
                   placeholder="Max Price"
                   class="border rounded-xl px-4 py-3">

            {{-- Sort --}}
            <select name="sort" class="border rounded-xl px-4 py-3">
                <option value="">Sort By</option>
                <option value="low_high" {{ request('sort')=='low_high'?'selected':'' }}>
                    Price: Low to High
                </option>
                <option value="high_low" {{ request('sort')=='high_low'?'selected':'' }}>
                    Price: High to Low
                </option>
            </select>

        </div>

        <div class="mt-6 flex gap-4">
            <button type="submit"
                    class="bg-primary text-white px-8 py-3 rounded-xl hover:bg-primary/90 transition">
                Search
            </button>

            <a href="{{ route('properties.index') }}"
               class="bg-gray-200 px-8 py-3 rounded-xl hover:bg-gray-300 transition">
                Reset
            </a>
        </div>

    </form>
