<x-test.app>
    <x-slot name="header">ヘッダー1</x-slot>
    コンポーネントテスト1

    <x-test.card title="タイトル1" content="本文" :message="$message" />
    <x-test.card title="タイトル2" />
    <x-test.card title="CSSを変更したい" class="bg-red-300" />
</x-test.app>
