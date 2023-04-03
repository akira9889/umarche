<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('owner.products.store') }}" method="post">
                        @csrf
                        <div class="-m-2">
                            <div class="p-2 w-full text-right">
                                <div class="relative">
                                  <select name="categoty" class="bg-gray-200 dark:bg-gray-400">
                                    <option>カテゴリー</option>
                                    @foreach ($categories as $category)
                                    <optgroup label="{{ $category->name }}">
                                      @foreach ($category->secondary as $secondary)
                                          <option value="{{ $secondary->id }}">{{ $secondary->name }}</option>
                                      @endforeach
                                    </optgroup>
                                    @endforeach
                                  </select>
                                    {{-- <x-input-error :messages="$errors->get('name')" class="mt-2" /> --}}
                                </div>
                            </div>

                            <div class="p-2 w-full flex justify-around mt-4">
                                <button type="button" onclick="location.href='{{ route('owner.products.index') }}'"
                                    class="bg-gray-200 dark:bg-gray-400 border-0 py-2 px-8 focus:outline-none hover:bg-gray-400 dark:hover:bg-gray-600 rounded text-lg">戻る</button>
                                <button type="submit"
                                    class="text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">登録する</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
