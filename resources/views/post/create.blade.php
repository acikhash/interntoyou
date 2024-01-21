<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Post') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl d-flex align-items-center justify-content-between">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Create Job Post') }}
                            </h2>
                        </header>
                        <form method="post" action="{{ route('post.store') }}" class="mt-6 space-y-6"
                            enctype="multipart/form-data">
                            @csrf
                            @method('post')
                            <div>
                                <div>
                                    <img id="preview" src="#" alt="your image" class="mt-3"
                                        style="display:none;" />
                                    <img id="preview_img" src={{ URL::asset('/images/nopremis.png') }}
                                        style="width: 460; height: 345;" />
                                </div>
                                <div>
                                    <input type="file" name="image" id="image"
                                        class="@error('image') is-invalid @enderror mt-1 block w-full" required>
                                    <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
                                    @error('image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div>
                                    <x-input-error class="mt-2" :messages="$errors->get('job_title')" />
                                    <x-input-label for="job_title" :value="__('Job Title')" />
                                    <x-text-input id="job_title" name="job_title" type="text"
                                        class="mt-1 block w-full" required autofocus autocomplete="work" />
                                </div>
                                <div>
                                    <select
                                        class="mt-1 block w-full flex-1 appearance-none bg-transparent py-2 pl-3 pr-9 text-sm font-semibold"
                                        name="company" autocomplete="work">
                                        @foreach ($companies as $company)
                                            <option value={{ $company->id }}>{{ $company->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <x-input-error class="mt-2" :messages="$errors->get('company')" />
                                </div>
                                <div>
                                    <x-input-label for="description" :value="__('Description')" />
                                    <textarea id="description" name="description" rows="4" cols="50" class="mt-1 block w-full" required
                                        autocomplete="location"> </textarea>
                                    <x-input-error class="mt-2" :messages="$errors->get('description')" />
                                </div>

                                <div>
                                    <x-input-label for="location" :value="__('Location')" />
                                    <textarea id="location" name="location" rows="3" cols="50" class="mt-1 block w-full" required
                                        autocomplete="location"> </textarea>
                                    <x-input-error class="mt-2" :messages="$errors->get('location')" />
                                </div>

                                <div>
                                    <select
                                        class="mt-1 block w-full flex-1 appearance-none bg-transparent py-2 pl-3 pr-9 text-sm font-semibold"
                                        name="jobfield">
                                        @foreach ($jobfields as $field)
                                            <option value={{ $field->id }}>{{ $field->description }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <x-input-error class="mt-2" :messages="$errors->get('jobfield')" />
                                </div>
                                <div>
                                    <label for="open">Post Status</label>
                                    {{-- <x-input-label for="status" :value="__('Post Status')" /> --}}
                                    <x-text-input id="open" value='1' name="status" type="radio"
                                        checked />Open
                                    <x-text-input id="close" value='0' name="status" type="radio" />Close
                                    <x-input-error class="mt-2" :messages="$errors->get('status')" />
                                </div>

                                <div class="flex items-center gap-4">
                                    <x-primary-button>{{ __('Save') }}</x-primary-button>
                        </form>
                        <div class="form-group">
                    </section>
                </div>
            </div>
        </div>
        <script></script>
    </div>
    </div>
</x-app-layout>
