<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Berita') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-10">
                <a href="{{ route('dashboard.news.create') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded shadow-lg">
                    + Buat Data Berita
                </a>
            </div>
                <div class="relative overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">ID</th>
                            <th scope="col" class="px-6 py-3">Nama Berita</th>
                            <th scope="col" class="px-6 py-3">Deskripsi Berita</th>
                            <th scope="col" class="px-6 py-3">Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($newsData as $news)
                                <tr>
                                    <th scope="row" class="px-6 py-3">{{$news->id}}</th>
                                    <td scope="col" class="px-6 py-3">{{$news->nameNews}}</td>
                                    <td scope="col" class="px-6 py-3">{{$news->descNews}}</td>
                                    <td scope="col" class="px-6 py-3">
            
                                        <a class="inline-block border border-blue-700 bg-blue-700 text-white rounded-md px-2 py-1 m-1 transition duration-500 ease select-none hover:bg-blue-800 focus:outline-none focus:shadow-outline" 
                                            href="{{ route('dashboard.news.newsGallery.index', $news->id) }}">
                                            Gallery Photos
                                        </a>
                                        <a class="inline-block border border-gray-700 bg-gray-700 text-white rounded-md px-2 py-1 m-1 transition duration-500 ease select-none hover:bg-gray-800 focus:outline-none focus:shadow-outline" 
                                            href={{ route('dashboard.news.edit', $news->id) }}>
                                            Edit
                                        </a>
                                        <a class="inline-block border border-red-700 bg-red-700 text-white rounded-md px-2 py-1 m-1 transition duration-500 ease select-none hover:bg-red-800 focus:outline-none focus:shadow-outline" 
                                            href="{{ route('dashboard.news.delete', $news->id) }}">
                                            Hapus
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
        </div>
    </div>
</x-app-layout>
