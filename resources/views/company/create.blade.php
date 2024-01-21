<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Company Profile') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Create Company Profile') }}
                            </h2>

                        </header>

                        <form method="post" action="{{ route('company.store') }}" class="mt-6 space-y-6"
                            enctype="multipart/form-data">
                            @csrf
                            @method('post')
                            <div>

                                <img id="preview_img" src={{ URL::asset('/images/nopremis.png') }}
                                    style="width: 460px; height: 345px;" />

                                <input type="file" name="image" id="image"
                                    class="@error('image') is-invalid @enderror mt-1 block w-full" required>
                                <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
                                @error('image')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                            </div>
                            <div>
                                <x-input-label for="name" :value="__('Name')" />
                                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                                    required autofocus autocomplete="name" />
                                <x-input-error class="mt-2" :messages="$errors->get('name')" />
                            </div>

                            <div>
                                <x-input-label for="ssm_no" :value="__('Registration No')" />
                                <x-text-input id="ssm_no" name="ssm_no" type="text" class="mt-1 block w-full"
                                    required autocomplete="name" />
                                <x-input-error class="mt-2" :messages="$errors->get('ssm_no')" />
                            </div>

                            <div>
                                <x-input-label for="website" :value="__('Company Website')" />
                                <x-text-input id="website" name="website" type="url" class="mt-1 block w-full"
                                    required autocomplete="website" />
                                <x-input-error class="mt-2" :messages="$errors->get('website')" />
                            </div>
                            <div>
                                <x-input-label for="location" :value="__('Company HQ')" />
                                <x-text-input id="location" name="location" type="text" class="mt-1 block w-full"
                                    required autocomplete="location" />
                                <x-input-error class="mt-2" :messages="$errors->get('location')" />
                            </div>
                            <div>
                                <x-input-label for="industry" :value="__('Company Main Industry')" />
                                <x-text-input id="industry" name="industry" type="text" class="mt-1 block w-full"
                                    required autocomplete="industry" />
                                <x-input-error class="mt-2" :messages="$errors->get('industry')" />
                            </div>
                            <div>
                                <x-input-label for="size" :value="__('Company Size')" />
                                <x-text-input id="size" name="size" type="number" class="mt-1 block w-full"
                                    required autocomplete="size" />
                                <x-input-error class="mt-2" :messages="$errors->get('size')" />
                            </div>

                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Save') }}</x-primary-button>
                        </form>
                    </section>
                </div>
            </div>
        </div>

    </div>
    </div>
</x-app-layout>
