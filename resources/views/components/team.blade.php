@php
    $team = \App\Models\TeamMember::where('is_active', true)->get();
@endphp

@if ($team->count())
    <style>
        .team-card {
            perspective: 1000px;
        }
        .card-inner {
            position: relative;
            width: 100%;
            height: 480px; /* Slightly taller for better spacing */
            text-align: center;
            transition: transform 0.8s;
            transform-style: preserve-3d;
        }
        .team-card:hover .card-inner {
            transform: rotateY(180deg);
        }
        .card-front, .card-back {
            position: absolute;
            width: 100%;
            height: 100%;
            backface-visibility: hidden;
            border-radius: 1.5rem;
            overflow: hidden;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        .card-front {
            background: white;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 1.5rem;
        }
        .card-back {
            background: linear-gradient(145deg, #4f46e5 0%, #7c3aed 100%);
            color: white;
            transform: rotateY(180deg);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }
        /* Ribbon */
        .ribbon {
            position: absolute;
            top: 0;
            right: 0;
            width: 150px;
            height: 150px;
            overflow: hidden;
        }
        .ribbon span {
            position: absolute;
            display: block;
            width: 225px;
            padding: 8px 0;
            background-color: #f97316;
            color: white;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            text-align: center;
            right: -25px;
            top: 30px;
            transform: rotate(45deg);
            box-shadow: 0 5px 10px rgba(0,0,0,0.1);
        }
        /* Social icons on back */
        .social-icon {
            width: 40px;
            height: 40px;
            background: rgba(255,255,255,0.2);
            border-radius: 9999px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: white;
            transition: all 0.3s;
        }
        .social-icon:hover {
            background: white;
            color: #4f46e5;
            transform: scale(1.1);
        }
        .contact-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
        }
    </style>

    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-4 text-center">

            <h2 class="text-4xl font-bold mb-14">Meet Our Team</h2>

            <div class="grid md:grid-cols-4 gap-6">

                @foreach ($team as $member)
                    <div class="team-card">

                        <div class="card-inner">

                            {{-- FRONT SIDE --}}
                            <div class="card-front">

                                {{-- Ribbon (optional) --}}
                                @if($member->ribbon_text ?? false)
                                    <div class="ribbon"><span>{{ $member->ribbon_text }}</span></div>
                                @endif

                                @if ($member->photo)
                                    <img src="{{ Storage::url($member->photo) }}"
                                         class="w-50 h-60 rounded-full object-cover mb-4 border-4 border-gray-200"
                                         alt="{{ $member->name }}">
                                @else
                                    <div class="w-32 h-32 rounded-full bg-gray-300 mb-4 flex items-center justify-center text-gray-600 text-4xl font-bold">
                                        {{ substr($member->name, 0, 1) }}
                                    </div>
                                @endif

                                <h3 class="text-2xl font-bold text-gray-900">{{ $member->name }}</h3>
                                <p class="text-indigo-600 font-semibold mt-1">{{ $member->position }}</p>

                                {{-- Optional: show email & phone on front too --}}
                                <div class="mt-4 text-sm text-gray-600 space-y-1">
                                    @if($member->email)
                                        <div class="flex items-center justify-center gap-2">
                                            <i class="fa-regular fa-envelope"></i>
                                            <span>{{ $member->email }}</span>
                                        </div>
                                    @endif
                                    @if($member->phone)
                                        <div class="flex items-center justify-center gap-2">
                                            <i class="fa-regular fa-phone"></i>
                                            <span>{{ $member->phone }}</span>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            {{-- BACK SIDE --}}
                            <div class="card-back">

                                <h3 class="text-xl font-bold mb-2">{{ $member->name }}</h3>
                                <p class="text-indigo-200 font-medium mb-4">{{ $member->position }}</p>

                                <p class="text-sm leading-relaxed mb-6">
                                    {{ $member->bio ?? 'Experienced professional dedicated to helping you find your dream property.' }}
                                </p>

                                {{-- Contact details --}}
                                <div class="w-full text-left mb-6 space-y-2">
                                    @if($member->email)
                                        <div class="contact-item">
                                            <i class="fa-regular fa-envelope w-5"></i>
                                            <a href="mailto:{{ $member->email }}" class="hover:underline truncate">{{ $member->email }}</a>
                                        </div>
                                    @endif
                                    @if($member->phone)
                                        <div class="contact-item">
                                            <i class="fa-regular fa-phone w-5"></i>
                                            <a href="tel:{{ $member->phone }}" class="hover:underline">{{ $member->phone }}</a>
                                        </div>
                                    @endif
                                </div>

                                {{-- Social Icons --}}
                                <div class="flex justify-center gap-3">
                                    @if($member->facebook)
                                        <a href="{{ $member->facebook }}" target="_blank" class="social-icon">
                                            <i class="fa-brands fa-facebook-f"></i>
                                        </a>
                                    @endif
                                    @if($member->instagram)
                                        <a href="{{ $member->instagram }}" target="_blank" class="social-icon">
                                            <i class="fa-brands fa-instagram"></i>
                                        </a>
                                    @endif
                                    @if($member->linkedin)
                                        <a href="{{ $member->linkedin }}" target="_blank" class="social-icon">
                                            <i class="fa-brands fa-linkedin-in"></i>
                                        </a>
                                    @endif
                                    @if($member->tiktok)
                                        <a href="{{ $member->tiktok }}" target="_blank" class="social-icon">
                                            <i class="fa-brands fa-tiktok"></i>
                                        </a>
                                    @endif
                                    @if($member->whatsapp)
                                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $member->whatsapp) }}" target="_blank" class="social-icon">
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
