<x-frontend-layout>

<section class="min-h-screen bg-cover bg-center flex items-center justify-center"
    style="background-image: url('/images/bg.jpg');">

    {{-- Overlay --}}
    <div class="absolute inset-0 bg-black/60"></div>

    {{-- Card Container --}}
    <div class="relative z-10 max-w-5xl w-full bg-white rounded-xl shadow-2xl overflow-hidden grid grid-cols-1 md:grid-cols-2">

        {{-- LEFT SIDE IMAGE --}}
        <div class="hidden md:block bg-contain"
            style="background-image: url('/images/agency.png');">
        </div>

        {{-- RIGHT SIDE FORM --}}
        <div class="p-8 md:p-12">

            <h1 class="text-2xl font-bold mb-6 text-center text-gray-800">
                Agent Registration
            </h1>

            {{-- SUCCESS --}}
            @if(session('success'))
                <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            {{-- ERRORS --}}
            @if ($errors->any())
                <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('agent.store') }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    {{-- Name --}}
                    <div>
                        <label class="block font-medium mb-1">Name</label>
                        <input type="text" name="name" value="{{ old('name') }}"
                            class="w-full border rounded p-2 focus:ring-2 focus:ring-blue-400"
                            required>
                    </div>

                    {{-- Email --}}
                    <div>
                        <label class="block font-medium mb-1">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}"
                            class="w-full border rounded p-2 focus:ring-2 focus:ring-blue-400"
                            required>
                    </div>

                    {{-- Phone --}}
                    <div>
                        <label class="block font-medium mb-1">Phone</label>
                        <input type="text" name="phone" value="{{ old('phone') }}"
                            class="w-full border rounded p-2">
                    </div>

                    {{-- password --}}
<div> <label class="block font-medium mb-1">Password</label> <input type="password" name="password" class="w-full border rounded p-2 focus:ring-2 focus:ring-blue-400" required> </div>

<div> <label class="block font-medium mb-1">Confirm Password</label> <input type="password" name="password_confirmation" class="w-full border rounded p-2 focus:ring-2 focus:ring-blue-400" required> </div>

                    {{-- Avatar --}}
                    <div>
                        <label class="block font-medium mb-1">Avatar</label>
                        <input type="file" name="avatar"
                            class="w-full border rounded p-2 bg-white">
                    </div>

                </div>

                {{-- Submit --}}
                <div class="mt-6">
                    <button type="submit"
                        class="w-full bg-blue-600 text-white py-3 rounded-lg font-semibold hover:bg-blue-700 transition duration-300">
                        Submit Agent Request
                    </button>
                </div>

            </form>

        </div>

    </div>

</section>

</x-frontend-layout>
