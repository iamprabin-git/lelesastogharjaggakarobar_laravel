<header>
    <div class="bg-primary">
        <div class="container text-center py-1 relative ">
            <p>
                Lets join with us and find your dream home. We have a wide range of properties for you to choose from.
            </p>
            <button type="button"
                class="absolute right-10 top-1/2 -translate-x-10% -translate-y-1/2 text-white cursor-pointer">
                <i class="fa-solid fa-x"></i>

            </button>
        </div>
    </div>
    <nav class="shadow-lg">
        <div class="container flex flex-col md:flex-row gap-2 items-center justify-between py-4">
            <div>
                <img src="{{ asset('images/logo.png') }}" alt="logo" class="w-20">
            </div>
            <div>
                <form action="" method="get">
                    <div class="flex items-center">
                    <input type="search" name="search" id="search" placeholder="Search here..."
                        class="border border-gray-300 rounded-md px-4 py-2">
                    <button type="submit" class="bg-[#ababab] text-white border border-gray-300px-4 py-2">compare<i class="fa-solid fa-magnifying-glass"></i></button>
                    </div>
                </form>
            </div>
            <div class="flex gap-2 items-center">
                <a href="/agent-form" class="btn-primary">sign up</a>
                <a href="/agent" class="btn-secondary">sign in</a>
            </div>
        </div>
    </nav>
</header>
