@php
    $team = \App\Models\TeamMember::where('is_active', true)->get();
@endphp

@if ($team->count())
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-6 text-center">

            <h2 class="text-4xl font-bold mb-14">Meet Our Team</h2>

            <div class="grid md:grid-cols-3 gap-10">

                @foreach ($team as $member)
                    <div class="group [perspective:1000px]">

                        <div
                            class="relative h-[420px] w-full transition-transform duration-700 [transform-style:preserve-3d] group-hover:[transform:rotateY(180deg)]">

                            {{-- FRONT SIDE --}}
                            <div
                                class="absolute inset-0 bg-white rounded-3xl shadow-xl p-8 flex flex-col items-center justify-center [backface-visibility:hidden]">

                                @if ($member->photo)
                                    <img src="{{ asset('storage/' . $member->photo) }}"
                                        class="w-35 h-45 rounded object-cover mb-4" alt="{{ $member->name }}">
                                @endif

                                <h3 class="text-2xl font-bold text-gray-900">
                                    {{ $member->name }}
                                </h3>

                                <p class="text-primary font-semibold mt-2">
                                    {{ $member->position }}
                                </p>

                            </div>



                            {{-- BACK SIDE --}}
                            <div
                                class="absolute inset-0 bg-primary text-white rounded-3xl shadow-xl p-8 flex flex-col justify-center items-center text-center [transform:rotateY(180deg)] [backface-visibility:hidden]">

                                {{-- Bio --}}
                                <p class="text-sm mb-6 leading-relaxed">
                                    {{ $member->bio }}
                                </p>

                                {{-- Contact Info --}}
                                <div class="space-y-2 mb-6 text-sm">

                                    @if ($member->phone)
                                        <p>
                                            <i class="fa-solid fa-phone"></i> <a href="tel:{{ $member->phone }}" class="hover:underline">
                                                {{ $member->phone }}
                                            </a>
                                        </p>
                                    @endif

                                    @if ($member->email)
                                        <p> email
                                            <i class="fa-solid fa-envelope"></i> <a href="mailto:{{ $member->email }}" class="hover:underline">
                                                {{ $member->email }}
                                            </a>
                                        </p>
                                    @endif

                                </div>

                                {{-- Social Icons Row --}}
                                <div class="flex justify-center items-center gap-4  border border-primary/30 rounded-full p-4">

                                    @if ($member->facebook)
                                        <a href="{{ $member->facebook }}" target="_blank"
                                            class="w-10 h-10 flex items-center justify-center bg-white text-primary rounded-full hover:scale-110 transition">
                                            <i class="fa-brands fa-facebook-f"></i>
                                        </a>
                                    @endif

                                    @if ($member->instagram)
                                        <a href="{{ $member->instagram }}" target="_blank"
                                            class="w-10 h-10 flex items-center justify-center bg-white text-primary rounded-full hover:scale-110 transition">
                                            <i class="fa-brands fa-instagram"></i>
                                        </a>
                                    @endif

                                    @if ($member->linkedin)
                                        <a href="{{ $member->linkedin }}" target="_blank"
                                            class="w-10 h-10 flex items-center justify-center bg-white text-primary rounded-full hover:scale-110 transition">
                                            <i class="fa-brands fa-linkedin-in"></i>
                                        </a>
                                    @endif

                                    @if ($member->tiktok)
                                        <a href="{{ $member->tiktok }}" target="_blank"
                                            class="w-10 h-10 flex items-center justify-center bg-white text-primary rounded-full hover:scale-110 transition">
                                            <i class="fa-brands fa-tiktok"></i>
                                        </a>
                                    @endif

                                    @if ($member->whatsapp)
                                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $member->whatsapp) }}"
                                            target="_blank"
                                            class="w-10 h-10 flex items-center justify-center bg-white text-primary rounded-full hover:scale-110 transition">
                                            <i class="fa-brands fa-whatsapp"></i>
                                        </a>
                                    @endif

                                </div>

                            </div>


                        </div>

                    </div>
                @endforeach

            </div>

        </div>
    </section>
@endif
