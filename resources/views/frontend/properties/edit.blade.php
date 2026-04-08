<x-frontend-layout>
    <div class="container mx-auto px-4 py-10">
        <div class="bg-card text-card-foreground mx-auto max-w-3xl rounded-xl border p-8 shadow-sm">
            <h1 class="mb-2 text-2xl font-bold tracking-tight">Edit listing</h1>
            <p class="text-muted-foreground mb-8 text-sm">Update your property details and save changes.</p>

            @if ($errors->any())
                <div class="border-destructive/30 bg-destructive/10 text-destructive mb-6 rounded-lg border px-4 py-3 text-sm"
                    role="alert">
                    <ul class="list-inside list-disc space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (!empty($property->images))
                <div class="mb-8">
                    <span class="text-foreground text-sm font-medium">Current photos</span>
                    <ul class="mt-3 grid gap-4 sm:grid-cols-2">
                        @foreach ($property->images as $index => $path)
                            <li class="border-input flex flex-col gap-2 overflow-hidden rounded-lg border p-2 text-sm">
                                <img src="{{ \Illuminate\Support\Facades\Storage::url($path) }}" alt=""
                                    class="aspect-video w-full rounded-md object-cover" />
                                <form action="{{ route('properties.image.delete', [$property, $index]) }}" method="post"
                                    onsubmit="return confirm('Remove this image?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="text-destructive hover:text-destructive/90 text-xs font-medium underline-offset-4 hover:underline">
                                        Remove image
                                    </button>
                                </form>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('properties.update', $property) }}" method="post" enctype="multipart/form-data"
                class="space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <x-input-label for="title" value="Title" />
                    <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title', $property->title)"
                        required />
                    <x-input-error class="mt-2" :messages="$errors->get('title')" />
                </div>

                <div>
                    <x-input-label for="description" value="Description" />
                    <textarea id="description" name="description" rows="5"
                        class="border-input bg-background text-foreground placeholder:text-muted-foreground mt-1 block min-h-[120px] w-full rounded-md border px-3 py-2 text-sm shadow-xs transition-[color,box-shadow] outline-none focus-visible:border-ring focus-visible:ring-[3px] focus-visible:ring-ring/50">{{ old('description', $property->description) }}</textarea>
                    <x-input-error class="mt-2" :messages="$errors->get('description')" />
                </div>

                <div>
                    <x-input-label for="price" value="Price (Rs.)" />
                    <x-text-input id="price" name="price" type="number" step="0.01" class="mt-1 block w-full"
                        :value="old('price', $property->price)" required />
                    <x-input-error class="mt-2" :messages="$errors->get('price')" />
                </div>

                <div class="grid gap-6 sm:grid-cols-2">
                    <div>
                        <x-input-label for="type" value="Type" />
                        <select id="type" name="type" required
                            class="border-input bg-background text-foreground mt-1 flex h-9 w-full rounded-md border px-3 text-sm shadow-xs outline-none focus-visible:border-ring focus-visible:ring-[3px] focus-visible:ring-ring/50">
                            <option value="sale" @selected(old('type', $property->type) === 'sale')>Sale</option>
                            <option value="rent" @selected(old('type', $property->type) === 'rent')>Rent</option>
                        </select>
                        <x-input-error class="mt-2" :messages="$errors->get('type')" />
                    </div>
                    <div>
                        <x-input-label for="availability" value="Availability" />
                        <select id="availability" name="availability" required
                            class="border-input bg-background text-foreground mt-1 flex h-9 w-full rounded-md border px-3 text-sm shadow-xs outline-none focus-visible:border-ring focus-visible:ring-[3px] focus-visible:ring-ring/50">
                            <option value="available" @selected(old('availability', $property->availability) === 'available')>Available</option>
                            <option value="rented" @selected(old('availability', $property->availability) === 'rented')>Rented</option>
                            <option value="sold" @selected(old('availability', $property->availability) === 'sold')>Sold</option>
                        </select>
                        <x-input-error class="mt-2" :messages="$errors->get('availability')" />
                    </div>
                </div>

                <div>
                    <x-input-label for="status" value="Status" />
                    <select id="status" name="status" required
                        class="border-input bg-background text-foreground mt-1 flex h-9 w-full rounded-md border px-3 text-sm shadow-xs outline-none focus-visible:border-ring focus-visible:ring-[3px] focus-visible:ring-ring/50">
                        <option value="pending" @selected(old('status', $property->status) === 'pending')>Pending</option>
                        <option value="approved" @selected(old('status', $property->status) === 'approved')>Approved</option>
                        <option value="rejected" @selected(old('status', $property->status) === 'rejected')>Rejected</option>
                    </select>
                    <x-input-error class="mt-2" :messages="$errors->get('status')" />
                </div>

                <div>
                    <x-input-label for="youtube_link" value="YouTube link (optional)" />
                    <x-text-input id="youtube_link" name="youtube_link" type="url" class="mt-1 block w-full"
                        :value="old('youtube_link', $property->youtube_link)" />
                    <x-input-error class="mt-2" :messages="$errors->get('youtube_link')" />
                </div>

                <div>
                    <x-input-label for="images" value="Add images (optional)" />
                    <input id="images" name="images[]" type="file" accept="image/jpeg,image/png,image/jpg" multiple
                        class="border-input bg-background text-foreground mt-1 block w-full cursor-pointer rounded-md border px-3 py-2 text-sm file:mr-3 file:rounded-md file:border-0 file:bg-primary file:px-3 file:py-1.5 file:text-sm file:text-primary-foreground" />
                    @foreach ($errors->getMessages() as $key => $messages)
                        @if (str_starts_with($key, 'images.'))
                            @foreach ($messages as $message)
                                <p class="text-destructive mt-2 text-xs">{{ $message }}</p>
                            @endforeach
                        @endif
                    @endforeach
                </div>

                <div class="flex flex-wrap gap-3">
                    <x-primary-button>{{ __('Save changes') }}</x-primary-button>
                    <a href="{{ route('properties.show', $property) }}"
                        class="border-input bg-background text-foreground hover:bg-accent hover:text-accent-foreground inline-flex h-9 items-center justify-center rounded-md border px-4 py-2 text-sm font-medium shadow-xs transition-colors">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-frontend-layout>
