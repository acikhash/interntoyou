<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Post') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Update Job Post') }}
                            </h2>
                        </header>
                        <div class="d-flex align-items-center justify-content-between">
                            <form method="post" action="{{ route('post.update', $post) }}"
                                class="mt-6 space-y-6 align-items-center" enctype="multipart/form-data">
                                @csrf
                                @method('post')
                                <div>
                                    @if ($post->office == null && $post->office == '')
                                        <img id="preview_img" src={{ URL::asset('/images/nopremis.png') }}
                                            style="width: 460; height: 345;" />
                                    @elseif($post->office != null && $post->office != '')
                                        <img id="preview_img3" src={{ $post->office }} alt={{ $post->office }}
                                            style="width: 460; height: 345;" />
                                    @endif
                                </div>
                                <div>
                                    <label class="form-label" for="inputImage">Image:</label>
                                    <input type="file" name="image" id="inputImage"
                                        class="form-control @error('image') is-invalid @enderror">

                                    @error('image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div>
                                    <x-input-error class="mt-2" :messages="$errors->get('job_title')" />
                                    <x-input-label for="job_title" :value="__('Job Title')" />
                                    <x-text-input id="job_title" name="job_title" type="text"
                                        class="mt-1 block w-full" :value="old('job_title', $post->job_title)" required autofocus
                                        autocomplete="job_title" />
                                </div>
                                <div>
                                    <x-input-label for="company" :value="__('Company')" />
                                    <select
                                        class="mt-1 block w-full flex-1 appearance-none bg-transparent py-2 pl-3 pr-9 text-sm font-semibold"
                                        name="company">
                                        @foreach ($companies as $company)
                                            <option value={{ $company->id }}
                                                @if ($post->Company->id == $company->id) Selected @endif>{{ $company->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <x-input-error class="mt-2" :messages="$errors->get('company')" />
                                </div>
                                <div>
                                    <x-input-label for="description" :value="__('Description')" />
                                    <textarea id="description" name="description" rows="4" cols="50" class="mt-1 block w-full" required
                                        autocomplete="location"> {{ $post->description }}</textarea>
                                    <x-input-error class="mt-2" :messages="$errors->get('description')" />
                                </div>

                                <div>
                                    <x-input-label for="location" :value="__('Location')" />
                                    <textarea id="location" name="location" rows="3" cols="50" class="mt-1 block w-full" required
                                        autocomplete="location"> {{ $post->location }}</textarea>
                                    <x-input-error class="mt-2" :messages="$errors->get('location')" />
                                </div>

                                <div>
                                    <x-input-label for="jobfield" :value="__('Job Field')" />
                                    <select
                                        class="mt-1 block w-full flex-1 appearance-none bg-transparent py-2 pl-3 pr-9 text-sm font-semibold"
                                        name="jobfield">
                                        @foreach ($jobfields as $field)
                                            <option value={{ $field->id }}
                                                @if ($post->jobfield->id != null) Selected @endif>
                                                {{ $field->description }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <x-input-error class="mt-2" :messages="$errors->get('jobfield')" />
                                </div>
                                <div>
                                    <x-input-label for="status" :value="__('Post Status')" />
                                    <input type="radio" id="open" value='1' name="status"
                                        @if ($post->status == 1) checked @endif /> Open
                                    &nbsp;&nbsp;<input type="radio" id="close" value='0' name="status"
                                        @if ($post->status == 0) checked @endif /> Close
                                    <x-input-error class="mt-2" :messages="$errors->get('status')" />
                                </div>

                                <div class="flex items-center gap-4">
                                    <x-primary-button>{{ __('Save') }}</x-primary-button>
                            </form>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>

    @push('script')
        <script>
            selectImage.onchange = evt => {
                preview = document.getElementById('preview');
                preview.style.display = 'block';
                const [file] = selectImage.files
                if (file) {
                    preview.src = URL.createObjectURL(file)
                }
            }
        </script>
    @endpush
</x-app-layout>
