<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Job Post List') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="py-12">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                        <div class="d-flex align-items-center justify-content-between">
                            <a href="{{ route('post.create') }}"
                                class="inline-flex items-center px-4 py-2 bg-green-800 dark:bg-green-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-green-800 uppercase tracking-widest hover:bg-green-700 dark:hover:bg-white focus:bg-green-700 dark:focus:bg-white active:bg-green-900 dark:active:bg-green-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150'">Create
                                New</a>
                        </div>
                        {{-- <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                            <div class="max-w-7xl">
                                <table id="companyList" class="min-w-full divide-y divide-gray-800 border ">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Job Title</th>
                                            <th>Job Field</th>
                                            <th>Company</th>
                                            <th>Location</th>
                                            <th>Status</th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200 align-middle">
                                        @foreach ($list as $row)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap">{{ $row->id }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap">{{ $row->job_title }}</td>
                                                <td class="px-6 py-4 ">
                                                    {{ $row->JobField->description }} </td>
                                                <td class="px-6 py-4 whitespace-nowrap"> {{ $row->Company->name }} </td>
                                                <td class="px-6 py-4 ">{{ $row->location }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    @if ($row->status == '1')
                                                        Open
                                                    @else
                                                        Close
                                                    @endif
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                    <a href="{{ route('post.edit', $row->id) }}"
                                                        class="text-blue-500 hover:text-blue-600 border border-transparent rounded-md font-semibold text-xs uppercase tracking-widest hover:bg-blue-500 active:bg-blue-700 ">Edit</a>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                    <form method="post" action="{{ route('post.destroy', $row) }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button onclick='return confirm("Are you sure?")'
                                                            class="bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 ">
                                                            Delete</button>
                                                    </form>

                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            {{ $list->links() }}
                        </div> --}}
                        <livewire:company-post-datatables sort="id|asc" searchable="job title,company,description"
                            exportable />

                    </div>
                </div>
            </div>
        </div>

</x-app-layout>
