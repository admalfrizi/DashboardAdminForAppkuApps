<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Webinar &raquo; Gambar untuk {{ $webinarItem->titleWebinar}}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-10">
                <a href="{{ route('dashboard.webinar.webinarGallery.create', $webinarItem->id) }}"  class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded shadow-lg">
                    + Tambah Gambar pada Data Kelas
                </a>
            </div>
            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">ID</th>
                            <th scope="col" class="px-6 py-3">Photo</th>
                            <th scope="col" class="px-6 py-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($imageRef as $imgWebinar => $item)
                        <tr>
                            <td scope="col" class="px-6 py-3">{{$imgWebinar+1}}</td>
                            <td scope="col" class="px-6 py-3">
                                <image width="90px" src="{{ asset('storage/images/webinarImages/'.$webinarItem->id.'/'.$item->image) }}"/>
                            </td>
                            <td scope="col" class="px-6 py-3">
                                @if(count($item->where('webinar_id', $webinarItem->id)->get()->toArray()) == 1)
                                   <div></div>
                                @else
                                <a class="inline-block border border-red-700 bg-red-700 text-white rounded-md px-2 py-1 m-1 transition duration-500 ease select-none hover:bg-red-800 focus:outline-none focus:shadow-outline" 
                                    href="{{ route('dashboard.webinar.webinarGallery.delete',['id' => $item->id,'webinarId' => $item->webinar_id]) }}">
                                    Hapus
                                </a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>